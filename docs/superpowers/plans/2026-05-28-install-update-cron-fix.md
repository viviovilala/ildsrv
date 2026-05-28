# ILDIS Install/Update/Cron Robustness Fix — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Fix install.sh persistence, seamless update flow, docker/migrate patching robustness, and cron document.json reliability.

**Architecture:** Approach A — fix each problem in-place with minimal architecture changes. Self-save install.sh at startup, ordered container restart during updates, version-checked patching with deprecation, and atomic writes for document.json generation.

**Tech Stack:** Bash (install.sh, entrypoint.sh), PHP/Yii2 (FeedController), Docker (Dockerfile, Dockerfile.cron, docker-compose.yml)

---

## Files Structure

| Action | File | Responsibility |
|--------|------|----------------|
| Modify | `install.sh` | Self-save, ordered update flow, version check in patch function |
| Modify | `update.sh` | Self-heal: download install.sh if missing |
| Modify | `Dockerfile` | Add `.ildis_patched` marker |
| Modify | `Dockerfile.cron` | Add entrypoint, healthcheck |
| Create | `docker/cron/entrypoint.sh` | Wait-for-db before crond starts |
| Modify | `docker/cron/crontab` | Add 3 AM retry |
| Modify | `docker/ildis-init.sh` | Non-fatal migration failure |
| Modify | `console/controllers/FeedController.php` | Atomic write, error handling, null guard |

---

### Task 1: FeedController — Atomic write + error handling

**Files:**
- Modify: `console/controllers/FeedController.php`

- [ ] **Step 1: Replace FeedController::actionGenerateDocument with atomic write version**

```php
<?php

namespace console\controllers;

use backend\models\DokumenJdih;
use yii\console\Controller;
use yii\helpers\FileHelper;

class FeedController extends Controller
{
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
}
```

- [ ] **Step 2: Verify syntax**

Run: `php -l console/controllers/FeedController.php`
Expected: `No syntax errors detected`

- [ ] **Step 3: Commit**

```bash
git add console/controllers/FeedController.php
git commit -m "fix: atomic write + error handling in FeedController::actionGenerateDocument"
```

---

### Task 2: Cron container — Entrypoint + healthcheck + retry

**Files:**
- Create: `docker/cron/entrypoint.sh`
- Modify: `Dockerfile.cron`
- Modify: `docker/cron/crontab`

- [ ] **Step 1: Create docker/cron/entrypoint.sh**

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
    echo "[cron-entrypoint] WARNING: Database not ready. Starting cron anyway - jobs may fail until DB is available."
fi

exec crond -f -l 2
```

- [ ] **Step 2: Update docker/cron/crontab**

Replace the entire file with:

```crontab
# Run feed/generate-document every day at 2:00 AM
0 2 * * * php /var/www/yii feed/generate-document >> /var/log/cron.log 2>&1

# Retry at 3:00 AM if the first run failed (file doesn't exist or is empty)
0 3 * * * test -s /var/www/feed/document.json || php /var/www/yii feed/generate-document >> /var/log/cron.log 2>&1
```

- [ ] **Step 3: Modify Dockerfile.cron**

Find the `CMD ["crond", "-f", "-l", "2"]` line (last line) and the surrounding section. Replace the bottom section so it becomes:

```dockerfile
COPY docker/cron/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

HEALTHCHECK --interval=60s --timeout=10s --retries=3 --start-period=120s \
    CMD test -f /var/www/feed/document.json || exit 1

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
```

The CMD line should be removed since `entrypoint.sh` ends with `exec crond -f -l 2`.

- [ ] **Step 4: Verify the Dockerfile.cron is valid**

Read the full file and confirm it has no syntax issues.

- [ ] **Step 5: Commit**

```bash
git add docker/cron/entrypoint.sh docker/cron/crontab Dockerfile.cron
git commit -m "fix: add wait-for-db entrypoint, healthcheck, and retry to cron container"
```

---

### Task 3: ildis-init.sh — Non-fatal migration failure

**Files:**
- Modify: `docker/ildis-init.sh`

- [ ] **Step 1: Change migration failure from exit 1 to warning**

Find the section that starts with `if ! php /var/www/yii migrate/up --interactive=0; then` (around line 33-36). Replace:

```sh
if ! php /var/www/yii migrate/up --interactive=0; then
    s6-echo "[ildis-init] ERROR: Database migrations failed."
    s6-echo "[ildis-init] Check logs for details. Application may not function correctly."
    exit 1
fi
```

With:

```sh
if ! php /var/www/yii migrate/up --interactive=0; then
    s6-echo "[ildis-init] WARNING: Database migrations failed."
    s6-echo "[ildis-init] Application will start. Run migrate manually when DB is ready:"
    s6-echo "[ildis-init]   php /var/www/yii migrate/up --interactive=0"
