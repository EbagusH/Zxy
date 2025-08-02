<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DaftarPegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeaderFotoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LinjamsosController;
use App\Http\Controllers\DayasosController;
use App\Http\Controllers\ResosController;
use App\Http\Controllers\RumahSinggahController;
use App\Http\Controllers\SambutanKepalaDinasController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\VisiMisiController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Berita Routes
Route::get('/berita', [BeritaController::class, 'publicIndex'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'publicShow'])->name('berita.show');

// Public Layanan Route
Route::get('/layanan', [LayananController::class, 'showPublic'])->name('layanan');

Route::get('/rumah-singgah', [RumahSinggahController::class, 'show'])->name('rumah-singgah');

// PUBLIC PROFIL ROUTES
Route::get('/profil/sambutan', [SambutanKepalaDinasController::class, 'index'])->name('profil.sambutan');

Route::get('/profil/struktur', [StrukturOrganisasiController::class, 'index'])->name('profil.struktur');

Route::get('/profil/pegawai', [DaftarPegawaiController::class, 'showPublic'])->name('profil.pegawai');

Route::get('/profil/visi-misi', [VisiMisiController::class, 'show'])->name('profil.visi-misi');

Route::get('/profil/linjamsos', [LinjamsosController::class, 'show'])->name('profil.linjamsos');

Route::get('/profil/dayasos', [DayasosController::class, 'show'])->name('profil.dayasos');

Route::get('/profil/resos', [ResosController::class, 'show'])->name('profil.resos');

// Login Form (GET) - hanya bisa diakses jika belum login
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
});

// Proses Login (POST) - hanya bisa diakses jika belum login
Route::middleware(['guest'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

// Dashboard Routes - hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [AuthController::class, 'showAdminProfile'])->name('admin.profile');
    Route::put('/admin/profile/foto', [AuthController::class, 'updateFoto'])->name('admin.updateFoto');
    Route::put('/admin/profile/password', [AuthController::class, 'updatePassword'])->name('admin.updatePassword');

    // Dashboard utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index-admin');

    // Edit-Header
    Route::get('/header', [HeaderFotoController::class, 'edit'])->name('dashboard.edit-header');
    Route::put('/header', [HeaderFotoController::class, 'update'])->name('dashboard.edit-header.update');

    // Dashboard sub-menu - UPDATED: Menggunakan BeritaController
    Route::get('/dashboard/berita', [BeritaController::class, 'index'])->name('dashboard.berita-admin');
    Route::get('/dashboard/berita/search', [BeritaController::class, 'search'])->name('dashboard.berita-admin.search');

    Route::delete('/dashboard/berita/{id}', [BeritaController::class, 'destroy'])->name('dashboard.berita-admin.destroy');

    // Dashboard Layanan Routes
    Route::get('/dashboard/layanan', [LayananController::class, 'index'])->name('dashboard.layanan-admin');

    // Rumah Singgah
    Route::get('/rumahsinggah', [RumahSinggahController::class, 'edit'])->name('dashboard.rumah-singgah-admin');
    Route::put('/rumahsinggah', [RumahSinggahController::class, 'update'])->name('rumah-singgah.update');

    Route::prefix('dashboard/profil')->name('dashboard.profil.')->group(function () {

        // Sambutan Kepala Dinas
        Route::get('/sambutan', [SambutanKepalaDinasController::class, 'edit'])->name('sambutan');
        Route::put('/sambutan', [SambutanKepalaDinasController::class, 'update'])->name('sambutan.update');

        // Struktur Organisasi
        Route::get('/struktur', [StrukturOrganisasiController::class, 'edit'])->name('struktur');
        Route::put('/struktur', [StrukturOrganisasiController::class, 'update'])->name('struktur.update');

        // Visi Misi
        Route::get('/visimisi', [VisiMisiController::class, 'edit'])->name('visimisi');
        Route::put('/visimisi', [VisiMisiController::class, 'update'])->name('visi-misi.update');

        // Pegawai - FIXED ROUTES
        Route::get('/pegawai', [DaftarPegawaiController::class, 'index'])->name('pegawai-admin');
        Route::get('/pegawai/create', [DaftarPegawaiController::class, 'create'])->name('pegawai.create');
        Route::post('/pegawai', [DaftarPegawaiController::class, 'store'])->name('pegawai.store');
        Route::get('/pegawai/{pegawai}/edit', [DaftarPegawaiController::class, 'edit'])->name('pegawai.edit');
        Route::put('/pegawai/{pegawai}', [DaftarPegawaiController::class, 'update'])->name('pegawai.update');
        Route::delete('/pegawai/{pegawai}', [DaftarPegawaiController::class, 'destroy'])->name('pegawai.destroy');

        // Linjamsos Routes
        Route::get('/linjamsos', [LinjamsosController::class, 'edit'])->name('linjamsos');
        Route::put('/linjamsos', [LinjamsosController::class, 'update'])->name('linjamsos.update');

        // Dayasos Routes
        Route::get('/dayasos', [DayasosController::class, 'edit'])->name('dayasos');
        Route::put('/dayasos', [DayasosController::class, 'update'])->name('dayasos.update');

        // Resos Routes
        Route::get('/resos', [ResosController::class, 'edit'])->name('resos');
        Route::put('/resos', [ResosController::class, 'update'])->name('resos.update');
    });

    // Layanan CRUD Routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
        Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    });

    // CRUD Routes untuk Berita
    Route::get('/dashboard/crud-berita', [BeritaController::class, 'create'])->name('dashboard.crud-berita');
    Route::post('/dashboard/crud-berita', [BeritaController::class, 'store'])->name('dashboard.crud-berita.store');
    Route::get('/dashboard/berita/{id}', [BeritaController::class, 'show'])->name('dashboard.berita-admin.show');
    Route::get('/dashboard/berita/{id}/edit', [BeritaController::class, 'edit'])->name('dashboard.berita-admin.edit');
    Route::put('/dashboard/berita/{id}', [BeritaController::class, 'update'])->name('dashboard.berita-admin.update');
    Route::delete('/dashboard/berita/{id}', [BeritaController::class, 'destroy'])->name('dashboard.berita-admin.destroy');
});

// Logout (POST) - hanya bisa diakses jika sudah login
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Redirect route untuk backward compatibility
Route::get('/auth/login', function () {
    return redirect()->route('login');
});
