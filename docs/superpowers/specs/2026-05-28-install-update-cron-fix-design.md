# ILDIS Install/Update/Cron Robustness Fix

**Date**: 2026-05-28
**Status**: Draft
**Approach**: Perbaikan bertahap (Approach A) — fix setiap masalah di tempatnya, minimal perubahan arsitektur.

## Problem Statement

1. **install.sh tidak persistent di server**: User menjalankan `curl ... | bash`, script berjalan tapi tidak tersimpan ke disk. Saat `update.sh` atau `install.sh --update` dipanggil, file tidak ditemukan.
2. **Update flow tidak seamless**: Container dimatikan/restart tanpa urutan yang aman. Cron bisa sedang menulis `document.json` saat app di-restart. Migrate dijalankan dari banyak tempat (init service + update script) tanpa koordinasi.
3. **Docker/migrate patching rapuh**: `patch_app_for_migrations()` memodifikasi file di dalam running container via `sed -i` dan `docker cp`. Patch hilang saat container di-recreate, dan bisa fail silent.
4. **Cron generate document.json tidak robust**: `FeedController::actionGenerateDocument()` tidak ada atomic write, tidak ada error handling, dan cron container tidak punya healthcheck atau wait-for-db mechanism.

---

## Section 1: install.sh Persistence di Server

### Self-save mechanism

Di `main()`, sebelum logic apapun, detect kalo script jalan via pipe (stdin bukan TTY atau `BASH_SOURCE` mengindikasikan pipe). Jika iya, simpan script ke `${INSTALL_DIR}/install.sh` lalu `exec` ulang dari file tersebut.

```bash
# Di awal main():
SELF_SOURCE="${BASH_SOURCE[0]}"

# Check if running via pipe (curl | bash)
# BASH_SOURCE will be empty or point to a pipe when run this way
if [ ! -f "${SELF_SOURCE}" ] || [ ! -s "${SELF_SOURCE}" ]; then
    SAVE_DIR="${INSTALL_DIR:-${DEFAULT_INSTALL_DIR}}"
    mkdir -p "${SAVE_DIR}"
    SAVE_PATH="${SAVE_DIR}/install.sh"
    curl -fsSL "https://raw.githubusercontent.com/${GITHUB_REPO}/main/install.sh" -o "${SAVE_PATH}"
    chmod +x "${SAVE_PATH}"
    exec "${SAVE_PATH}" "$@"
fi
```

### Safety net di akhir install

Di akhir `do_install()`, simpan script ke `${INSTALL_DIR}/install.sh` jika belum ada:

```bash
# Save install.sh to installation directory for future updates
if [ ! -f "${INSTALL_DIR}/install.sh" ]; then
    cp "${BASH_SOURCE[0]}" "${INSTALL_DIR}/install.sh"
    chmod +x "${INSTALL_DIR}/install.sh"
    success "install.sh disalin ke ${INSTALL_DIR}/"
fi
```

### update.sh self-heal

Jika `install.sh` tidak ditemukan, download ulang dari GitHub:

```bash
# Dalam update.sh:
if [ ! -f "${SCRIPT_DIR}/install.sh" ]; then
    echo "install.sh tidak ditemukan, mengunduh dari GitHub..."
    curl -fsSL "https://raw.githubusercontent.com/bphndigitalservice/ildis/main/install.sh" -o "${SCRIPT_DIR}/install.sh"
    chmod +x "${SCRIPT_DIR}/install.sh"
fi
```

### Persistent update di do_update()

Setelah self-update check berhasil, simpan versi terbaru ke `${INSTALL_DIR}/install.sh`:

```bash
# Di do_update(), setelah self-update:
if [ ! -f "${INSTALL_DIR}/install.sh" ] || [ "$(md5sum ...)" != "..." ]; then
    cp "${self_path}" "${INSTALL_DIR}/install.sh"
    chmod +x "${INSTALL_DIR}/install.sh"
fi
```

---

## Section 2: Update Flow yang Seamless

### Ordered update sequence

Urutan baru di `do_update()`:

