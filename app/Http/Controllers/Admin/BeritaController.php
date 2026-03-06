<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BeritaRequest;
use App\Services\BeritaService;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function __construct(private BeritaService $service) {}

    public function index(Request $request)
    {
        $berita = $this->service->getAll(
            $request->input('search', ''),
            $request->input('status', '')
        );
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(BeritaRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $this->service->create($data, $request->file('gambar'));
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $berita = $this->service->findById($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(BeritaRequest $request, int $id)
    {
        $this->service->update($id, $request->validated(), $request->file('gambar'));
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function show(int $id) {}
}