fi
```

- [ ] **Step 2: Commit**

```bash
git add docker/ildis-init.sh
git commit -m "fix: non-fatal migration failure in ildis-init to prevent php-fpm crash"
```

---

### Task 4: Dockerfile — Add .ildis_patched marker

**Files:**
- Modify: `Dockerfile`

- [ ] **Step 1: Add marker file before ENTRYPOINT**

Find the line `EXPOSE 80` (around line 115). Add after it, before `ENTRYPOINT ["/init"]`:

```dockerfile
RUN touch /var/www/.ildis_patched
```

- [ ] **Step 2: Commit**

```bash
git add Dockerfile
git commit -m "fix: add .ildis_patched marker to skip runtime patching on new images"
```

---

### Task 5: install.sh — Self-save mechanism

**Files:**
- Modify: `install.sh`

- [ ] **Step 1: Add self-save logic at the start of main()**

Find the `main()` function (starts at line 1798). After the line `echo ""` (line 1800), before the `if [ "${ACTION}" = "update" ]; then` block, insert:

```bash
    # Self-save: if running via pipe (curl | bash), save to disk before continuing
    SELF_SOURCE="${BASH_SOURCE[0]}"
    if [ ! -f "${SELF_SOURCE}" ] || [ ! -s "${SELF_SOURCE}" ]; then
        SAVE_DIR="${INSTALL_DIR:-${DEFAULT_INSTALL_DIR}}"
        mkdir -p "${SAVE_DIR}"
        SAVE_PATH="${SAVE_DIR}/install.sh"
        info "Menyimpan install.sh ke ${SAVE_PATH}..."
        if curl -fsSL "https://raw.githubusercontent.com/${GITHUB_REPO}/main/install.sh" -o "${SAVE_PATH}" 2>/dev/null && [ -s "${SAVE_PATH}" ]; then
            chmod +x "${SAVE_PATH}"
            success "install.sh disimpan"
            exec "${SAVE_PATH}" "$@"
        else
            rm -f "${SAVE_PATH}" 2>/dev/null || true
            warn "Tidak dapat mengunduh install.sh. Melanjutkan dari pipe."
        fi
    fi
```

- [ ] **Step 2: Add safety net at the end of do_install()**

Find the end of `do_install()` function. Before the closing `}`, after the `print_recaptcha_env_help` call, add:

```bash
    # Safety net: ensure install.sh is available on disk for future updates
    if [ ! -f "${INSTALL_DIR}/install.sh" ]; then
        cp "${BASH_SOURCE[0]}" "${INSTALL_DIR}/install.sh" 2>/dev/null && chmod +x "${INSTALL_DIR}/install.sh" && success "install.sh disalin ke ${INSTALL_DIR}/"
    fi
```

- [ ] **Step 3: Add persistent save after self-update in do_update()**

Find the self-update section in `do_update()`. After the line `success "install.sh sudah terbaru"` (around line 1617) and also after the `exec "${self_path}" --update --dir "${INSTALL_DIR}"` path is resolved, add a persistent save. Find the block that starts with `info "Memuat konfigurasi yang ada..."` (around line 1634) and add before it:

```bash
    # Ensure install.sh is saved to installation directory for future updates
    local self_path
    self_path="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/$(basename "${BASH_SOURCE[0]}")"
    if [ ! -f "${INSTALL_DIR}/install.sh" ]; then
        cp "${self_path}" "${INSTALL_DIR}/install.sh" 2>/dev/null && chmod +x "${INSTALL_DIR}/install.sh" && success "install.sh disalin ke ${INSTALL_DIR}/"
    fi
```

- [ ] **Step 4: Commit**

```bash
git add install.sh
git commit -m "fix: self-save install.sh to disk for future updates"
```

---

### Task 6: install.sh — Ordered update flow

**Files:**
- Modify: `install.sh`

This task modifies the `do_update()` function to implement ordered container restarts.

- [ ] **Step 1: Add stop cron before app stop**

Find the section after successful backup in `do_update()`. After the backup success/warning block, after the line `fi` that closes the backup check, find the `info "Mengunduh image terbaru..."` line (around line 1708). Before `info "Memulai ulang container ILDIS..."`, add ordered stop. Find:

```bash
    info "Mengunduh image terbaru..."
    if ! run_compose_update "${compose_file}" "${env_file}" pull 2>&1; then
        fail "Gagal mengunduh image."
    fi
    success "Image diperbarui"

    if [ -f "${INSTALL_DIR}/nginx/default.conf" ]; then
        generate_nginx_config
    fi
    if [ -d "${INSTALL_DIR}/traefik" ]; then
        generate_traefik_config
    fi

    info "Memulai ulang container ILDIS..."