```
1. Backup DB                    ← sudah ada, OK
2. Pull image baru              ← sudah ada, OK
3. Stop cron dulu               ← BARU: hentikan job yang bisa write
4. Stop app                     ← setelah cron berhenti
5. Recreate app (image baru)    ← docker compose up -d --force-recreate app
6. Tunggu app healthy           ← healthcheck existing
7. Tunggu DB ready              ← healthcheck existing
8. Jalankan migrate             ← dari host via compose exec
9. Patch jika perlu             ← backward compat (version check)
10. Start app final             ← pastikan app serving
11. Start/recreate cron         ← baru setelah semua stabil
12. Verify all healthy          ← BARU: check semua container
```

### Perubahan implementasi

```bash
do_update() {
    # ... backup, pull, dll (sudah ada) ...

    # BARU: Stop cron dulu untuk mencegah write setengah jadi
    info "Menghentikan cron container..."
    run_compose_update "${compose_file}" "${env_file}" stop cron 2>/dev/null || true

    # BARU: Stop app dengan grace period
    info "Menghentikan aplikasi..."
    run_compose_update "${compose_file}" "${env_file}" stop app 2>/dev/null || true

    # Recreate dengan image baru (force-recreate agar image baru dipakai)
    info "Memulai ulang container ILDIS..."
    if ! run_compose_update "${compose_file}" "${env_file}" up -d --force-recreate app 2>&1; then
        fail "Gagal memulai ulang container."
    fi

    # Wait for DB (existing logic)
    # Wait for app healthy (existing logic)

    # Migrate (existing logic)
    # Patch if needed (existing logic, with version check from Section 3)

    # BARU: Start cron terakhir
    info "Memulai cron container..."
    run_compose_update "${compose_file}" "${env_file}" up -d --force-recreate cron 2>&1 || true

    # BARU: Final health verification
    info "Verifikasi semua container..."
    # ... check all containers are healthy/running ...
}
```

### Graceful shutdown untuk cron

Tambahkan `stop_grace_period` di generated compose untuk cron service:

```yaml
cron:
    stop_grace_period: 30s
```

Jika cron sedang generate `document.json`, ada waktu 30 detik untuk selesai sebelum di-kill.

### ildis-init.sh: Jangan hentikan php-fpm jika migrate gagal

**Sebelum**:
```sh
if ! php /var/www/yii migrate/up --interactive=0; then
    s6-echo "[ildis-init] ERROR: Database migrations failed."
    exit 1  # ← ini stop php-fpm!
fi
```

**Sesudah**:
```sh
if ! php /var/www/yii migrate/up --interactive=0; then
    s6-echo "[ildis-init] WARNING: Database migrations failed."
    s6-echo "[ildis-init] App will start. Run migrate manually when DB is ready."
    # Jangan exit 1 — biarkan php-fpm tetap jalan
fi
```

---

## Section 3: Docker/Migration Patching

### 3.1 Fix di source code (build-time)

Semua patch yang sekarang dilakukan runtime sebenarnya adalah fix config yang salah di image. Pindahkan ke source code:

| Patch saat ini | Fix di source |
|---|---|
| `sed` disable `autoInstallTables` | Fix `frontend/config/main.php` di repo: set `'autoInstallTables' => false` |
| `sed` tambah `migrationNamespaces` | Sudah fix di `console/config/main.php` (namespace sudah ada) |
| `sed` fix report migration (string→text) | Fix `m250514_121356_create_table_report.php` di repo |
| `sed` tambah namespace di visitor migrations | Fix 3 file visitor migration di repo: tambah `namespace console\migrations;` |
| `docker cp` file dari repo ke container | Tidak perlu lagi jika image sudah contain fix |
| `patch_recaptcha_support` | Fix `common/config/params.php`, `common/models/LoginForm.php`, `backend/views/site/login.php` di repo untuk baca `RECAPTCHA_ENABLED` dari env |

### 3.2 Version check di `patch_app_for_migrations()`

Untuk backward compat dengan image yang sudah di-deploy tanpa fix, tambahkan version check:

```bash
patch_app_for_migrations() {
    # Skip jika image sudah contain fix (check marker file di container)
    if run_compose exec -T app test -f /var/www/.ildis_patched 2>/dev/null; then
        info "Image sudah di-patch, melewati..."
        return 0
    fi

    info "Menyesuaikan migrasi di container (wajib untuk image production saat ini)..."

    # ... patching logic yang sama seperti sekarang ...

    # Tandai bahwa patch sudah di-apply
    run_compose exec -T app touch /var/www/.ildis_patched 2>/dev/null || true

    warn "Runtime patching masih diperlukan. Update ke image terbaru untuk menghilangkan kebutuhan patching."
    success "Penyesuaian migrasi selesai"
}
```

