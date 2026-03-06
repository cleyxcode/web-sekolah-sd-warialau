<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiswaRequest;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct(private SiswaService $service) {}

    public function index(Request $request)
    {
        $siswa = $this->service->getAll($request->input('search', ''));
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(SiswaRequest $request)
    {
        $this->service->create($request->validated(), $request->file('foto'));
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $siswa = $this->service->findById($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(SiswaRequest $request, int $id)
    {
        $this->service->update($id, $request->validated(), $request->file('foto'));
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function show(int $id) {}
}
