<?php

namespace App\Services;

use App\Models\Berita;
use App\Repositories\BeritaRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
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
        return $this->repository->create($data);
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
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $berita = $this->repository->findById($id);
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $this->repository->delete($id);
    }
}
