<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaleriRequest;
use App\Services\GaleriService;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function __construct(private GaleriService $service) {}

    public function index(Request $request)
    {
        $galeri = $this->service->getAll($request->input('search', ''));
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(GaleriRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $this->service->create($data, $request->file('foto'));
        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diupload.');
    }

    public function edit(int $id)
    {
        $galeri = $this->service->findById($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(GaleriRequest $request, int $id)
    {
        $this->service->update($id, $request->validated(), $request->file('foto'));
        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }

    public function show(int $id) {}
}