Di **Dockerfile**, tambahkan marker file agar image baru tidak perlu di-patch:

```dockerfile
RUN touch /var/www/.ildis_patched
```

Image baru punya marker → skip patching. Image lama tanpa marker → patching dijalankan. Seiring waktu, semua user upgrade ke image baru dan patching otomatis di-skip.

### 3.3 Deprecation notice

Tambahkan warning di `patch_app_for_migrations()` (sudah termasuk di code di atas) agar user tahu harus update image.

---

## Section 4: Cron Generate document.json — Robustness Fix

### 4.1 FeedController — Atomic write + error handling

Ganti `file_put_contents()` langsung dengan atomic write pattern:

```php
public function actionGenerateDocument()
{
    $filePath = \Yii::getAlias('@feed/document.json');
    $tempPath = $filePath . '.tmp.' . getmypid();

    try {
        $dokumen = DokumenJdih::find()
            ->alias('d')
            ->select([
                'd.id AS idData',
                'd.tahun_terbit AS tahun_pengundangan',
                'd.tanggal_penetapan',
                'd.tanggal_pengundangan',
                'd.jenis_peraturan AS jenis',
                'd.nomor_peraturan AS noPeraturan',
                'd.judul',
                'd.nomor_panggil AS noPanggil',
                'd.singkatan_jenis AS singkatanJenis',
                'd.tempat_terbit AS tempatTerbit',
                'd.penerbit',
                'd.deskripsi_fisik AS deskripsiFisik',
                'd.sumber',
                'd.isbn',
                'd.status',
                'd.bahasa',
                'd.bidang_hukum AS bidangHukum',
                'd.teu AS teuBadan',
                'd.nomor_induk_buku AS nomorIndukBuku',
                'd.abstrak',
                'd.updated_at AS last_updated'
            ])
            ->where(['d.is_publish' => 1])
            ->asArray()
            ->all();

        if (empty($dokumen)) {
            echo "[feed] Peringatan: Tidak ada dokumen yang dipublikasikan. File tidak diperbarui.\n";
            return self::EXIT_CODE_ERROR;
        }

        foreach ($dokumen as &$row) {
            if (empty($row['abstrak'])) {
                $row['urlAbstrak'] = '';
            } else {
                $row['urlAbstrak'] = \Yii::$app->urlManager->createAbsoluteUrl([
                    'common/dokumen/' . $row['abstrak']
                ]);
            }
            $row['urlDetailPeraturan'] = \Yii::$app->urlManager->createAbsoluteUrl([
                'dokumen/view', 'id' => $row['idData']
            ]);
            $row['fileDownload'] = '-';
            $row['urlDownload'] = '-';
            $row['subjek'] = '';
            $row['operasi'] = '4';
            $row['display'] = '1';
        }

        FileHelper::createDirectory(dirname($filePath));

        $json = json_encode($dokumen, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            throw new \RuntimeException('Gagal encode JSON: ' . json_last_error_msg());
        }

        $bytes = file_put_contents($tempPath, $json);
        if ($bytes === false) {
            throw new \RuntimeException("Gagal menulis file temporer: {$tempPath}");
        }

        if (!rename($tempPath, $filePath)) {
            throw new \RuntimeException("Gagal rename {$tempPath} ke {$filePath}");
        }

        echo "[feed] Berhasil: {$filePath} (" . count($dokumen) . " dokumen, {$bytes} bytes)\n";
        return self::EXIT_CODE_NORMAL;

    } catch (\Exception $e) {
        \Yii::error("[feed] Gagal generate document.json: " . $e->getMessage(), 'feed');
        echo "[feed] ERROR: " . $e->getMessage() . "\n";

        if (file_exists($tempPath)) {
            @unlink($tempPath);
        }
        return self::EXIT_CODE_ERROR;
    }
}
```

