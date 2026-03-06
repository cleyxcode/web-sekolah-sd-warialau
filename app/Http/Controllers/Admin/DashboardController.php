<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Guru;
use App\Models\Pendaftaran;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_guru'        => Guru::count(),
            'total_siswa'       => Siswa::count(),
            'total_berita'      => Berita::where('status', 'publish')->count(),
            'total_pendaftaran' => Pendaftaran::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard.index', compact('stats'));
    }
}
