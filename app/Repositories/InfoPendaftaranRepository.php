<?php

namespace App\Repositories;

use App\Models\InfoPendaftaran;
use Illuminate\Pagination\LengthAwarePaginator;

class InfoPendaftaranRepository
{
    public function getAll(): LengthAwarePaginator
    {
        return InfoPendaftaran::with('user')
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function findById(int $id): InfoPendaftaran
    {
        return InfoPendaftaran::findOrFail($id);
    }

    public function create(array $data): InfoPendaftaran
    {
        return InfoPendaftaran::create($data);
    }

    public function update(int $id, array $data): InfoPendaftaran
    {
        $info = $this->findById($id);
        $info->update($data);
        return $info;
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getAktif(): ?InfoPendaftaran
    {
        return InfoPendaftaran::where('status', 'aktif')
            ->where('tanggal_tutup', '>=', now())
            ->latest()
            ->first();
    }
}