```

Replace from `info "Memulai ulang container ILDIS..."` to the end of the health check and migration block (the section that currently does `up -d`, waits for DB, waits for app, and runs migrate). Find everything from `info "Memulai ulang container ILDIS..."` through the final `success "Aplikasi merespons"` / warning, the migrate block, and the VERSION write. Replace that entire block with:

```bash
    info "Menghentikan cron container (mencegah write setengah jadi)..."
    run_compose_update "${compose_file}" "${env_file}" stop cron 2>/dev/null || true

    info "Menghentikan aplikasi..."
    run_compose_update "${compose_file}" "${env_file}" stop app 2>/dev/null || true

    info "Memulai ulang container ILDIS..."
    if ! run_compose_update "${compose_file}" "${env_file}" up -d --force-recreate app 2>&1; then
        fail "Gagal memulai ulang container."
    fi

    if [ "${DB_TYPE:-mariadb}" != "external" ]; then
        info "Menunggu database..."
        local db_ready=false
        for i in $(seq 1 "${MYSQL_HEALTH_RETRIES}"); do
            if run_compose_update "${compose_file}" "${env_file}" exec -T db healthcheck.sh --connect --innodb_initialized &>/dev/null 2>&1 || \
               run_compose_update "${compose_file}" "${env_file}" exec -T db mysqladmin ping -h localhost &>/dev/null 2>&1; then
                db_ready=true
                break
            fi
            sleep "${MYSQL_HEALTH_INTERVAL}"
        done
        [ "${db_ready}" = true ] && success "Database siap" || warn "Database belum siap"
    fi

    local app_port="${PORT:-${DEFAULT_PORT}}"
    info "Menunggu aplikasi di port ${app_port}..."

    local app_ready=false
    for i in $(seq 1 "${HEALTH_RETRIES}"); do
        if curl -sf "http://localhost:${app_port}/" >/dev/null 2>&1; then
            app_ready=true
            break
        fi
        sleep "${HEALTH_INTERVAL}"
    done

    if [ "${app_ready}" = false ]; then
        echo ""
        echo -e "${YELLOW}Aplikasi tidak merespons setelah pembaruan.${NC}"
        echo "Periksa log: ${COMPOSE_CMD} -f ${compose_file} logs app"
    else
        success "Aplikasi merespons"
    fi

    info "Menjalankan migrasi database..."
    if run_compose_update "${compose_file}" "${env_file}" exec -T app php yii migrate/up --interactive=0 2>&1; then
        success "Migrasi diterapkan"
    else
        warn "Perintah migrasi mengembalikan non-zero. Mungkin normal jika tidak ada yang tertunda."
    fi

    patch_app_for_migrations

    info "Memulai cron container..."
    run_compose_update "${compose_file}" "${env_file}" up -d --force-recreate cron 2>&1 || true

    echo "${latest_version}" > "${INSTALL_DIR}/${VERSION_FILE}"
```

- [ ] **Step 2: Commit**

```bash
git add install.sh
git commit -m "fix: ordered update flow - stop cron first, migrate, then restart cron"
```

---

### Task 7: install.sh — Version check in patch_app_for_migrations()

**Files:**
- Modify: `install.sh`

- [ ] **Step 1: Add version check at the start of patch_app_for_migrations()**

Find the `patch_app_for_migrations()` function. After the `info "Menyesuaikan migrasi di container..."` line, add:

```bash
    # Skip jika image sudah contain fix (marker file exists)
    if run_compose exec -T app test -f /var/www/.ildis_patched 2>/dev/null; then
        info "Image sudah di-patch, melewati..."
        return 0
    fi

    warn "Runtime patching masih diperlukan. Update ke image terbaru untuk menghilangkan kebutuhan patching."
```

- [ ] **Step 2: Add marker file creation after patching**

Find the line `success "Penyesuaian migrasi selesai"` at the end of `patch_app_for_migrations()`. Just before it, add:

```bash
    # Tandai bahwa patch sudah di-apply (untuk image lama yang tidak punya marker)
    run_compose exec -T app touch /var/www/.ildis_patched 2>/dev/null || true
```

- [ ] **Step 3: Commit**

```bash
git add install.sh
git commit -m "fix: skip runtime patching when image contains .ildis_patched marker"
```

---

### Task 8: update.sh — Self-heal download

**Files:**
- Modify: `update.sh`

- [ ] **Step 1: Add self-heal download before delegating to install.sh**

Replace the entire content of `update.sh` with:

```bash
#!/usr/bin/env bash
#
# Skrip Pembaruan ILDIS (wrapper)
# Skrip ini telah digantikan oleh install.sh --update.
# Dipertahankan untuk kompatibilitas mundur.
#

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

