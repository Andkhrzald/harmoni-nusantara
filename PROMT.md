### Prompt for AI Model

**Role:** Professional Laravel Fullstack Developer.

**Task:** Implement API Integration from External Service to Laravel (Backend to Frontend).

**Context & Reference:**

1. **Source Logic:** Refer to `@TECHSPEC.md` lines 75-84 for the specific business logic and endpoint requirements.
2. **External Documentation:** Access via **MCP context7** to understand the authentication, request headers, payload structure, and response schema of the third-party service.
3. **Current Stack:** Laravel (Backend) + Blade.php (Frontend).

**Instructions:**

1. **Service Layer:** Buat sebuah Service Class di `app/Services` untuk menangani logika fetching. Gunakan `Illuminate\Support\Facades\Http` (Laravel HTTP Client). Pastikan ada error handling (`try-catch`) dan logging jika request gagal.
2. **Controller Integration:** Panggil Service tersebut di Controller. Pastikan data hasil fetching di-passing ke view dalam bentuk array atau collection yang bersih.
3. **Frontend (Blade):** Integrasikan data ke `blade.php`. Gunakan direktif `@foreach` atau `@if` untuk handle kondisi jika data kosong. Tampilkan data sesuai struktur UI yang ada.
4. **Security:** Pastikan API Key atau Sensitive Data diambil dari file `.env`, jangan di-hardcode.

**Expected Output:**

* Kode untuk Service Class.
* Kode untuk Controller method.
* Cuplikan kode integrasi pada file Blade.php.
* Langkah singkat verifikasi untuk memastikan koneksi berhasil.

**Constraint:** Gunakan kode yang *clean*, *modern*, dan prioritaskan *readability* agar mudah di-maintain.