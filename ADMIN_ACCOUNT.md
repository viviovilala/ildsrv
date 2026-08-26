# Akun Admin ILDIS

## Informasi Login

**Username:** admin  
**Password:** Admin123!  
**Email:** muchtarsani@gmail.com  
**Status:** Active

## Akses

URL Login: http://localhost:8080/site/login

## Perubahan yang Telah Dilakukan

### Frontend & UI/UX Improvements
- Perbaikan layout responsif untuk halaman detail dokumen
- Redesign login page dengan logo UPN branding
- Tingkatkan aksesibilitas (a11y) dengan improvement CSS
- Optimasi document viewer toolbar
- Perbaikan spacing dan padding di berbagai halaman
- Update footer styling untuk konsistensi desain
- Optimasi responsive design untuk tablet dan mobile

### Logo Updates
- Login page menggunakan logo UPN (upnvjt-logo-yell.png)
- Ukuran logo disesuaikan 200px untuk proporsi lebih baik
- Alt text updated untuk konsistensi branding

### Docker & Database
- Containers di-restart dan berjalan dengan status healthy
- PostgreSQL database ildis_v4 siap digunakan
- Admin user sudah diaktifkan dengan password baru

## Cara Mengakses Backend Admin

Setelah login dengan akun admin, Anda dapat mengakses:
- Backend Admin Panel: http://localhost:8080/backend/
- Manajemen User: http://localhost:8080/backend/user
- Manajemen Dokumen: http://localhost:8080/backend/dokumen

## Notes

- Jika lupa password, password hash dapat diupdate langsung di database
- Auth key: 0b5ab1e4a896536e43b3c4d0c07e03fdb2cf23ce9324e5e4161e4a827a2b710b
- Password hash: $2y$10$aISssX5ZvZQmHCh.gigck./JmSkko7HV26a5Q0W9p58ong4acTG.S
