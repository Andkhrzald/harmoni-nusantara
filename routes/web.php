<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\FactCheckController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\WorshipController;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

// ─── Landing ────────────────────────────────────────────────────────────────
Route::get('/', function () {
    $testimonials = Testimonial::approved()->latest()->take(6)->get();

    return view('welcome', compact('testimonials'));
})->name('home');

// ─── Dashboard (auth) ────────────────────────────────────────────────────────
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard sub-pages
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/donations', [DashboardController::class, 'donations'])->name('donations');
        Route::get('/belajar', [DashboardController::class, 'learning'])->name('learning');
        Route::get('/konsultasi', [DashboardController::class, 'consultations'])->name('consultations');
    });
});

// ─── Edukasi ─────────────────────────────────────────────────────────────────
// AladhanService  → ibadah.jadwal   (WorshipController::schedule)
// CalendarificService → ibadah.jadwal  (bersatu di controller yang sama ↑)
// YouTubeService  → edukasi.video.cari (EducationController::youtubeSearch)
Route::prefix('edukasi')->name('edukasi.')->group(function () {
    Route::get('/', [EducationController::class, 'index'])->name('index');
    Route::get('/virtual-tour', [EducationController::class, 'virtualTour'])->name('virtual-tour');

    // Video sub-group — semua rute /edukasi/video/* dinaungi prefix & name yang sama
    Route::prefix('video')->name('video.')->group(function () {
        Route::get('/', [EducationController::class, 'gallery'])->name('index');   // edukasi.video.index
        Route::get('/cari', [EducationController::class, 'youtubeSearch'])->name('cari'); // edukasi.video.cari
        Route::get('/{slug}', [EducationController::class, 'show'])->name('show');        // edukasi.video.show
    });

    // Harus di bawah /video agar {slug} tidak menangkap "video"
    Route::get('/{slug}', [EducationController::class, 'byReligion'])->name('agama'); // edukasi.agama
});

// ─── Ibadah ──────────────────────────────────────────────────────────────────
// AladhanService + CalendarificService → /ibadah/jadwal (WorshipController::schedule)
// GoogleMapsService (client-side JS)   → /ibadah/peta   (WorshipController::map)
Route::prefix('ibadah')->name('ibadah.')->group(function () {
    Route::get('/', [WorshipController::class, 'index'])->name('index');

    // Jadwal sholat — menggabungkan AladhanService (waktu sholat) dan
    // CalendarificService (hari libur nasional) dalam satu action.
    Route::get('/jadwal', [WorshipController::class, 'schedule'])->name('jadwal');  // ibadah.jadwal

    // Peta ibadah — GoogleMapsService dipanggil client-side (JS Places API).
    Route::get('/peta', [WorshipController::class, 'map'])->name('peta');           // ibadah.peta
    Route::get('/peta/cari', [WorshipController::class, 'findNearbyPlaces'])->name('peta.cari'); // ibadah.peta.cari

    Route::get('/panduan/{religion?}', [WorshipController::class, 'guide'])->name('panduan');    // ibadah.panduan
    Route::get('/etiket/{religion?}', [WorshipController::class, 'etiquette'])->name('etiket'); // ibadah.etiket
});

// ─── Aksi ────────────────────────────────────────────────────────────────────
Route::prefix('aksi')->name('aksi.')->group(function () {
    // Donasi
    Route::prefix('donasi')->name('donasi.')->group(function () {
        Route::get('/', [DonationController::class, 'index'])->name('index');
        Route::get('/create', [DonationController::class, 'create'])->name('create')->middleware(['auth', 'role:admin,penyuluh']);
        Route::post('/', [DonationController::class, 'storeProject'])->name('store')->middleware(['auth', 'role:admin,penyuluh']);
        Route::get('/{id}', [DonationController::class, 'show'])->name('show');
        Route::post('/{id}', [DonationController::class, 'store'])->name('donate')->middleware('auth');
    });

    // Relawan
    Route::prefix('relawan')->name('relawan.')->group(function () {
        Route::get('/', [VolunteerController::class, 'index'])->name('index');
        Route::get('/daftar', [VolunteerController::class, 'create'])->name('create')->middleware('auth');
        Route::post('/daftar', [VolunteerController::class, 'store'])->name('store')->middleware('auth');
        Route::get('/saya', [VolunteerController::class, 'myVolunteers'])->name('saya')->middleware('auth');
    });

    // Cek Fakta — FactCheckService (Google Fact Check Tools API)
    // Query-string ?q= ditangani langsung di FactCheckController::check()
    Route::prefix('cek-fakta')->name('fakta.')->group(function () {
        Route::get('/', [FactCheckController::class, 'index'])->name('index');     // aksi.fakta.index
        Route::get('/cek', [FactCheckController::class, 'check'])->name('cek');   // aksi.fakta.cek
        Route::get('/create', [FactCheckController::class, 'create'])->name('create')->middleware(['auth', 'role:admin,penyuluh']);
        Route::post('/', [FactCheckController::class, 'store'])->name('store')->middleware(['auth', 'role:admin,penyuluh']);
        Route::get('/{id}', [FactCheckController::class, 'show'])->name('show');
    });

    // Konsultasi
    Route::prefix('konsultasi')->name('konsultasi.')->group(function () {
        Route::get('/', [ConsultationController::class, 'index'])->name('index')->middleware('auth');
        Route::get('/create', [ConsultationController::class, 'create'])->name('create')->middleware('auth');
        Route::post('/', [ConsultationController::class, 'store'])->name('store')->middleware('auth');
        Route::get('/{id}', [ConsultationController::class, 'show'])->name('show')->middleware('auth');
        Route::post('/{id}/message', [ConsultationController::class, 'sendMessage'])->name('pesan')->middleware('auth');
    });
});

// ─── Forum ───────────────────────────────────────────────────────────────────
Route::get('/forum', [ForumController::class, 'index'])->name('forum');

Route::middleware('auth')->group(function () {
    Route::post('/forum/message', [ForumController::class, 'storeMessage'])->name('forum.pesan');
    Route::post('/forum/request-join', [ForumController::class, 'requestJoin'])->name('forum.gabung');
    Route::post('/forum/approve/{user}', [ForumController::class, 'approveMember'])->name('forum.setujui');
});

// ─── Testimoni ───────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/testimoni/buat', [TestimonialController::class, 'create'])->name('testimoni.create');
    Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimoni.store');
});

// ─── Dashboard Admin/Penyuluh ─────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,penyuluh'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/testimoni', [DashboardController::class, 'testimonials'])->name('testimonials');
    Route::patch('/testimoni/{id}/approve', [TestimonialController::class, 'approve'])->name('testimoni.approve');
    Route::delete('/testimoni/{id}/reject', [TestimonialController::class, 'reject'])->name('testimoni.reject');
});

require __DIR__.'/auth.php';
