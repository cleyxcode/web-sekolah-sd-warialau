<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GuruRequest;
use App\Services\GuruService;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function __construct(private GuruService $service) {}

    public function index(Request $request)
    {
        $guru = $this->service->getAll($request->input('search', ''));
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(GuruRequest $request)
    {
        $this->service->create($request->validated(), $request->file('foto'));
        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $guru = $this->service->findById($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(GuruRequest $request, int $id)
    {
        $this->service->update($id, $request->validated(), $request->file('foto'));
        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    public function show(int $id) {}
}
