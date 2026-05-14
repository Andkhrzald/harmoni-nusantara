# Progress Hari Ini — by Andikha

## Ringkasan Pekerjaan

---

### ✅ Bugs yang Diperbaiki

| Bug | File | Fix |
|-----|------|-----|
| `$content->religionCategory->name` tidak ada | `education/show.blade.php:15` | Ganti jadi `$content->religion->name` |
| `$content->type` tidak ada (harus `content_type`) | `education/show.blade.php:18` | Ganti jadi `$content->content_type` |
| `$content->source_url` tidak ada (harus `youtube_video_id`) | `education/show.blade.php:18-22` | Ganti dengan embed YouTube dari `youtube_video_id` |
| `$video->channel` tidak ada di schema | `education/gallery.blade.php:27` | Hapus, ganti dengan relasi `religion->name` |
| Semua agama pakai emoji 🕉️ (simbol Hindu) | `education/index.blade.php:16` | Ganti dengan Material Symbols spesifik per agama |
| `DatabaseSeeder` tidak panggil `EducationContentSeeder` | `database/seeders/DatabaseSeeder.php` | Tambah `$this->call(EducationContentSeeder::class)` |

---

### 🆕 Fitur Baru

#### 1. EducationContentSeeder
**File baru:** `database/seeders/EducationContentSeeder.php`
- **8 konten Islam** (5 artikel + 3 video) dengan konten edukatif
- Artikel: Rukun Islam, Tata Cara Wudhu, Keutamaan Al-Quran Ramadhan, Doa Harian Anak, Sejarah Masjidil Haram
- Video: Keindahan Shalat Subuh, Masjid Nabawi Virtual, Belajar Tajwid
- Semua berstatus `approved` dan punya `views_count` realistis (98-723)

#### 2. Education Show (Detail Konten)
**Rewrite:** `resources/views/education/show.blade.php`
- Meta info: agama, views, tanggal, penulis
- YouTube embed responsif (16:9) dari `youtube_video_id`
- Badge tipe konten (Video/Artikel) + age group
- Tombol TTS "Dengarkan" (baca teks dengan suara)
- Tombol "Kembali" ke halaman sebelumnya
- Tampilan bersih dengan `prose` typography

#### 3. Education Gallery (Video)
**Rewrite:** `resources/views/education/gallery.blade.php`
- Card grid dengan thumbnail + hover zoom
- Badge "Tonton" overlay + label agama
- Pagination (jika ada banyak video)

#### 4. Education Index (Halaman Utama)
**Rewrite:** `resources/views/education/index.blade.php`
- **6 card agama dengan ikon & gradasi warna unik**:
  - Islam → mosque hijau | Kristen → church biru | Katolik → church ungu
  - Hindu → temple_hindu orange | Buddha → temple_buddhist amber | Konghucu → temple_buddhist merah
- Featured content terbaru (3 kolom grid)
- Quick links: Galeri Video + Wisata Virtual

#### 5. Education by Religion (Halaman per Agama)
**Rewrite:** `resources/views/education/religion.blade.php`
- **Hero section** dengan gradasi warna sesuai agama + ikon besar + deskripsi dari DB
- **Quick links kontekstual**: untuk Islam, muncul tombol "Jadwal Sholat" & "Panduan Ibadah"
- **Filter tabs**: Semua | Artikel | Video (memfilter konten via query parameter)
- **Search bar**: cari konten berdasarkan judul/isi
- **Hasil kosong**: tampilan "Konten Tidak Ditemukan" dengan opsi reset filter
- **Pagination** dengan query string

#### 6. Controller Enhancement
**Edit:** `app/Http/Controllers/EducationController.php`
- `byReligion()` method sekarang menerima `Request $request`
- Mendukung parameter `?filter=article|video`
- Mendukung parameter `?search=keyword`

---

### 📁 Nyambung End-to-End

