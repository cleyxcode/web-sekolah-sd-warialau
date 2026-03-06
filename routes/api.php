<?php

use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\GaleriController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\InfoPendaftaranController;
use App\Http\Controllers\Api\ProfilSekolahController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function () {

    // C1 — Profil Sekolah
    Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index']);

    // C2 — Guru
    Route::get('/guru', [GuruController::class, 'index']);

    // C3 — Berita
    Route::get('/berita', [BeritaController::class, 'index']);
    Route::get('/berita/{id}', [BeritaController::class, 'show']);

    // C4 — Galeri
    Route::get('/galeri', [GaleriController::class, 'index']);

    // C5 — Info Pendaftaran Aktif
    Route::get('/info-pendaftaran/aktif', [InfoPendaftaranController::class, 'aktif']);
});
