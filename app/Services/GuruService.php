<?php

namespace App\Services;

use App\Models\Guru;
use App\Repositories\GuruRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
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
        return $this->repository->create($data);
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
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $guru = $this->repository->findById($id);
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }
        $this->repository->delete($id);
    }
}