```
User klik "Al-Qur'an" di navbar Islam
  → route('edukasi.religion', 'islam') → GET /edukasi/islam
  → EducationController@byReligion('islam', request)
  → ReligionCategory::where('slug','islam')->firstOrFail() ✅ (dari seeder)
  → EducationContent::where('religion_id',1)->where('status','approved')->...
  → education.religion view ✅ (hero + filter + grid)
  → Klik card → education.show view ✅ (detail + TTS + video embed)

Seeder sudah jalan → 8 konten Islam di DB
Semua views render OK ✅ (20+ file tested, 0 error)
```

---

### 🔧 Critical Fixes

#### 1. Navbar Dispatcher — Hanya tampil jika ada slug agama
**File:** `resources/views/components/navbar.blade.php`
- **SEBELUMNYA (BUG):** `$slug = ... ?? 'islam'` — fallback ke Islam. Jadi halaman `/edukasi` (tanpa slug) menampilkan navbar Islam dengan ikon masjid + ﷽.
- **SEKARANG:** `$slug = $agama ?? ($route ? $route->parameter('slug') : null)` — tanpa fallback. Halaman tanpa slug agama (seperti `/edukasi`, `/ibadah`, `/dashboard`) menampilkan Breeze nav standar.

#### 2. Guide & Etiquette — Konten spesifik per agama
**File:** `resources/views/worship/guide.blade.php`, `resources/views/worship/etiquette.blade.php`
- **SEBELUMNYA:** Tab navigasi 6 agama selalu muncul. Saat klik dari navbar Islam, tab langsung pindah ke Kristen tanpa harus melalui halaman index.
- **SEKARANG:** Ketika `$religion` diberikan (via route slug), tab 6 agama **disembunyikan**. Hanya konten agama tersebut yang tampil + tombol "← Semua Panduan Ibadah" untuk kembali ke index.
- Jika `$religion = null` (akses `/ibadah/panduan` tanpa slug), tampilkan grid 6 agama sebagai pilihan.

#### 3. Welcome Page — Tambah CTA "Jelajahi Semua Edukasi"
**File:** `resources/views/welcome.blade.php`
- Section baru di antara Faith Diversity & Widget Section
- Tombol "Jelajahi Semua Edukasi" → `route('edukasi.index')` → `/edukasi`

---

### 🛐 Worship Section — Jadwal Sholat, Panduan, & Etiket

#### Jadwal Sholat (`/ibadah/jadwal`)
**Rewrite:** `resources/views/worship/schedule.blade.php`
- Hero hijau dengan ikon masjid, kota, dan tanggal
- City selector dengan 8 kota (Jakarta, Bandung, Surabaya, Medan, Makassar, Yogyakarta, Semarang, Palembang)
- **Next prayer badge** ("Berikutnya: Magrib 17:45") + card dengan ring highlight + label "SEKARANG"
- Card waktu sholat 6 kolom dengan ikon Material + gradient untuk waktu berikutnya
- Fallback statis jika API gagal (tidak perlu error)
- Hari besar bulan ini dari Calendarific API

#### Panduan Ibadah (`/ibadah/panduan/{religion}`)
**Rewrite:** `resources/views/worship/guide.blade.php`
- **⬅️ SEBELUMNYA (BUG):** Tab navigasi menggunakan `request('religion')` yang membaca query string, bukan route parameter. Konten untuk `$religion` metode `@if($religion === 'islam')` tapi tab aktif tidak jalan karena variable outer di-shadow loop.
- **✅ SEKARANG:** Tab navigasi membandingkan dengan `$current` (dari route param `$religion`). Setiap agama punya konten unik:
  - **Islam**: Salat 5 Waktu, Wudhu, Puasa, Zakat, Haji (5 item, lengkap dengan detail expandable)
  - **Kristen**: Ibadah Minggu, Doa, Baptis, Perjamuan Kudus (4 item)
  - **Katolik**: Misa, 7 Sakramen, Rosario (3 item)
  - **Hindu**: Tri Sandhya, Puja & Banten, Nyepi (3 item)
  - **Buddha**: Meditasi, Puja Bakti, Waisak (3 item)
  - **Konghucu**: Sembahyang Tian, Cap Go Meh, Penghormatan Leluhur (3 item)
