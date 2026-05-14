# HARMONY DIGITAL — Technical Specification Document
**Platform Moderasi & Literasi Beragama Indonesia**
**Version:** 1.0.0
**Last Updated:** 2026-05-12
**Status:** Ready for Development

---

## TABLE OF CONTENTS

1. [Project Overview](#1-project-overview)
2. [Technology Stack](#2-technology-stack)
3. [System Architecture](#3-system-architecture)
4. [Module Breakdown](#4-module-breakdown)
5. [Database Schema](#5-database-schema)
6. [API Integration](#6-api-integration)
7. [Role & Permission Matrix](#7-role--permission-matrix)
8. [Development Roadmap (Sprint Plan)](#8-development-roadmap-sprint-plan)
9. [Non-Functional Requirements](#9-non-functional-requirements)
10. [Glossary](#10-glossary)

---

## 1. PROJECT OVERVIEW

### 1.1 Problem Statement
Indonesia memiliki keragaman agama yang tinggi (Islam, Kristen Protestan, Katolik, Hindu, Buddha, Konghucu). Minimnya platform digital yang memfasilitasi pemahaman lintas iman secara moderat menyebabkan potensi miskomunikasi dan intoleransi.

### 1.2 Solution
**Harmony Digital** adalah platform web berbasis Laravel yang menyediakan:
- Edukasi keagamaan lintas iman
- Informasi ibadah praktis berbasis API real-time
- Ruang diskusi moderat yang terenkripsi
- Aksi sosial kolaboratif lintas agama

### 1.3 Target Audience

| Segmen | Karakteristik | Kebutuhan Utama |
|--------|--------------|-----------------|
| Anak Usia Dini (< 12 tahun) | Non-literate, butuh visual | Animasi, konten tanpa login |
| Remaja & Dewasa (13–50 tahun) | Tech-savvy, aktif sosial | Fitur penuh, aksi sosial, diskusi |
| Lansia (50+ tahun) | Low digital literacy | UI sederhana, teks besar, voice assistant |

### 1.4 Platform Scope
- **Web App** (responsive, mobile-first)
- **Bahasa:** Bahasa Indonesia
- **Browser Support:** Chrome 90+, Firefox 88+, Safari 14+, Edge 90+

---

## 2. TECHNOLOGY STACK

### 2.1 Core Stack

| Layer | Technology | Version | Catatan |
|-------|-----------|---------|---------|
| Backend Framework | Laravel | 11.x | PHP 8.3+ |
| Database | Supabase (PostgreSQL) | Latest | Primary DB via supabase-php |
| Frontend Rendering | Blade + Alpine.js | — | Default Laravel view |
| Realtime UI | Livewire | 3.x | Untuk fitur chat/diskusi |
| CSS Framework | Tailwind CSS | 3.x | Utility-first styling |
| HTTP Client | GuzzleHttp | 7.x | Built-in di Laravel 11 |

### 2.2 Infrastructure

| Komponen | Tools |
|----------|-------|
| Local Dev | Docker + Laravel Sail |
| Deployment | Railway / VPS (Proxmox LXC) |
| Reverse Proxy | Cloudflare Tunnel |
| Queue Worker | Laravel Horizon (Redis) |
| File Storage | Supabase Storage / S3-compatible |
| Cache | Redis |

### 2.3 External Services

| Layanan | Provider | Endpoint |
|---------|---------|---------|
| Jadwal Sholat | Aladhan API | `https://api.aladhan.com/v1` |
| Hari Besar | Calendarific API | `https://calendarific.com/api/v2` |
| Peta Rumah Ibadah | Google Maps API + Places API | `https://maps.googleapis.com` |
| Video Edukasi | YouTube Data API v3 | `https://www.googleapis.com/youtube/v3` |
| Cek Fakta | Google Fact Check Tools API | `https://factchecktools.googleapis.com` |
| Text-to-Speech | Web Speech API | Browser Native |

---

## 3. SYSTEM ARCHITECTURE

### 3.1 High-Level Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         CLIENT LAYER                            │
│  Browser (Blade + Alpine.js + Livewire + Tailwind CSS)         │
└───────────────────────────┬─────────────────────────────────────┘
                            │ HTTPS
┌───────────────────────────▼─────────────────────────────────────┐
│                    LARAVEL APPLICATION                           │
│                                                                  │
│  ┌────────────┐  ┌─────────────┐  ┌──────────────────────────┐  │
│  │   Router   │  │ Middleware  │  │   Service Providers      │  │
│  └─────┬──────┘  │ (Auth/CORS) │  └──────────────────────────┘  │
│        │         └─────────────┘                                 │
│  ┌─────▼──────────────────────────────────────────────────────┐  │
│  │                    MODULES (Controllers)                    │  │
│  │  Auth │ Education │ Worship │ SocialAction │ Dashboard      │  │
│  └─────┬──────────────────────────────────────────────────────┘  │
│        │                                                         │
│  ┌─────▼──────────────────────────────────────────────────────┐  │
│  │                 SERVICE LAYER                               │  │
│  │  AladhanService │ MapsService │ YouTubeService │ ...        │  │
│  └─────┬──────────────────────────────────────────────────────┘  │
│        │                                                         │
│  ┌─────▼──────────────────────────────────────────────────────┐  │
│  │               REPOSITORY / MODEL LAYER                     │  │
│  │  Eloquent ORM ↔ Supabase (PostgreSQL)                      │  │
│  └────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────┘
         │                           │
┌────────▼──────────┐    ┌──────────▼──────────────────────┐
│  Supabase (DB +   │    │  External APIs                  │
│  Storage + Auth)  │    │  (Aladhan, Maps, YouTube, etc.) │
└───────────────────┘    └─────────────────────────────────┘
```

### 3.2 Request Lifecycle (Singkat)

```
Request Masuk
    → Cloudflare Tunnel (SSL termination)
    → Laravel Router
    → Middleware Stack (Auth, CORS, Role Check)
    → Controller (pilih modul)
    → Service Layer (business logic + API call jika perlu)
    → Model/Repository (query DB)
    → Response (Blade view / JSON / Livewire component)
```

### 3.3 Authentication & Authorization Flow

```
User Visit Page
    → Guest? → Tampilkan halaman publik
    → Auth Required?
        → Tidak login → Redirect ke /login
        → Login, cek role:
            admin    → akses penuh + panel admin
            penyuluh → akses modul edukasi + konsultasi
            user     → akses fitur standar
```

---

## 4. MODULE BREAKDOWN

> Setiap modul memiliki: Controller, Service (jika butuh logika atau API eksternal), Model/Migration, View (Blade), dan Route group-nya sendiri.

---

### MODULE 1: Authentication (`/auth`)

**Tujuan:** Login, register, manajemen sesi, OAuth (opsional).

**Tech:** Laravel Breeze (Blade stack)

**File Structure:**
```
app/Http/Controllers/Auth/
    AuthenticatedSessionController.php   → Login/Logout
    RegisteredUserController.php         → Register
    PasswordResetLinkController.php      → Lupa Password

resources/views/auth/
    login.blade.php
    register.blade.php
    forgot-password.blade.php
```

**Routes:**
```
GET  /login          → form login
POST /login          → proses login
POST /logout         → logout
GET  /register       → form register
POST /register       → proses register
```

**Validasi:**
- Email unik, password min 8 karakter
- `religion_preference` → nullable (opsional, tidak wajib diisi)
- Role default saat register: `user`

---

### MODULE 2: Education & Literacy (`/edukasi`)

**Tujuan:** Menampilkan konten sejarah 6 agama, video tokoh moderat, wisata religi virtual.

**Sub-fitur:**
- Galeri artikel/sejarah agama (6 agama resmi)
- Galeri video dari YouTube (via YouTube Data API)
- Wisata religi virtual (embedded iframe / foto 360°)
- Podcast/audio tokoh moderat

**File Structure:**
```
app/Http/Controllers/EducationController.php
app/Services/YouTubeService.php
app/Models/EducationContent.php
app/Models/ReligionCategory.php

resources/views/education/
    index.blade.php          → listing konten
    show.blade.php           → detail artikel/video
    gallery.blade.php        → galeri video YouTube
    virtual-tour.blade.php   → wisata religi virtual
```

**Routes:**
```
GET /edukasi                         → halaman utama edukasi
GET /edukasi/{religion}              → konten per agama (islam, kristen, dll)
GET /edukasi/video                   → galeri video YouTube
GET /edukasi/wisata-virtual          → virtual tour rumah ibadah
GET /edukasi/{slug}                  → detail artikel
```

**API yang digunakan:** YouTube Data API v3
```
GET https://www.googleapis.com/youtube/v3/search
    ?part=snippet
    &q=moderasi+beragama+indonesia
    &type=video
    &key={YOUTUBE_API_KEY}
```

**Access Control:**
- Konten artikel → publik (tanpa login)
- Video animasi anak → publik
- Komentar/interaksi → butuh login

---

### MODULE 3: Worship Assistant (`/ibadah`)

**Tujuan:** Informasi ibadah praktis, jadwal, dan lokasi rumah ibadah terdekat.

**Sub-fitur:**
1. **Jadwal Ibadah** — Jadwal sholat (Islam via Aladhan), hari besar semua agama (Calendarific)
2. **Peta Rumah Ibadah** — Google Maps + Places API untuk menemukan masjid, gereja, pura, vihara, klenteng
3. **Panduan Ritual Visual** — Infografis/video tata cara ibadah
4. **Panduan Etiket Bertamu** — Artikel etiket memasuki rumah ibadah agama lain

**File Structure:**
```
app/Http/Controllers/WorshipController.php
app/Services/AladhanService.php
app/Services/CalendarificService.php
app/Services/GoogleMapsService.php

resources/views/worship/
    index.blade.php              → hub halaman ibadah
    schedule.blade.php           → jadwal ibadah (sholat + hari besar)
    map.blade.php                → peta rumah ibadah
    guide.blade.php              → panduan ritual visual
    etiquette.blade.php          → etiket bertamu
```

**Routes:**
```
GET /ibadah                          → hub fitur ibadah
GET /ibadah/jadwal                   → jadwal ibadah lengkap
GET /ibadah/jadwal/sholat            → jadwal sholat harian (Aladhan)
GET /ibadah/jadwal/hari-besar        → kalender hari besar semua agama
GET /ibadah/peta                     → peta rumah ibadah terdekat
GET /ibadah/panduan/{religion}       → panduan ritual per agama
GET /ibadah/etiket/{religion}        → etiket bertamu ke rumah ibadah
```

**API yang digunakan:**

*Aladhan — Jadwal Sholat:*
```
GET https://api.aladhan.com/v1/timingsByCity
    ?city=Jakarta
    &country=Indonesia
    &method=11               → method Kemenag RI
```

*Google Maps — Rumah Ibadah Terdekat:*
```
POST https://places.googleapis.com/v1/places:searchNearby
Body: {
    "includedTypes": ["mosque", "church", "hindu_temple", "buddhist_temple"],
    "locationRestriction": {
        "circle": { "center": { "latitude": -6.2, "longitude": 106.8 }, "radius": 2000 }
    }
}
```

**Catatan:** Koordinat pengguna diambil via browser `navigator.geolocation` (frontend), lalu dikirim ke controller.

---

### MODULE 4: Social Action & Moderation (`/aksi`)

**Tujuan:** Donasi inklusif, relawan lintas iman, cek fakta, dan ruang tanya moderat.

**Sub-fitur:**
1. **Donasi Inklusif** — Campaign donasi lintas agama, statistik real-time
2. **Relawan Lintas Iman** — Pendaftaran dan manajemen relawan
3. **Cek Fakta** — Verifikasi berita/isu keagamaan via Google Fact Check API
4. **Ruang Tanya Moderat** — Konsultasi privat terenkripsi antara user dan penyuluh

**File Structure:**
```
app/Http/Controllers/
    DonationController.php
    VolunteerController.php
    FactCheckController.php
    ConsultationController.php     → Livewire-compatible

app/Services/
    FactCheckService.php           → wrapper Google Fact Check API
    EncryptionService.php          → enkripsi pesan konsultasi

app/Models/
    Donation.php
    DonationProject.php
    Volunteer.php
    FactCheck.php
    Consultation.php               → konten dienkripsi

app/Livewire/
    ConsultationChat.php           → Livewire component realtime chat

resources/views/
    donations/
        index.blade.php            → daftar campaign
        show.blade.php             → detail campaign + statistik Chart.js
        create.blade.php           → form donasi (admin)
    volunteers/
        index.blade.php
        register.blade.php
    fact-check/
        index.blade.php
        show.blade.php
    consultations/
        index.blade.php            → list konsultasi user
        show.blade.php             → room chat (embed Livewire)
```

**Routes:**
```
// Donasi (publik untuk lihat, login untuk transaksi)
GET  /aksi/donasi                    → daftar campaign
GET  /aksi/donasi/{id}               → detail campaign
POST /aksi/donasi/{id}/donate        → proses donasi [auth]

// Relawan
GET  /aksi/relawan                   → daftar program relawan
POST /aksi/relawan/daftar            → daftar jadi relawan [auth]

// Cek Fakta
GET  /aksi/cek-fakta                 → list hasil cek fakta
GET  /aksi/cek-fakta/{id}            → detail cek fakta
POST /aksi/cek-fakta                 → submit konten untuk dicek [admin/penyuluh]

// Konsultasi (semua butuh login)
GET  /aksi/konsultasi                → list konsultasi milik user [auth]
POST /aksi/konsultasi                → buat sesi konsultasi baru [auth]
GET  /aksi/konsultasi/{id}           → room chat konsultasi [auth, owner only]
```

**Enkripsi Konsultasi:**
```php
// app/Services/EncryptionService.php
// Gunakan Laravel built-in encryption (AES-256-CBC)
Crypt::encryptString($message);
Crypt::decryptString($encryptedMessage);
```

**API yang digunakan:**

*Google Fact Check:*
```
GET https://factchecktools.googleapis.com/v1alpha1/claims:search
    ?query=hoaks+agama+indonesia
    &key={GOOGLE_API_KEY}
```

---

### MODULE 5: User Dashboard (`/dashboard`)

**Tujuan:** Halaman personal user untuk melihat aktivitas, riwayat, dan progres.

**Sub-fitur:**
- Riwayat donasi
- Progres belajar (artikel/video yang sudah dibaca)
- Arsip konsultasi
- Manajemen profil

**File Structure:**
```
app/Http/Controllers/DashboardController.php
app/Http/Controllers/ProfileController.php

resources/views/dashboard/
    index.blade.php          → ringkasan aktivitas
    donations.blade.php      → riwayat donasi
    learning.blade.php       → progres belajar
    consultations.blade.php  → arsip konsultasi
    profile.blade.php        → edit profil
```

**Routes:**
```
// Semua route di sini butuh auth middleware
GET /dashboard                       → halaman utama dashboard
GET /dashboard/donasi                → riwayat donasi
GET /dashboard/belajar               → progres belajar
GET /dashboard/konsultasi            → arsip konsultasi
GET /dashboard/profil                → halaman profil
PUT /dashboard/profil                → update profil
```

---

### MODULE 6: Admin Panel (`/admin`)

**Tujuan:** Manajemen konten, user, penyuluh, dan moderasi platform.

**Tech:** Filament PHP (Laravel admin panel framework) — DISARANKAN untuk efisiensi development

**Sub-fitur:**

| Fitur Admin | Deskripsi |
|-------------|-----------|
| User Management | CRUD user, assign role |
| Content Management | Approve/reject konten edukasi |
| Donation Management | Kelola campaign donasi |
| Fact Check Management | Verifikasi dan publish hasil cek fakta |
| Consultation Management | Monitor konsultasi (tanpa bisa baca konten enkripsi) |
| Analytics | Statistik pengguna, donasi, engagement |

**Routes:**
```
// Semua route admin butuh auth + role:admin middleware
GET  /admin                          → dashboard admin
GET  /admin/users                    → daftar user
GET  /admin/users/{id}/edit          → edit user / assign role
GET  /admin/content                  → daftar konten pending
POST /admin/content/{id}/approve     → approve konten
POST /admin/content/{id}/reject      → reject konten
GET  /admin/donations                → manajemen donasi
GET  /admin/fact-checks              → manajemen cek fakta
GET  /admin/analytics                → halaman statistik
```

---

## 5. DATABASE SCHEMA

### 5.1 Tabel: `users`
```sql
id                  BIGSERIAL PRIMARY KEY
name                VARCHAR(255) NOT NULL
email               VARCHAR(255) UNIQUE NOT NULL
email_verified_at   TIMESTAMP NULL
password            VARCHAR(255) NOT NULL
religion_preference VARCHAR(50) NULL         -- islam, kristen, katolik, hindu, buddha, konghucu
role                VARCHAR(20) DEFAULT 'user' -- admin, penyuluh, user
avatar              VARCHAR(500) NULL
remember_token      VARCHAR(100) NULL
created_at          TIMESTAMP
updated_at          TIMESTAMP
```

### 5.2 Tabel: `religion_categories`
```sql
id          BIGSERIAL PRIMARY KEY
slug        VARCHAR(50) UNIQUE NOT NULL   -- islam, kristen, dst
name        VARCHAR(100) NOT NULL
description TEXT NULL
icon_url    VARCHAR(500) NULL
created_at  TIMESTAMP
updated_at  TIMESTAMP
```

### 5.3 Tabel: `education_contents`
```sql
id                  BIGSERIAL PRIMARY KEY
religion_id         BIGINT REFERENCES religion_categories(id)
author_id           BIGINT REFERENCES users(id)
title               VARCHAR(500) NOT NULL
slug                VARCHAR(500) UNIQUE NOT NULL
content             TEXT NOT NULL
content_type        VARCHAR(20) NOT NULL    -- article, video, audio, virtual_tour
youtube_video_id    VARCHAR(50) NULL        -- untuk tipe video
thumbnail_url       VARCHAR(500) NULL
status              VARCHAR(20) DEFAULT 'pending'  -- pending, approved, rejected
age_group           VARCHAR(20) NULL        -- children, teen_adult, elderly, all
views_count         INTEGER DEFAULT 0
created_at          TIMESTAMP
updated_at          TIMESTAMP
```

### 5.4 Tabel: `donation_projects`
```sql
id              BIGSERIAL PRIMARY KEY
title           VARCHAR(500) NOT NULL
description     TEXT NOT NULL
target_amount   DECIMAL(15,2) NOT NULL
current_amount  DECIMAL(15,2) DEFAULT 0
religion_scope  VARCHAR(20) DEFAULT 'all'    -- all, islam, kristen, dst
cover_image     VARCHAR(500) NULL
status          VARCHAR(20) DEFAULT 'active' -- active, completed, cancelled
deadline        DATE NULL
created_by      BIGINT REFERENCES users(id)
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### 5.5 Tabel: `donations`
```sql
id              BIGSERIAL PRIMARY KEY
user_id         BIGINT REFERENCES users(id) NULL   -- NULL jika anonymous
project_id      BIGINT REFERENCES donation_projects(id)
amount          DECIMAL(15,2) NOT NULL
anonymous_flag  BOOLEAN DEFAULT FALSE
payment_method  VARCHAR(50) NULL
payment_status  VARCHAR(20) DEFAULT 'pending'      -- pending, success, failed
transaction_ref VARCHAR(255) NULL
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### 5.6 Tabel: `fact_checks`
```sql
id              BIGSERIAL PRIMARY KEY
author_id       BIGINT REFERENCES users(id)        -- penyuluh/admin yang verifikasi
title           VARCHAR(500) NOT NULL
content         TEXT NOT NULL
verdict         VARCHAR(20) NOT NULL               -- hoax, true, misleading, unverified
source_link     VARCHAR(1000) NULL
google_api_ref  VARCHAR(500) NULL                  -- referensi dari Google Fact Check
published_at    TIMESTAMP NULL
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### 5.7 Tabel: `consultations`
```sql
id              BIGSERIAL PRIMARY KEY
user_id         BIGINT REFERENCES users(id)
expert_id       BIGINT REFERENCES users(id) NULL   -- penyuluh yang ditugaskan
title           VARCHAR(500) NOT NULL
status          VARCHAR(20) DEFAULT 'open'          -- open, in_progress, closed
is_private      BOOLEAN DEFAULT TRUE
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### 5.8 Tabel: `consultation_messages`
```sql
id                  BIGSERIAL PRIMARY KEY
consultation_id     BIGINT REFERENCES consultations(id)
sender_id           BIGINT REFERENCES users(id)
message_encrypted   TEXT NOT NULL                   -- dienkripsi dengan Crypt::encryptString()
created_at          TIMESTAMP
updated_at          TIMESTAMP
```

### 5.9 Tabel: `volunteers`
```sql
id              BIGSERIAL PRIMARY KEY
user_id         BIGINT REFERENCES users(id)
program_name    VARCHAR(255) NOT NULL
religion_scope  VARCHAR(20) DEFAULT 'all'
location        VARCHAR(255) NULL
status          VARCHAR(20) DEFAULT 'pending'       -- pending, active, inactive
motivation      TEXT NULL
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### 5.10 Tabel: `user_learning_progress`
```sql
id              BIGSERIAL PRIMARY KEY
user_id         BIGINT REFERENCES users(id)
content_id      BIGINT REFERENCES education_contents(id)
completed       BOOLEAN DEFAULT FALSE
progress_pct    SMALLINT DEFAULT 0                  -- 0-100
last_accessed   TIMESTAMP
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

---

## 6. API INTEGRATION

### 6.1 Aladhan API — Jadwal Sholat

```php
// app/Services/AladhanService.php

class AladhanService
{
    private string $baseUrl = 'https://api.aladhan.com/v1';

    public function getPrayerTimesByCity(string $city = 'Jakarta', string $country = 'Indonesia'): array
    {
        $response = Http::get("{$this->baseUrl}/timingsByCity", [
            'city'    => $city,
            'country' => $country,
            'method'  => 11,  // Kementerian Agama RI
        ]);

        return $response->json('data.timings');
        // Returns: Fajr, Sunrise, Dhuhr, Asr, Maghrib, Isha
    }

    public function getMonthlySchedule(int $month, int $year, string $city = 'Jakarta'): array
    {
        $response = Http::get("{$this->baseUrl}/calendarByCity", [
            'city'    => $city,
            'country' => 'Indonesia',
            'method'  => 11,
            'month'   => $month,
            'year'    => $year,
        ]);

        return $response->json('data');
    }
}
```

**Cache Strategy:** Cache response selama 24 jam karena jadwal harian tidak berubah.
```php
$schedule = Cache::remember("prayer_times_{$city}", now()->endOfDay(), fn() => $this->getPrayerTimesByCity($city));
```

### 6.2 Google Maps + Places API — Rumah Ibadah

```php
// app/Services/GoogleMapsService.php

class GoogleMapsService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.maps_key');
    }

    public function findNearbyWorshipPlaces(float $lat, float $lng, int $radius = 2000): array
    {
        // Gunakan Places API (New) - searchNearby
        $response = Http::withHeaders([
            'X-Goog-Api-Key'        => $this->apiKey,
            'X-Goog-FieldMask'      => 'places.displayName,places.location,places.formattedAddress,places.rating',
        ])->post('https://places.googleapis.com/v1/places:searchNearby', [
            'includedTypes'       => ['mosque', 'church', 'hindu_temple', 'buddhist_temple'],
            'locationRestriction' => [
                'circle' => [
                    'center' => ['latitude' => $lat, 'longitude' => $lng],
                    'radius' => $radius,
                ],
            ],
        ]);

        return $response->json('places', []);
    }
}
```

### 6.3 YouTube Data API — Konten Video

```php
// app/Services/YouTubeService.php

class YouTubeService
{
    public function searchVideos(string $query, int $maxResults = 12): array
    {
        $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
            'part'       => 'snippet',
            'q'          => $query . ' indonesia',
            'type'       => 'video',
            'maxResults' => $maxResults,
            'key'        => config('services.google.youtube_key'),
        ]);

        return collect($response->json('items', []))->map(fn($item) => [
            'video_id'    => $item['id']['videoId'],
            'title'       => $item['snippet']['title'],
            'thumbnail'   => $item['snippet']['thumbnails']['medium']['url'],
            'channel'     => $item['snippet']['channelTitle'],
            'published'   => $item['snippet']['publishedAt'],
        ])->toArray();
    }
}
```

### 6.4 Google Fact Check API — Verifikasi Berita

```php
// app/Services/FactCheckService.php

class FactCheckService
{
    public function checkClaim(string $query): array
    {
        $response = Http::get('https://factchecktools.googleapis.com/v1alpha1/claims:search', [
            'query'        => $query,
            'languageCode' => 'id',
            'key'          => config('services.google.factcheck_key'),
        ]);

        return $response->json('claims', []);
    }
}
```

### 6.5 Web Speech API — Text-to-Speech (Frontend)

```javascript
// resources/js/accessibility.js

function speak(text) {
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'id-ID';
    utterance.rate = 0.9;  // Lebih lambat untuk lansia
    speechSynthesis.speak(utterance);
}

// Attach ke semua elemen dengan data-tts attribute
document.querySelectorAll('[data-tts]').forEach(el => {
    el.addEventListener('click', () => speak(el.dataset.tts || el.textContent));
});
```

---

## 7. ROLE & PERMISSION MATRIX

| Fitur | Guest | User | Penyuluh | Admin |
|-------|-------|------|----------|-------|
| Lihat konten edukasi | ✅ | ✅ | ✅ | ✅ |
| Video animasi anak | ✅ | ✅ | ✅ | ✅ |
| Lihat jadwal ibadah | ✅ | ✅ | ✅ | ✅ |
| Lihat peta rumah ibadah | ✅ | ✅ | ✅ | ✅ |
| Lihat campaign donasi | ✅ | ✅ | ✅ | ✅ |
| Lihat hasil cek fakta | ✅ | ✅ | ✅ | ✅ |
| **Melakukan donasi** | ❌ | ✅ | ✅ | ✅ |
| **Daftar relawan** | ❌ | ✅ | ✅ | ✅ |
| **Buat konsultasi** | ❌ | ✅ | ✅ | ✅ |
| **Akses dashboard pribadi** | ❌ | ✅ | ✅ | ✅ |
| **Upload konten edukasi** | ❌ | ❌ | ✅ | ✅ |
| **Jawab konsultasi** | ❌ | ❌ | ✅ | ✅ |
| **Submit cek fakta** | ❌ | ❌ | ✅ | ✅ |
| **Approve/reject konten** | ❌ | ❌ | ❌ | ✅ |
| **Manajemen user** | ❌ | ❌ | ❌ | ✅ |
| **Kelola campaign donasi** | ❌ | ❌ | ❌ | ✅ |
| **Akses panel admin** | ❌ | ❌ | ❌ | ✅ |

**Implementasi di Laravel:**
```php
// app/Http/Middleware/RoleMiddleware.php
public function handle(Request $request, Closure $next, string ...$roles): Response
{
    if (!in_array(auth()->user()?->role, $roles)) {
        abort(403, 'Unauthorized');
    }
    return $next($request);
}

// routes/web.php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () { ... });
Route::middleware(['auth', 'role:admin,penyuluh'])->group(function () { ... });
```

---

## 8. DEVELOPMENT ROADMAP (SPRINT PLAN)

### Sprint 0 — Setup & Fondasi (Week 1)
**Goal:** Project siap untuk development, tidak ada blocker teknis.

| Task | Output |
|------|--------|
| Init Laravel 11 project | `composer create-project laravel/laravel harmony-digital` |
| Setup Supabase + koneksi DB | `.env` terkonfigurasi, koneksi berhasil |
| Install & config Tailwind CSS + Alpine.js | `npm install`, vite build |
| Install Livewire 3 | `composer require livewire/livewire` |
| Setup Laravel Breeze (Blade) | Auth scaffolding selesai |
| Buat semua migrations | Semua tabel sudah `php artisan migrate` |
| Buat Seeders & Factories | Data dummy untuk development |
| Setup Role Middleware | `RoleMiddleware` terdaftar di kernel |
| Setup Docker / Laravel Sail | Dev environment bisa dijalankan |

---

### Sprint 1 — Authentication & User Module (Week 2)
**Goal:** User bisa register, login, dan akses dashboard sesuai role.

| Task | File yang dibuat/diubah |
|------|------------------------|
| Kustomisasi form register (tambah `religion_preference`) | `RegisteredUserController`, `register.blade.php` |
| Implementasi Role Middleware | `app/Http/Middleware/RoleMiddleware.php` |
| Buat halaman Dashboard user | `DashboardController`, `dashboard/index.blade.php` |
| Buat halaman profil & edit profil | `ProfileController`, `dashboard/profile.blade.php` |
| Proteksi route dengan middleware | `routes/web.php` |
| Testing: register, login, logout, akses antar role | Manual test / Feature test |

---

### Sprint 2 — Worship Assistant Module (Week 3)
**Goal:** Jadwal sholat dan peta rumah ibadah berfungsi live.

| Task | File yang dibuat/diubah |
|------|------------------------|
| Buat `AladhanService` | `app/Services/AladhanService.php` |
| Buat `CalendarificService` | `app/Services/CalendarificService.php` |
| Buat `GoogleMapsService` | `app/Services/GoogleMapsService.php` |
| Buat `WorshipController` + routes | `WorshipController.php`, routes |
| Buat view jadwal sholat | `worship/schedule.blade.php` |
| Integrasi Google Maps JS API di frontend | `worship/map.blade.php` |
| Geolocation user → kirim ke controller | Alpine.js + Axios |
| Buat halaman panduan ritual | `worship/guide.blade.php` |
| Buat halaman etiket bertamu | `worship/etiquette.blade.php` |
| Caching response API Aladhan | `Cache::remember()` |

---

### Sprint 3 — Education & Literacy Module (Week 4–5)
**Goal:** Konten edukasi bisa dibaca, video bisa ditonton, kurator bisa upload.

| Task | File yang dibuat/diubah |
|------|------------------------|
| Buat `YouTubeService` | `app/Services/YouTubeService.php` |
| Buat `EducationController` + routes | Controller + routes |
| Buat Model + Migration `education_contents`, `religion_categories` | Migrations, Models |
| Buat view listing konten per agama | `education/index.blade.php` |
| Buat view detail artikel | `education/show.blade.php` |
| Buat view galeri video YouTube | `education/gallery.blade.php` |
| Buat view wisata virtual | `education/virtual-tour.blade.php` |
| Buat form upload konten (penyuluh) | Upload form, validation |
| Buat fitur approval konten (admin) | Admin content management |
| Tracking `user_learning_progress` | Model + Controller logic |
| Lazy loading untuk gambar/video | `loading="lazy"` attribute + JS |

---

### Sprint 4 — Social Action Module (Week 6–7)
**Goal:** Donasi, relawan, cek fakta, dan konsultasi berjalan end-to-end.

| Task | File yang dibuat/diubah |
|------|------------------------|
| Buat `DonationController` + routes | Controller, routes, views |
| Buat `DonationProject` & `Donation` model | Models, Migrations |
| Integrasi Chart.js untuk statistik donasi | `donations/show.blade.php` |
| Buat `VolunteerController` + form pendaftaran | Controller, views |
| Buat `FactCheckService` | `app/Services/FactCheckService.php` |
| Buat `FactCheckController` + routes | Controller, routes, views |
| Buat `EncryptionService` | `app/Services/EncryptionService.php` |
| Buat Livewire component `ConsultationChat` | `app/Livewire/ConsultationChat.php` |
| Buat `ConsultationController` + routes | Controller, routes |
| Testing enkripsi pesan konsultasi | Unit test Encryption |

---

### Sprint 5 — Admin Panel & Analytics (Week 8)
**Goal:** Admin bisa mengelola semua konten dan melihat statistik platform.

| Task | File yang dibuat/diubah |
|------|------------------------|
| Install & setup Filament PHP | `composer require filament/filament` |
| Buat Resource: UserResource | Filament admin |
| Buat Resource: EducationContentResource | Filament admin |
| Buat Resource: DonationProjectResource | Filament admin |
| Buat Resource: FactCheckResource | Filament admin |
| Buat Dashboard widget (statistik) | Filament widgets |
| Proteksi panel admin dengan role:admin | Middleware |

---

### Sprint 6 — Accessibility, Optimization & Testing (Week 9–10)
**Goal:** Platform siap production, aksesibel untuk semua kelompok usia.

| Task | Detail |
|------|--------|
| Implementasi Text-to-Speech | Web Speech API, `data-tts` attributes |
| Mode hemat data | Lazy loading, image compression |
| Optimasi query DB | Eager loading, index, query analysis |
| Responsive & mobile-first testing | Chrome DevTools, BrowserStack |
| Security audit | CSRF, XSS, SQL injection check |
| Feature testing | Laravel Pest / PHPUnit |
| Deployment ke production | Railway / VPS |
| Monitoring | Laravel Telescope (dev), Sentry (prod) |

---

## 9. NON-FUNCTIONAL REQUIREMENTS

### 9.1 Security
- Semua form wajib CSRF protection (Laravel default)
- Password hashing: bcrypt (Laravel default)
- Pesan konsultasi: AES-256-CBC via `Crypt::encryptString()`
- Rate limiting pada API routes: `throttle:60,1` middleware
- Sanitasi input: `strip_tags()` + Laravel validation rules
- HTTPS wajib di production (enforced via Cloudflare)

### 9.2 Performance
- Target page load: < 3 detik (3G connection)
- Caching API response: Redis dengan TTL yang sesuai
- Gambar: lazy loading + WebP format
- Database: tambahkan index pada kolom yang sering di-query (`user_id`, `status`, `religion_id`)

### 9.3 Accessibility
- Konten anak: tanpa login, visual-first
- Lansia: font size minimal 18px, kontras tinggi, tombol besar
- Text-to-Speech: tersedia di seluruh halaman konten
- Alt text wajib pada semua gambar

### 9.4 Scalability
- Stateless session (bisa di-scale horizontal)
- Queue untuk proses berat (email notifikasi, API call async): Laravel Horizon
- File upload ke cloud storage (Supabase Storage / S3)

---

## 10. GLOSSARY

| Term | Definisi |
|------|----------|
| Penyuluh | User dengan role khusus — ahli agama resmi yang dikurasi oleh admin untuk upload konten dan menjawab konsultasi |
| Cek Fakta | Proses verifikasi klaim/berita terkait isu keagamaan menggunakan Google Fact Check API dan review manual penyuluh |
| Ruang Tanya Moderat | Fitur konsultasi privat terenkripsi antara user awam dan penyuluh resmi |
| Wisata Religi Virtual | Konten berupa foto 360° atau video tour rumah ibadah yang dapat dilihat tanpa perlu berkunjung langsung |
| `religion_preference` | Field opsional di profil user untuk personalisasi konten — tidak wajib diisi, tidak digunakan untuk membatasi akses |

---

*Document ini merupakan living document. Update setiap kali ada perubahan arsitektur atau scope fitur.*
*Maintainer: Tim Development Harmony Digital*