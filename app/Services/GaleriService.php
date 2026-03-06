<?php

namespace App\Services;

use App\Http\Resources\GaleriResource;
use App\Models\Galeri;
use App\Repositories\GaleriRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class GaleriService
{
    public function __construct(private GaleriRepository $repository) {}

    public function getAll(string $search = ''): LengthAwarePaginator
    {
        return $this->repository->getAll($search);
    }

    public function findById(int $id): Galeri
    {
        return $this->repository->findById($id);
    }

    public function create(array $data, UploadedFile $foto): Galeri
    {
        $data['foto'] = $foto->store('galeri', 'public');
        $galeri = $this->repository->create($data);
        $this->clearCache();
        return $galeri;
    }

    public function update(int $id, array $data, ?UploadedFile $foto = null): Galeri
    {
        if ($foto) {
            $galeri = $this->repository->findById($id);
            Storage::disk('public')->delete($galeri->foto);
            $data['foto'] = $foto->store('galeri', 'public');
        }
        $galeri = $this->repository->update($id, $data);
        $this->clearCache();
        return $galeri;
    }

    public function delete(int $id): void
    {
        $galeri = $this->repository->findById($id);
        Storage::disk('public')->delete($galeri->foto);
        $this->repository->delete($id);
        $this->clearCache();
    }

    // ── API (Fase 4 + 5) ─────────────────────────────────────────────────
    public function getAllForApi(): array
    {
        return Cache::remember('galeri:all', 3600, function () {
            return GaleriResource::collection($this->repository->getAllActive())->resolve();
        });
    }

    public function clearCache(): void
    {
        Cache::forget('galeri:all');
    }
}