- **Accordion** (click-to-expand) dengan animasi smooth untuk detail tiap panduan
- Hero gradient warna sesuai agama + ikon

#### Etiket Rumah Ibadah (`/ibadah/etiket/{religion}`)
**Rewrite:** `resources/views/worship/etiquette.blade.php`
- Pola yang sama dengan guide: tab navigasi 6 agama, konten spesifik per agama
- Tiap agama punya 5-7 aturan etiket dengan ikon Material:
  - **Masjid**: 7 aturan (pakaian, alas kaki, kesunyian, foto, waktu salat, makan, toilet)
  - **Gereja**: 5 aturan, **Pura**: 6 aturan, **Vihara**: 6 aturan, **Klenteng**: 5 aturan
- Grid card 2 kolom, rapi dan profesional

#### Worship Index (`/ibadah`)
**Rewrite:** `resources/views/worship/index.blade.php`
- 4 card gradient dengan ikon warna berbeda (hijau, biru, oranye, amber)

---

### 📊 Database State (Setelah Seed)

| Table | Records |
|-------|---------|
| `religion_categories` | 6 (Islam, Kristen, Katolik, Hindu, Buddha, Konghucu) |
| `education_contents` | **8** (5 artikel + 3 video, semua Islam) |
| `users` | 2 |
| Lainnya | 0 |

---

### 📚 Dokumentasi

- **File baru:** `DATABASE-MIGRATION-RECOVERY.md`
- Mencatat penyebab `SQLSTATE[25P02]` di Supabase dan langkah recovery yang berhasil.
- Termasuk perintah `drop schema public cascade` + `create schema public` dan validasi migrasi ulang.

---

### 📁 Semua File yang Diubah/Dibuat Hari Ini

| Status | File |
|--------|------|
| ✏️ Rewrite | `resources/views/education/show.blade.php` |
| ✏️ Rewrite | `resources/views/education/gallery.blade.php` |
| ✏️ Rewrite | `resources/views/education/index.blade.php` |
| ✏️ Rewrite | `resources/views/education/religion.blade.php` |
| ➕ Baru | `database/seeders/EducationContentSeeder.php` |
| ✏️ Edit | `database/seeders/DatabaseSeeder.php` |
| ✏️ Edit | `app/Http/Controllers/EducationController.php` |
| ✏️ Edit | `resources/views/layouts/app.blade.php` |
| ✏️ Edit | `resources/views/layouts/navigation.blade.php` |
| ➕ Baru | `resources/views/components/navbar.blade.php` |
| ✏️ Rewrite | `resources/views/components/navbars/islam.blade.php` |
| ✏️ Rewrite | `resources/views/components/navbars/kristen.blade.php` |
| ✏️ Rewrite | `resources/views/components/navbars/katolik.blade.php` |
| ✏️ Rewrite | `resources/views/components/navbars/hindu.blade.php` |
| ✏️ Rewrite | `resources/views/components/navbars/buddha.blade.php` |
| ✏️ Rewrite | `resources/views/components/navbars/konghucu.blade.php` |
| ➕ Baru | `progress.md` (sebelumnya) |
| ✏️ Update | `progress.md` (ini) |
| ✏️ Rewrite | `resources/views/worship/schedule.blade.php` |
| ✏️ Rewrite | `resources/views/worship/guide.blade.php` |
| ✏️ Rewrite | `resources/views/worship/etiquette.blade.php` |
| ✏️ Rewrite | `resources/views/worship/index.blade.php` |
| ✏️ Rewrite | `resources/views/components/navbar.blade.php` (dispatcher fix) |
| ✏️ Edit | `resources/views/welcome.blade.php` (tambah Explore Edukasi CTA) |

---

### 📅 Update 13 Mei 2026 — Edukasi 5 Agama + Dashboard Redesign

#### ✅ Konten Edukasi untuk 6 Agama (33 total)

| Agama | Artikel | Video | Total |
|-------|---------|-------|-------|
| Islam | 5 | 3 | 8 |
| Kristen | 3 | 2 | 5 |
| Katolik | 3 | 2 | 5 |
| Hindu | 3 | 2 | 5 |
| Buddha | 3 | 2 | 5 |
| Konghucu | 3 | 2 | 5 |
| **Total** | **20** | **13** | **33** |

