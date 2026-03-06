<?php

namespace App\Repositories;

use App\Models\Pendaftaran;
use Illuminate\Pagination\LengthAwarePaginator;

class PendaftaranRepository
{
    public function getAll(string $search = '', string $status = ''): LengthAwarePaginator
    {
        return Pendaftaran::with('infoPendaftaran')
            ->when($search, fn($q) => $q->where('nama_anak', 'like', "%{$search}%")
                ->orWhere('nama_ortu', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function findById(int $id): Pendaftaran
    {
        return Pendaftaran::with('infoPendaftaran')->findOrFail($id);
    }

    public function updateStatus(int $id, string $status): Pendaftaran
    {
        $pendaftaran = $this->findById($id);
        $pendaftaran->update(['status' => $status]);
        return $pendaftaran;
    }
}
