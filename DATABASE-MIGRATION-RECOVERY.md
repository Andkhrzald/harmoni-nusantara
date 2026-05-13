# Supabase PostgreSQL Migration Recovery

## Ringkasan

Dokumentasi ini menjelaskan penyebab dan solusi untuk error migrasi Laravel di Supabase PostgreSQL:

- `SQLSTATE[25P02]: In failed sql transaction`
- Error terjadi saat menjalankan `php artisan migrate:fresh`
- Kegagalan muncul karena transaksi sebelumnya berada dalam status `aborted`

## Gejala

Saat migrasi dijalankan, Laravel mengeluarkan error pada statement DDL berikut:

- `create table "users" (...)`
- `create table "password_reset_tokens" (...)`
- `create table "sessions" (...)`

Namun statement tersebut bukan penyebab utama. Penyebab sebenarnya adalah status transaksi yang sudah gagal sebelum perintah terakhir dijalankan.

## Analisis

Langkah analisis yang dilakukan:

1. Periksa file migrasi `database/migrations/0001_01_01_000000_create_users_table.php`.
2. Jalankan langsung DDL mentah di koneksi Supabase untuk memastikan SQL valid.
3. Uji `Schema::create()` dan `DB::statement()` dalam transaksi.
4. Verifikasi tidak ada tabel sementara yang tersisa setelah kegagalan.

Hasilnya menunjukkan bahwa SQL migrasi valid, dan masalah muncul karena keadaan database yang tersisa dari percobaan migrasi sebelumnya.

## Solusi

Untuk memperbaiki kondisi database Supabase yang bermasalah, lakukan langkah berikut:

```bash
php artisan tinker --execute "DB::statement('drop schema public cascade'); DB::statement('create schema public');"
php artisan migrate:fresh
```

Jika hanya ingin menjalankan satu migrasi untuk verifikasi:

```bash
php artisan migrate --path=database/migrations/0001_01_01_000000_create_users_table.php --force
```

## Penjelasan

`SQLSTATE[25P02]` adalah error PostgreSQL yang muncul ketika sebuah transaksi masuk ke status `aborted`.
Setiap perintah SQL berikutnya dalam transaksi akan ditolak sampai transaksi tersebut selesai.

Di Laravel, migrasi default dieksekusi dalam transaksi pada database PostgreSQL. Jika satu statement DDL gagal, seluruh transaksi akan abort.

## Kesimpulan

- Tidak perlu mengubah file migrasi `users`.
- Perbaikan dilakukan pada status database Supabase.
- Recovery yang berhasil adalah mereset schema `public` sepenuhnya lalu menjalankan migrasi ulang.

## Rekomendasi

- Hindari migrasi `fresh` pada lingkungan produksi tanpa backup.
- Gunakan `drop schema public cascade` hanya untuk database development/domains test.
- Jika terjadi error transaksi di Supabase, reset schema dan ulang migrasi.