#### ✅ Dashboard Redesign (`/dashboard`)
**File:** `resources/views/dashboard/index.blade.php`
- Hero card gradient primary dengan avatar initial + nama user + email + preferensi agama
- 4 stat cards: Donasi, Konten Dibaca, Konsultasi, Role — dengan ikon warna & link
- Akses Cepat: 6 link dengan ikon warna berbeda (Edukasi, Jadwal, Panduan, Donasi, Relawan, Cek Fakta)
- Info Akun: email, role, agama, tanggal bergabung — dalam card rapi

#### ✅ File diubah
- `database/seeders/EducationContentSeeder.php` — 33 konten untuk 6 agama
- `resources/views/dashboard/index.blade.php` — redesign total

---


# Progress — by Rehan

## Ringkasan Pekerjaan

---

### 🐛 Bug yang Diperbaiki  
---

### 🆕 Perubahan yang Dilakukan

#### 2. Perbaikan Format Title Halaman Per Agama
**File:** `resources/views/education/religion.blade.php` — baris 4
- **SEBELUMNYA:** `@section('title', $pageTitle . ' - Agama')` → title tampil "Islam - Agama - Laravel" (redundans)
- **SEKARANG:** `@section('title', $pageTitle)` → title tampil "Islam - Harmoni Nusantara" — bersih, sesuai nama agama dari database

---

### 📁 Alur Perubahan

```
Sebelum:
  Browser tab → "Islam - Agama 
                         ↑         
                    (redundan)  

Sesudah:
  Browser tab → "Islam 
                    ↑         
              ($religionName)  

Sumber title:
  .env APP_NAME="Harmoni Nusantara"
    → config/page-title.php (default)
      → TitleServiceProvider (inject ke semua view)
        → layouts/app.blade.php (render <title>)
          → @section('title', $pageTitle) di religion.blade.php
```

---

### 📁 File yang Diubah

| Status | File | Keterangan |
|--------|------|------------|

| ✏️ Edit | `resources/views/education/religion.blade.php` | Format `@section('title')` disederhanakan |
=======
### 📅 Update 14 Mei 2026 — Fitur "Ruang Bersama" (Forum Diskusi + AI Chatbot)

#### ✅ Ringkasan
Fitur baru **Ruang Bersama** — satu ruang chat besar (seperti grup WhatsApp) dengan integrasi AI chatbot Google Gemini. User bisa berdialog tentang agama, toleransi, dan etika. Tombol **"Mulai Berdialog"** di halaman utama sekarang mengarah ke `/forum`.

#### ✅ Alur User
```
[/] → Tombol "Mulai Berdialog" → /forum
  ├─ Guest: UI chat di-blur + overlay "Gabung Komunitas" → Register/Login → balik ke /forum (viewer)
  ├─ Viewer (login, pending): Baca chat (read-only), prompt di-blur + tombol "Minta Bergabung"
  ├─ Member (disetujui): Full akses → tulis pesan + @ai untuk chatbot
  └─ Creator/Admin: Full akses + setujui anggota baru
```

#### ✅ Database — 3 Tabel Baru

| Tabel | Kolom |
|---|---|
| `forum_rooms` | id, name, description, user_id (creator), is_active, timestamps |
| `forum_messages` | id, forum_room_id, user_id (nullable → AI), content, is_ai, created_at |
| `forum_participants` | id, forum_room_id, user_id, role (creator/member/viewer), status (active/pending/banned), timestamps |

Seeder sudah jalan: 1 room "Ruang Bersama Harmoni Nusantara", 1 creator (admin), 2 message awal (sambutan + AI).

#### ✅ Fitur & File

