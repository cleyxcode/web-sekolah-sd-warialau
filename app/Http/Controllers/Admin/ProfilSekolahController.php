<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProfilSekolahService;
use Illuminate\Http\Request;

class ProfilSekolahController extends Controller
{
    public function __construct(private ProfilSekolahService $service) {}

    public function edit()
    {
        $profil = $this->service->get();
        return view('admin.profil-sekolah.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'alamat'       => ['nullable', 'string', 'max:500'],
            'kontak'       => ['nullable', 'string', 'max:100'],
            'visi'         => ['nullable', 'string'],
            'misi'         => ['nullable', 'string'],
            'sejarah'      => ['nullable', 'string'],
            'logo'         => ['nullable', 'image', 'max:2048'],
        ]);

        $this->service->update($data, $request->file('logo'));

        return redirect()->route('admin.profil-sekolah.edit')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
