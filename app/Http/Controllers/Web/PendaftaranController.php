<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\InfoPendaftaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function form()
    {
        $info = InfoPendaftaran::where('status', 'aktif')
            ->where('tanggal_tutup', '>=', now())
            ->latest()
            ->first();

        abort_if(! $info, 404, 'Pendaftaran sedang tidak dibuka.');

        $sudahDaftar = Pendaftaran::where('user_id', auth()->id())
            ->where('info_pendaftaran_id', $info->id)
            ->exists();

        return view('web.pendaftaran.form', compact('info', 'sudahDaftar'));
    }

    public function store(Request $request)
    {
        $info = InfoPendaftaran::where('status', 'aktif')
            ->where('tanggal_tutup', '>=', now())
            ->latest()
            ->first();

        abort_if(! $info, 404);

        $validated = $request->validate([
            'nama_anak'      => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'required|string',
            'nama_ortu'      => 'required|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'dokumen'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $validated['info_pendaftaran_id'] = $info->id;
        $validated['user_id']             = auth()->id();
        $validated['status']              = 'pending';

        if ($request->hasFile('dokumen')) {
            $validated['dokumen'] = $request->file('dokumen')->store('dokumen', 'public');
        }

        Pendaftaran::create($validated);

        return redirect()->route('web.pendaftaran.sukses');
    }

    public function sukses()
    {
        return view('web.pendaftaran.sukses');
    }

    public function status()
    {
        $pendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->with('infoPendaftaran')
            ->latest()
            ->get();

        return view('web.pendaftaran.status', compact('pendaftaran'));
    }
}