| Area | File | Keterangan |
|---|---|---|
| **Migration** | `database/migrations/2026_05_14_000001_create_forum_rooms_table.php` | Tabel rooms |
| | `database/migrations/2026_05_14_000002_create_forum_messages_table.php` | Tabel messages |
| | `database/migrations/2026_05_14_000003_create_forum_participants_table.php` | Tabel participants |
| **Model** | `app/Models/ForumRoom.php` | Relasi: creator, messages, participants |
| | `app/Models/ForumMessage.php` | Relasi: room, user (dengan default name "AI Assistant") |
| | `app/Models/ForumParticipant.php` | Relasi: room, user |
| | `app/Models/User.php` | ✏️ Tambah relasi: forumMessages, forumParticipants, forumRooms |
| **Service** | `app/Services/GeminiService.php` | Integrasi Google Gemini API dengan system prompt toleransi & agama |
| **Controller** | `app/Http/Controllers/ForumController.php` | index(), storeMessage() + deteksi @ai, requestJoin(), approveMember() |
| **Routes** | `routes/web.php` | ➕ GET /forum, POST /forum/message, POST /forum/request-join, POST /forum/approve/{user} |
| **Views** | `resources/views/forum/index.blade.php` | Halaman utama Ruang Bersama — 3 kondisi UI (guest/viewer/member) |
| | `resources/views/welcome.blade.php` | ✏️ Ubah tombol "Mulai Berdialog" → route('forum') |
| | `resources/views/layouts/navigation.blade.php` | ✏️ Tambah link "Ruang Bersama" di nav (desktop + mobile) |
| | `resources/views/dashboard/index.blade.php` | ✏️ Tambah akses cepat "Ruang Bersama" |
| | `resources/views/components/navbar.blade.php` | ✏️ Tambah deteksi route forum |
| **Seeder** | `database/seeders/ForumSeeder.php` | Seed 1 room + 1 creator + 2 messages awal |
| | `database/seeders/DatabaseSeeder.php` | ✏️ Tambah ForumSeeder::class |
| **Filament** | `app/Filament/Resources/ForumMessageResource.php` | Admin panel: kelola pesan (list, search, delete, filter AI/human) |
| | `app/Filament/Resources/ForumParticipantResource.php` | Admin panel: kelola anggota (approve, ban, ubah role) |
| | `app/Filament/AdminPanel.php` | ✏️ Daftarkan 2 resource baru |
| **Config** | `config/services.php` | ✏️ Tambah konfigurasi 'gemini' |
| | `.env` | ✏️ Tambah GEMINI_API_KEY |

#### 🧠 AI Chatbot (Google Gemini)

- **Trigger:** User mengetik `@ai` di pesan → otomatis AI merespon
- **System prompt:** Sejarah agama, panduan ibadah, etika, toleransi — dalam Bahasa Indonesia
- **Keamanan:** Safety threshold BLOCK_ONLY_HIGH untuk konten berbahaya
- **Error handling:** Timeout 30s, fallback pesan jika API gagal
- **History:** 10 pesan terakhir user + AI dikirim sebagai konteks

#### 🔧 Eksekusi
- ✅ `php artisan migrate` — 3 migration sukses
- ✅ `php artisan db:seed --class=ForumSeeder` — data awal berhasil
- ✅ `vendor/bin/pint --format agent` — formatting fixed
- ✅ Semua route terdaftar dan berfungsi

#### 📊 Database State (Update)

| Table | Records |
|---|---|
| `forum_rooms` | **1** (Ruang Bersama Harmoni Nusantara) |
| `forum_messages` | **2** (sambutan admin + AI) |
| `forum_participants` | **1** (creator: admin) |

---

### 📝 Commit Messages (14 Mei 2026)

1. `feat: add forum rooms, messages, and participants migrations & models`
2. `feat: add ForumController with chat, join request, and member approval`
3. `feat: add GeminiService integration for AI chatbot in forum`
4. `feat: add forum UI with guest/viewer/member access levels`
5. `feat: add Filament resources for forum messages & participants`
6. `feat: update navigation, dashboard, and welcome page with forum links`
7. `chore: add ForumSeeder with initial room and messages`
8. `chore: update DatabaseSeeder to include ForumSeeder`

### ⚠️ Checklist AI Chatbot — Selesai?

