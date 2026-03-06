<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\InfoPendaftaran;
use App\Models\ProfilSekolah;
use App\Models\Siswa;

class BerandaController extends Controller
{
    public function index()
    {
        $profil        = ProfilSekolah::first();
        $totalGuru     = Guru::count();
        $totalSiswa    = Siswa::count();
        $beritaTerbaru = Berita::where('status', 'publish')->latest('tanggal_publish')->take(3)->get();
        $galeriTerbaru = Galeri::latest()->take(8)->get();
        $infoPendaftaran = InfoPendaftaran::where('status', 'aktif')
            ->where('tanggal_tutup', '>=', now())
            ->latest()
            ->first();

        return view('web.beranda.index', compact(
            'profil', 'totalGuru', 'totalSiswa',
            'beritaTerbaru', 'galeriTerbaru', 'infoPendaftaran'
        ));
    }
}