if [ ! -f "${SCRIPT_DIR}/install.sh" ]; then
    echo "install.sh tidak ditemukan di ${SCRIPT_DIR}, mengunduh dari GitHub..."
    curl -fsSL "https://raw.githubusercontent.com/bphndigitalservice/ildis/main/install.sh" -o "${SCRIPT_DIR}/install.sh"
    if [ -f "${SCRIPT_DIR}/install.sh" ]; then
        chmod +x "${SCRIPT_DIR}/install.sh"
        echo "install.sh berhasil diunduh."
    else
        echo "KESALAHAN: Gagal mengunduh install.sh."
        echo "Unduh manual dari: https://github.com/bphndigitalservice/ildis"
        exit 1
    fi
fi

exec "${SCRIPT_DIR}/install.sh" --update "$@"
```

- [ ] **Step 2: Commit**

```bash
git add update.sh
git commit -m "fix: self-heal update.sh downloads install.sh if missing"
```

---

### Task 9: Generated compose — Add stop_grace_period for cron

**Files:**
- Modify: `install.sh` (generated docker-compose.yml)

This task modifies the `generate_compose()` function in `install.sh` to include `stop_grace_period: 30s` and the healthcheck for the cron service in all compose file variants.

- [ ] **Step 1: Add stop_grace_period and healthcheck to cron service in generate_compose()**

Find all cron service blocks in `generate_compose()` (there are multiple variants: external DB without Traefik, internal DB without Traefik, external DB with Traefik, internal DB with Traefik). Each cron service block looks like:

```yaml
  cron:
    image: ghcr.io/bphndigitalservice/ildis-cron:${ILDIS_IMAGE_TAG:-latest}
    container_name: ildis_cron
    restart: unless-stopped
    volumes:
      - feed_data:/var/www/feed
    environment:
      ...
```

For each cron service block, after the `environment:` section, add:

```yaml
    stop_grace_period: 30s
    healthcheck:
      test: ["CMD", "test", "-f", "/var/www/feed/document.json"]
      interval: 60s
      timeout: 10s
      retries: 3
      start_period: 120s
```

This must be added in ALL cron service blocks throughout generate_compose(). There are approximately 4 variants (external/internal DB × reverse-proxy/traefik). Search for every occurrence of `container_name: ildis_cron` and add the fields after the environment block for each.

- [ ] **Step 2: Verify the generated compose would be valid YAML**

Review that the indentation of added fields is consistent (6 spaces for fields under the cron service, matching existing `restart:` and `environment:` indentation).

- [ ] **Step 3: Commit**

```bash
git add install.sh
git commit -m "fix: add stop_grace_period and healthcheck to cron service in generated compose"
```

---

### Task 10: ildis-init.sh — Also add init marker for the patch check

**Files:**
- Modify: `docker/ildis-init.sh`

Currently the init script runs migrations. After successful migration, it should not interfere. No additional changes needed beyond Task 3 (non-fatal failure). This task is a no-op confirmation.

- [ ] **Step 1: Verify docker/ildis-init.sh changes from Task 3 are correct**

Read the file and confirm the migration failure handling is now non-fatal (exit removed, warning only).

- [ ] **Step 2: No commit needed — already committed in Task 3**

---

## Self-Review Checklist

1. **Spec coverage**: Each of the 4 design sections has corresponding tasks:
   - Section 1 (install.sh persistence) → Tasks 5, 8
   - Section 2 (seamless update) → Tasks 6, 9
   - Section 3 (docker/migrate patching) → Tasks 4, 7
   - Section 4 (cron document.json) → Tasks 1, 2, 3

2. **Placeholder scan**: No TBD/TODO/fill-in-later found. All steps contain full code.

3. **Type consistency**: All file paths, function names, and variable names are consistent across tasks. The `.ildis_patched` marker is referenced in both Dockerfile (Task 4) and install.sh (Task 7). The `entrypoint.sh` created in Task 2 is referenced in Dockerfile.cron modifications.

4. **Source code verification**: The source code already has the fixes that runtime patching addresses (`autoInstallTables => false`, `migrationNamespaces`, visitor migration namespaces, report migration `text()` columns, reCAPTCHA env vars). The `.ildis_patched` marker in new images will skip patching since these are already fixed in source. Old deployed images without the marker will still get patched via the existing patch function.

5. **One concern**: The `generate_compose()` function in `install.sh` has 4 variants of the compose file. Task 9 requires careful editing in all 4 places. Consider using `replaceAll` or searching for each variant individually.