**Perubahan kunci**:
- **Atomic write**: tulis ke `.tmp.PID` lalu `rename()` — atomic di filesystem yang sama
- **Empty result guard**: kalau query kosong (DB bermasalah), jangan overwrite file yang ada
- **Error handling**: try/catch dengan logging + cleanup temp file
- **Null abstrak guard**: cek `empty($row['abstrak'])` sebelum buat URL

### 4.2 Cron container — Healthcheck + wait-for-db entrypoint

Buat `docker/cron/entrypoint.sh`:

```sh
#!/bin/sh -e
# Wait for database before starting crond

MAX_RETRIES=30
RETRY_COUNT=0

echo "[cron-entrypoint] Waiting for database..."

while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    if php /var/www/yii migrate/history 1 --interactive=0 >/dev/null 2>&1; then
        echo "[cron-entrypoint] Database ready."
        break
    fi
    RETRY_COUNT=$((RETRY_COUNT + 1))
    echo "[cron-entrypoint] Database not ready, retrying... ($RETRY_COUNT/$MAX_RETRIES)"
    sleep 2
done

if [ $RETRY_COUNT -ge $MAX_RETRIES ]; then
    echo "[cron-entrypoint] WARNING: Database not ready. Starting cron anyway — jobs may fail until DB is available."
fi

exec crond -f -l 2
```

Update `Dockerfile.cron`:

```dockerfile
# ... existing stages ...

COPY docker/cron/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

HEALTHCHECK --interval=60s --timeout=10s --retries=3 \
    CMD test -f /var/www/feed/document.json || exit 1

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
```

### 4.3 Generated compose — Cron service improvements

Tambahkan di generated docker-compose.yml untuk cron service:

```yaml
cron:
    # ... existing config ...
    stop_grace_period: 30s
    depends_on:
      db:
        condition: service_healthy
    healthcheck:
      test: ["CMD", "test", "-f", "/var/www/feed/document.json"]
      interval: 60s
      timeout: 10s
      retries: 3
      start_period: 120s
```

### 4.4 Crontab — Automatic retry

```crontab
# Run feed/generate-document every day at 2:00 AM
0 2 * * * php /var/www/yii feed/generate-document >> /var/log/cron.log 2>&1

# Retry at 3:00 AM if the first run failed (file doesn't exist or is empty)
0 3 * * * test -s /var/www/feed/document.json || php /var/www/yii feed/generate-document >> /var/log/cron.log 2>&1
```

`test -s` memeriksa file ada dan tidak kosong. Jika jam 2 gagal (file kosong/tidak ada), jam 3 akan retry.

---

## Files Changed Summary

| File | Change |
|---|---|
| `install.sh` | Self-save mechanism, ordered update sequence, stop cron before app, version check in patch function |
| `update.sh` | Self-heal: download install.sh if missing |
| `Dockerfile` | Add `.ildis_patched` marker file |
| `Dockerfile.cron` | Add entrypoint, healthcheck, stop_grace_period |
| `docker/cron/entrypoint.sh` | **New file**: wait-for-db before crond |
| `docker/cron/crontab` | Add retry at 3 AM |
| `docker/ildis-init.sh` | Change migrate failure from `exit 1` to warning (non-fatal) |
| `console/controllers/FeedController.php` | Atomic write, error handling, null guard |
| `frontend/config/main.php` | Set `autoInstallTables => false` in source |
| `console/migrations/m250514_121356_create_table_report.php` | Fix `string(100)->notNull()` to `text()->notNull()` |
| `console/migrations/m260507_000001_create_table_visitor_log.php` | Add `namespace console\migrations;` |
| `console/migrations/m260507_000002_create_table_visitor_stats.php` | Add `namespace console\migrations;` |
| `console/migrations/m260507_000003_insert_visitor_report_menu.php` | Add `namespace console\migrations;` |
| `common/config/params.php` | Read `RECAPTCHA_ENABLED` from env var |
| `common/models/LoginForm.php` | Read reCAPTCHA config from env |
| `backend/views/site/login.php` | Conditional reCAPTCHA rendering from env |

## Out of Scope

- Removing `.env` from git (separate security fix)
- Removing hardcoded passwords from `docker-compose.cron.yml` (separate cleanup)
- CSP hardening in nginx config (separate security improvement)
- docker-compose.cron.yml deprecation (will be addressed when generated compose fully replaces it)