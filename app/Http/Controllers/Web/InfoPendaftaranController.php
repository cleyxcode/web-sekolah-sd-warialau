<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\InfoPendaftaran;

class InfoPendaftaranController extends Controller
{
    public function index()
    {
        $info = InfoPendaftaran::where('status', 'aktif')
            ->where('tanggal_tutup', '>=', now())
            ->latest()
            ->first();

        $riwayat = InfoPendaftaran::where('status', 'aktif')
            ->orderByDesc('tanggal_buka')
            ->get();

        return view('web.info-pendaftaran.index', compact('info', 'riwayat'));
    }
}