| Item | Status |
|------|--------|
| Migration 3 tabel | ✅ Done |
| Models (ForumRoom, ForumMessage, ForumParticipant) | ✅ Done |
| User model relasi | ✅ Done |
| GeminiService | ✅ Done |
| ForumController + routes | ✅ Done |
| Forum UI (3 level akses) | ✅ Done |
| Filament resources | ✅ Done |
| Seeder | ✅ Done |
| **🔑 GEMINI_API_KEY di .env (nyata)** | **❌ Belum** |
| **🧪 Test @ai di forum** | **❌ Belum** |
| **🐘 `php artisan optimize`** | **❌ Belum** |

### 🚀 Langkah Aktivasi AI Chatbot (Google Gemini)

1. **Daftar & dapatkan API Key:**
   - Buka https://ai.google.dev/
   - Klik **"Get an API Key"** → **"Create API Key"**
   - Login pakai Google Account
   - Pilih project (atau buat baru) → salin key (format: `AIzaSy...`)
   - **Gratis**, tanpa kartu kredit — 60 request/menit

2. **Masukkan key ke `.env`:**
   - Buka file `.env` di root project
   - Cari baris: `GEMINI_API_KEY=`
   - Isi dengan key asli: `GEMINI_API_KEY=AIzaSy...key_asli_kamu...`
   - **JANGAN** pakai tanda kutip

3. **Jalankan optimize:**
   ```bash
   php artisan optimize
   ```
   (Ini clear cache & baca ulang config)

4. **Test:**
   - Buka `/forum` (login sebagai member)
   - Ketik pesan dengan `@ai` di awalnya, misal:
     > `@ai apa itu toleransi beragama?`
   - AI akan merespon otomatis dalam 5-10 detik

> **Troubleshooting:** Kalau AI tidak merespon, cek isi `.env` sudah benar, lalu `php artisan optimize` ulang. Kalau masih error, cek log di `storage/logs/laravel.log`.

---

### 📝 Update 14 Mei 2026 — Forum Redesign + Avatar + Auto-delete (by Andikha)

#### ✅ Fitur Baru

| Fitur | Detail |
|-------|--------|
| **🎨 Forum UI Redesign** | Chat bubble ala WhatsApp (user kanan hijau, AI kiri putih), sidebar premium, header gradient, mobile responsive |
| **🖼️ Avatar Upload** | Upload foto profil saat register & edit profil, tampil di forum & navbar (fallback inisial jika tidak ada) |
| **🧹 Auto-delete 24 Jam** | Model pruning — pesan forum otomatis terhapus tiap jam jika >24 jam |

#### ✅ File yang Diubah/Dibuat

| Status | File | Perubahan |
|--------|------|-----------|
| ✏️ Rewrite | `resources/views/forum/index.blade.php` | Redesign total UI chat profesional |
| ✏️ Edit | `app/Http/Controllers/ProfileController.php` | Tambah upload avatar + fix view path |
| ✏️ Edit | `resources/views/profile/partials/update-profile-information-form.blade.php` | Tambah input avatar + preview |
| ✏️ Edit | `resources/views/auth/register.blade.php` | Tambah upload avatar (opsional) + desain lebih menarik |
| ✏️ Edit | `app/Http/Controllers/Auth/RegisteredUserController.php` | Simpan avatar saat registrasi |
| ✏️ Edit | `app/Models/ForumMessage.php` | Tambah Prunable trait — hapus otomatis 24 jam |
| ✏️ Edit | `routes/console.php` | Schedule model:prune tiap jam |
| ✏️ Edit | `resources/views/layouts/navigation.blade.php` | Tampilkan avatar user di dropdown |
| 🔧 Baru | `php artisan storage:link` | Symlink public/storage → storage/app/public |

---

### 📅 Update 14 Mei 2026 — Fitur "Kisah Bahagia Mereka" (Testimoni Pengguna) — by Rehan

#### ✅ Ringkasan
Menambahkan section **"Kisah Bahagia Mereka"** di halaman utama (`/`) setelah section donasi. Menampilkan testimoni pengguna tentang dampak positif menggunakan Harmoni Nusantara. Dilengkapi form submit testimoni inline dengan moderasi admin.

