<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InfoPendaftaranRequest;
use App\Services\InfoPendaftaranService;

class InfoPendaftaranController extends Controller
{
    public function __construct(private InfoPendaftaranService $service) {}

    public function index()
    {
        $infoPendaftaran = $this->service->getAll();
        return view('admin.info-pendaftaran.index', compact('infoPendaftaran'));
    }

    public function create()
    {
        return view('admin.info-pendaftaran.create');
    }

    public function store(InfoPendaftaranRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $this->service->create($data);
        return redirect()->route('admin.info-pendaftaran.index')
            ->with('success', 'Info pendaftaran berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $info = $this->service->findById($id);
        return view('admin.info-pendaftaran.edit', compact('info'));
    }

    public function update(InfoPendaftaranRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('admin.info-pendaftaran.index')
            ->with('success', 'Info pendaftaran berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.info-pendaftaran.index')
            ->with('success', 'Info pendaftaran berhasil dihapus.');
    }

    public function show(int $id) {}
}
