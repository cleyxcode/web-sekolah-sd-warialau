<?php

namespace App\Services;

use App\Http\Resources\GuruResource;
use App\Models\Guru;
use App\Repositories\GuruRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class GuruService
{
    public function __construct(private GuruRepository $repository) {}

    public function getAll(string $search = ''): LengthAwarePaginator
    {
        return $this->repository->getAll($search);
    }

    public function findById(int $id): Guru
    {
        return $this->repository->findById($id);
    }

    public function create(array $data, ?UploadedFile $foto = null): Guru
    {
        if ($foto) {
            $data['foto'] = $foto->store('guru', 'public');
        }
        $guru = $this->repository->create($data);
        $this->clearCache();
        return $guru;
    }

    public function update(int $id, array $data, ?UploadedFile $foto = null): Guru
    {
        if ($foto) {
            $guru = $this->repository->findById($id);
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $foto->store('guru', 'public');
        }
        $guru = $this->repository->update($id, $data);
        $this->clearCache();
        return $guru;
    }

    public function delete(int $id): void
    {
        $guru = $this->repository->findById($id);
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }
        $this->repository->delete($id);
        $this->clearCache();
    }

    // ── API (Fase 4 + 5) ─────────────────────────────────────────────────
    public function getAllForApi(): array
    {
        return Cache::remember('guru:all', 3600, function () {
            return GuruResource::collection($this->repository->getAllActive())->resolve();
        });
    }

    public function clearCache(): void
    {
        Cache::forget('guru:all');
    }
}