#### ✅ Alur User
```
[/] → Scroll ke bawah section donasi
  ├─ Melihat card testimoni (foto, nama, cerita)
  ├─ Klik "Bagikan Kisah" → form inline muncul
  │   ├─ Isi nama, foto (opsional), cerita
  │   └─ Submit → status "menunggu moderasi"
  └─ Admin di /dashboard/testimoni setujui/tolak
      └─ Disetujui → tampil di landing page
```

#### ✅ Database — 1 Tabel Baru

| Tabel | Kolom |
|-------|-------|
| `testimonials` | id, user_id (nullable FK), name, photo (nullable), content (text), is_approved (boolean default false), timestamps |

#### ✅ Fitur & File

| Area | File | Keterangan |
|------|------|-----------|
| **Migration** | `database/migrations/2026_05_14_052712_create_testimonials_table.php` | Tabel testimonials |
| **Model** | `app/Models/Testimonial.php` | Relasi user, scope approved/pending |
| **Controller** | `app/Http/Controllers/TestimonialController.php` | store(), approve(), reject() |
| **Routes** | `routes/web.php` | ➕ POST /testimoni, GET /dashboard/testimoni, PATCH approve, DELETE reject |
| **Views (Landing)** | `resources/views/welcome.blade.php` | ✏️ Tambah section "Kisah Bahagia Mereka" (setelah donasi) + testimonial cards + form input inline dengan validasi |
| **Views (Dashboard)** | `resources/views/dashboard/testimonials.blade.php` | ➕ Baru — Tabel daftar testimoni + tombol Setujui/Hapus |
| **Controller (Dashboard)** | `app/Http/Controllers/DashboardController.php` | ✏️ Tambah method testimonials() |
| **Storage** | `php artisan storage:link` | Symlink untuk upload foto testimoni |
| **Formatting** | `vendor/bin/pint --format agent` | Fixed no_unused_imports + indentation |

#### ✅ Detail Section Landing Page

```
┌─────────────────────────────────────────────────────┐
│            ✨ Kisah Bahagia Mereka                    │
│    Dampak nyata dari penggunaan Harmoni Nusantara    │
├─────────────────┬─────────────────┬─────────────────┤
│  💬 "Cerita..." │  💬 "Cerita..." │  💬 "Cerita..." │
│  👤 Nama User   │  👤 Nama User   │  👤 Nama User   │
├─────────────────┴─────────────────┴─────────────────┤
│              Bagikan Kisah Anda                      │
│  ┌─────────────────────────────────────────────────┐ │
│  │ Nama [___________]                              │ │
│  │ Foto [Choose File]                              │ │
│  │ Cerita [________________________]               │ │
│  │ [Kirim Kisah →]                                 │ │
│  └─────────────────────────────────────────────────┘ │
│    *Testimoni akan ditampilkan setelah diverifikasi   │
└─────────────────────────────────────────────────────┘
```

#### ✅ Flow Moderasi

```
User submit testimoni
  → is_approved = false (default)
  → Admin buka /dashboard/testimoni
  → Lihat daftar testimoni pending
  → Klik "Setujui" → is_approved = true → tampil di landing
  → Klik "Hapus" → testimoni di-delete dari DB
```

#### 🔧 Eksekusi
- ✅ `php artisan make:model Testimonial -m` — model + migration
- ✅ `php artisan make:controller TestimonialController` — controller
- ✅ `php artisan migrate` — 1 migration sukses
- ✅ `php artisan storage:link` — storage link created
- ✅ `vendor/bin/pint --format agent` — formatting fixed

---

### 📝 Update 14 Mei 2026 — Refactor Testimoni: Page Terpisah + Title + Avatar Otomatis — by Rehan

#### ✅ Perubahan dari Versi Sebelumnya

