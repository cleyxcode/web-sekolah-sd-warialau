<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PendaftaranService;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function __construct(private PendaftaranService $service) {}

    public function index(Request $request)
    {
        $pendaftaran = $this->service->getAll(
            $request->input('search', ''),
            $request->input('status', '')
        );
        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }

    public function show(int $id)
    {
        $pendaftaran = $this->service->findById($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate(['status' => ['required', 'in:pending,diterima,ditolak']]);
        $this->service->updateStatus($id, $request->input('status'));
        return redirect()->route('admin.pendaftaran.show', $id)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
