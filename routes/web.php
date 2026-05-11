<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\FactCheckController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\WorshipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/donations', [DashboardController::class, 'donations'])->name('dashboard.donations');
    Route::get('/dashboard/belajar', [DashboardController::class, 'learning'])->name('dashboard.learning');
    Route::get('/dashboard/konsultasi', [DashboardController::class, 'consultations'])->name('dashboard.consultations');
});

Route::prefix('edukasi')->name('edukasi.')->group(function () {
    Route::get('/', [EducationController::class, 'index'])->name('index');
    Route::get('/video', [EducationController::class, 'gallery'])->name('gallery');
    Route::get('/video/{slug}', [EducationController::class, 'show'])->name('show');
    Route::get('/virtual-tour', [EducationController::class, 'virtualTour'])->name('virtual-tour');
    Route::get('/{slug}', [EducationController::class, 'byReligion'])->name('religion');
});

Route::prefix('ibadah')->name('ibadah.')->group(function () {
    Route::get('/', [WorshipController::class, 'index'])->name('index');
    Route::get('/jadwal', [WorshipController::class, 'schedule'])->name('schedule');
    Route::get('/peta', [WorshipController::class, 'map'])->name('map');
    Route::get('/peta/cari', [WorshipController::class, 'findNearbyPlaces'])->name('map.search');
    Route::get('/panduan/{religion?}', [WorshipController::class, 'guide'])->name('guide');
    Route::get('/etiket/{religion?}', [WorshipController::class, 'etiquette'])->name('etiquette');
});

Route::prefix('aksi')->name('aksi.')->group(function () {
    Route::prefix('donasi')->name('donasi.')->group(function () {
        Route::get('/', [DonationController::class, 'index'])->name('index');
        Route::get('/create', [DonationController::class, 'create'])->name('create')->middleware(['auth', 'role:admin,penyuluh']);
        Route::post('/', [DonationController::class, 'storeProject'])->name('store')->middleware(['auth', 'role:admin,penyuluh']);
        Route::get('/{id}', [DonationController::class, 'show'])->name('show');
        Route::post('/{id}', [DonationController::class, 'store'])->name('donate')->middleware('auth');
    });

    Route::prefix('relawan')->name('volunteers.')->group(function () {
        Route::get('/', [VolunteerController::class, 'index'])->name('index');
        Route::get('/daftar', [VolunteerController::class, 'create'])->name('create')->middleware('auth');
        Route::post('/daftar', [VolunteerController::class, 'store'])->name('store')->middleware('auth');
        Route::get('/saya', [VolunteerController::class, 'myVolunteers'])->name('my')->middleware('auth');
    });

    Route::prefix('cek-fakta')->name('cek-fakta.')->group(function () {
        Route::get('/', [FactCheckController::class, 'index'])->name('index');
        Route::get('/cek', [FactCheckController::class, 'check'])->name('check');
        Route::get('/create', [FactCheckController::class, 'create'])->name('create')->middleware(['auth', 'role:admin,penyuluh']);
        Route::post('/', [FactCheckController::class, 'store'])->name('store')->middleware(['auth', 'role:admin,penyuluh']);
        Route::get('/{id}', [FactCheckController::class, 'show'])->name('show');
    });

    Route::prefix('konsultasi')->name('consultations.')->group(function () {
        Route::get('/', [ConsultationController::class, 'index'])->name('index')->middleware('auth');
        Route::get('/create', [ConsultationController::class, 'create'])->name('create')->middleware('auth');
        Route::post('/', [ConsultationController::class, 'store'])->name('store')->middleware('auth');
        Route::get('/{id}', [ConsultationController::class, 'show'])->name('show')->middleware('auth');
        Route::post('/{id}/message', [ConsultationController::class, 'sendMessage'])->name('message')->middleware('auth');
    });
});

require __DIR__.'/auth.php';