| Aspek | Sebelum | Sesudah | Alasan |
|-------|---------|---------|--------|
| **Form testimoni** | Inline di halaman welcome (baris 454-507) | **Halaman terpisah** `/testimoni/buat` dengan layout dashboard | UX lebih fokus, konsisten dengan halaman lain |
| **Foto testimoni** | Upload manual (field `photo`, disimpan di storage) | **Otomatis dari avatar user** (`user->avatar`) atau inisial | Tidak redundan, user sudah punya foto profil |
| **Field nama** | Input manual oleh user | **Auto dari `auth()->user()->name`** (read-only) | Mencegah data palsu, lebih akurat |
| **Identitas card** | Label statis "Pengguna Harmoni Nusantara" | **Judul dinamis** (`title`) — contoh: "Penerima Beasiswa Jakarta 2025" | Memberi konteks peran pengguna |
| **Foto di dashboard** | Tampilkan upload `$testimonial->photo` | Tampilkan **avatar user** dari `$testimonial->user->avatar` | Konsisten dengan profile user |

#### ✅ Database — Perubahan

| Migration | Kolom | Tipe |
|-----------|-------|------|
| ➕ Baru: `xxxx_add_title_to_testimonials_table` | `title` | string(255), nullable, after('name') |

#### ✅ File yang Diubah/Dibuat

| Status | File | Perubahan |
|--------|------|-----------|
| ➕ Baru | `database/migrations/2026_05_14_054823_add_title_to_testimonials_table.php` | Kolom `title` di testimonials |
| ✏️ Rewrite | `app/Models/Testimonial.php` | Ubah fillable: hapus `photo`, tambah `title` + accessor `getAvatarUrlAttribute()` |
| ✏️ Rewrite | `app/Http/Controllers/TestimonialController.php` | Tambah `create()`, hapus semua logic photo, validasi title + content, name auto dari auth |
| ➕ Baru | `resources/views/testimonials/create.blade.php` | Halaman form testimoni terpisah — avatar preview, nama auto, input judul + cerita |
| ✏️ Edit | `routes/web.php` | ➕ `GET /testimoni/buat` → `TestimonialController@create` |
| ✏️ Edit | `resources/views/welcome.blade.php` | Cards: avatar dari user + title. Hapus form inline → ganti tombol link ke `/testimoni/buat` |
| ✏️ Edit | `resources/views/dashboard/testimonials.blade.php` | Kolom Foto → avatar user. Tambah kolom Judul antara Nama dan Cerita |

#### 🔄 Alur User Baru

```
[Landing Page /]
  ↓ Scroll ke section Kisah Bahagia Mereka
  ├─ Lihat testimonial cards → avatar user + nama + title (e.g. "Penerima Beasiswa") + cerita
  │
  ├─ [Jika LOGIN]:
  │     Tombol "Bagikan Kisah Anda" → /testimoni/buat
  │       → Preview avatar + nama (auto, disabled)
  │       → Input Judul (optional): "Penerima Beasiswa Jakarta 2025"
  │       → Input Cerita (required)
  │       → Submit → redirect ke / dengan flash sukses
  │
  └─ [Jika GUEST]:
        "Masuk atau daftar untuk membagikan kisah Anda"
```

#### 🧩 Detail Form (`/testimoni/buat`)

```
┌─ Bagikan Kisah Anda ─────────────────────────────┐
│                                                    │
│   [ 🖼️ Avatar ]  Nama User (auto)                 │
│                   Nama akan otomatis terisi        │
│                                                    │
│   Judul / Peran (opsional)                        │
│   [ Penerima Beasiswa Jakarta 2025          ]     │
│   Misalnya: Penerima Beasiswa, Relawan, dll.      │
│                                                    │
│   Cerita Anda *                                    │
│   [ Ceritakan pengalaman Anda...             ]     │
│   [____________________________]                   │
│                                                    │
│   [Kirim Kisah →]  [Batal]                         │
│   ℹ️ Kisah akan ditampilkan setelah diverifikasi    │
└────────────────────────────────────────────────────┘
```

#### 🔧 Eksekusi

- ✅ `php artisan make:migration add_title_to_testimonials_table` — migration
- ✅ `php artisan migrate` — kolom `title` siap
- ✅ Semua route terdaftar (5 route testimoni)
- ✅ `vendor/bin/pint --format agent` — formatting fixed

