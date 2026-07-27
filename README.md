# ILDIS (Indonesian Law Documentation Information System)

ILDIS adalah sistem informasi dokumentasi hukum Indonesia yang dikembangkan untuk membantu anggota JDIHN (Jaringan Dokumentasi dan Informasi Hukum Nasional) mengelola data dokumen hukum secara mandiri, efisien, dan sesuai standar.

## Tentang ILDIS

ILDIS adalah aplikasi terbuka yang memungkinkan instansi pemerintah pusat maupun daerah untuk:

- Mengelola metadata dokumen hukum (judul, jenis, nomor, tahun, dll)
- Mengunggah file dokumen hukum (PDF, dsb)
- Menyediakan API publik dan terstandar untuk integrasi ke portal JDIHN
- Menyediakan antarmuka pengguna yang sederhana
- Mengelola peran dan pengguna untuk tim pengelola dokumentasi hukum

Kami sedang dalam proses menyesuaikan ILDIS agar bisa menggunakan dependensi terbaru tanpa breaking compatibility. Kontribusi untuk refactor dan modernisasi sangat dibutuhkan.

## Persyaratan Teknis

- PHP 8.3 atau lebih baru
- PostgreSQL 16
- Docker Engine (atau Podman)
- Docker Compose (atau Podman Compose)

## Instalasi dengan Docker

### Persiapan

Clone repositori ini:

```bash
git clone https://github.com/bphndigitalservice/ildsrv.git
cd ildsrv
```

### Langkah 1 - Konfigurasi Environment

Salin file environment:

```bash
cp .env.example .env
```

Edit `.env` dan sesuaikan konfigurasi. Lihat `.env.example` untuk referensi. Pastikan cookie validation keys terisi dengan nilai acak (generate dengan `php -r "echo bin2hex(random_bytes(32));"`).

### Langkah 2 - Install Dependencies

```bash
# Matikan pemblokiran advisory sementara (untuk menghindari error CVE)
composer config audit.block-insecure false

# Install dependensi
composer update --ignore-platform-reqs --no-dev
```

### Langkah 3 - Build Image dan Jalankan Container

```bash
# Build image aplikasi
DOCKER_BUILDKIT=0 docker compose build app

# Jalankan container
docker compose up -d
```

### Langkah 4 - Tunggu Database Siap

Cek status container:

```bash
docker compose ps
```

Pastikan `ildis_postgres` berstatus **healthy** dan `ildis_app` berstatus **healthy** atau **running**.

### Langkah 5 - Import Database

```bash
psql -h localhost -U ildis -d ildis_v4 -f DATABASE/ildis_v4.sql
```

Masukkan password sesuai dengan nilai `DB_PASSWORD` yang diatur di `.env`.

### Langkah 6 - Inisialisasi Migrasi dan Data

Jalankan migrasi yang tersisa:

```bash
docker compose exec app php yii migrate/up --interactive=0
```

### Langkah 7 - Akses Aplikasi

Buka browser: http://localhost:8080

## Instalasi Cepat (via Script)

```bash
curl -fsSL https://raw.githubusercontent.com/bphndigitalservice/ildis/main/install.sh | bash
```

Skrip akan mendeteksi Docker Compose atau Podman Compose secara otomatis.

## Update

```bash
./update.sh              # Update ke versi terbaru
./update.sh --check      # Cek versi yang tersedia
./update.sh --help       # Lihat semua opsi
```

## Catatan Penting

- Migrasi database sudah otomatis dijalankan oleh `ildis-init.sh` saat container pertama kali startup
- Jika migrasi gagal, jalankan manual: `docker compose exec app php yii migrate/up --interactive=0`
- Password default user: cek di file seeder atau database
- File statis (gambar, CSS) perlu di-copy ke container jika ada perubahan. Solusi permanent: tambahkan volume mount di `docker-compose.yml`

## TODO

- [x] Membuat instalasi di production lebih mudah (misalnya dengan Docker atau installer GUI sederhana)
- [x] Update library dengan CVE agar sistem lebih aman dan terjaga dari kerentanan
- [x] Panduan pengembangan lokal
- [x] Update ke Versi Yii 2.0.52
- [x] Update ke PHP 8.3
- [x] Migration Script untuk database yang sudah ada
- [x] Migrasi dari MySQL ke PostgreSQL
- [ ] Headless mode untuk flexibilitas frontend
- [ ] Dokumentasi API yang lebih lengkap

## Kontribusi

Lihat [CONTRIBUTING.md](CONTRIBUTING.md) untuk panduan kontribusi.

---

ILDIS dikembangkan oleh **Pusat Data dan Teknologi Informasi** & **Badan Pembinaan Hukum Nasional** Kementerian Hukum Republik Indonesia sebagai bentuk dukungan terhadap keterbukaan informasi hukum dan penguatan kelembagaan JDIHN.
