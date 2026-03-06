<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\InfoPendaftaranController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\ProfilSekolahController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\BerandaController;
use App\Http\Controllers\Web\BeritaController as WebBeritaController;
use App\Http\Controllers\Web\GaleriController as WebGaleriController;
use App\Http\Controllers\Web\GuruController as WebGuruController;
use App\Http\Controllers\Web\InfoPendaftaranController as WebInfoPendaftaranController;
use App\Http\Controllers\Web\PendaftaranController as WebPendaftaranController;
use App\Http\Controllers\Web\ProfilController;
use Illuminate\Support\Facades\Route;

// ─── Web Pengunjung (Publik) ───────────────────────────────────────────────
Route::name('web.')->group(function () {

    Route::get('/', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/guru', [WebGuruController::class, 'index'])->name('guru');
    Route::get('/galeri', [WebGaleriController::class, 'index'])->name('galeri');
    Route::get('/berita', [WebBeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/{berita}', [WebBeritaController::class, 'show'])->name('berita.show');
    Route::get('/info-pendaftaran', [WebInfoPendaftaranController::class, 'index'])->name('info-pendaftaran');

    // Auth orang tua (guest only)
    Route::middleware('guest')->prefix('akun')->name('auth.')->group(function () {
        Route::get('/login',    [LoginController::class, 'showLogin'])->name('login');
        Route::post('/login',   [LoginController::class, 'login']);
        Route::get('/daftar',   [RegisterController::class, 'showRegister'])->name('register');
        Route::post('/daftar',  [RegisterController::class, 'register']);
    });

    Route::post('/akun/logout', [LoginController::class, 'logout'])->name('auth.logout');

    // Protected (orang tua harus login)
    Route::middleware('orangtua')->prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/formulir',  [WebPendaftaranController::class, 'form'])->name('form');
        Route::post('/formulir', [WebPendaftaranController::class, 'store'])->name('store');
        Route::get('/sukses',    [WebPendaftaranController::class, 'sukses'])->name('sukses');
        Route::get('/status',    [WebPendaftaranController::class, 'status'])->name('status');
    });
});

// ─── Admin Panel ───────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest only
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Auth only
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profil-sekolah', [ProfilSekolahController::class, 'edit'])->name('profil-sekolah.edit');
        Route::put('/profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profil-sekolah.update');

        Route::resource('guru', GuruController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('berita', BeritaController::class);
        Route::resource('galeri', GaleriController::class);
        Route::resource('info-pendaftaran', InfoPendaftaranController::class);

        Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
        Route::put('pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
    });
});
