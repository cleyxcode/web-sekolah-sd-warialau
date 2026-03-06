<?php

namespace App\Services;

use App\Http\Resources\BeritaResource;
use App\Models\Berita;
use App\Repositories\BeritaRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class BeritaService
{
    public function __construct(private BeritaRepository $repository) {}

    public function getAll(string $search = '', string $status = ''): LengthAwarePaginator
    {
        return $this->repository->getAll($search, $status);
    }

    public function findById(int $id): Berita
    {
        return $this->repository->findById($id);
    }

    public function create(array $data, ?UploadedFile $gambar = null): Berita
    {
        if ($gambar) {
            $data['gambar'] = $gambar->store('berita', 'public');
        }
        $berita = $this->repository->create($data);
        $this->clearCache();
        return $berita;
    }

    public function update(int $id, array $data, ?UploadedFile $gambar = null): Berita
    {
        if ($gambar) {
            $berita = $this->repository->findById($id);
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $gambar->store('berita', 'public');
        }
        $berita = $this->repository->update($id, $data);
        $this->clearCache($id);
        return $berita;
    }

    public function delete(int $id): void
    {
        $berita = $this->repository->findById($id);
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $this->repository->delete($id);
        $this->clearCache($id);
    }

    // ── API (Fase 4 + 5) ─────────────────────────────────────────────────
    public function getAllForApi(): array
    {
        return Cache::remember('berita:all', 1800, function () {
            return BeritaResource::collection($this->repository->getAllPublished())->resolve();
        });
    }

    public function getByIdForApi(int $id): array|null
    {
        return Cache::remember("berita:{$id}", 3600, function () use ($id) {
            $berita = $this->repository->findPublishedById($id);
            return $berita ? (new BeritaResource($berita))->resolve() : null;
        });
    }

    public function clearCache(?int $id = null): void
    {
        Cache::forget('berita:all');
        if ($id) {
            Cache::forget("berita:{$id}");
        }
    }
}
