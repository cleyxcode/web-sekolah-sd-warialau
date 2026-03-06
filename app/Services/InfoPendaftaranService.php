<?php

namespace App\Services;

use App\Models\InfoPendaftaran;
use App\Repositories\InfoPendaftaranRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class InfoPendaftaranService
{
    public function __construct(private InfoPendaftaranRepository $repository) {}

    public function getAll(): LengthAwarePaginator
    {
        return $this->repository->getAll();
    }

    public function findById(int $id): InfoPendaftaran
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): InfoPendaftaran
    {
        $info = $this->repository->create($data);
        $this->clearCache();
        return $info;
    }

    public function update(int $id, array $data): InfoPendaftaran
    {
        $info = $this->repository->update($id, $data);
        $this->clearCache();
        return $info;
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
        $this->clearCache();
    }

    // ── API (Fase 4 + 5) ─────────────────────────────────────────────────
    public function getAktifForApi(): ?InfoPendaftaran
    {
        return Cache::remember('info_pendaftaran:aktif', 1800, function () {
            return $this->repository->getAktif();
        });
    }

    public function clearCache(): void
    {
        Cache::forget('info_pendaftaran:aktif');
    }
}
