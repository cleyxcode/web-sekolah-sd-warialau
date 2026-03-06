<?php

namespace App\Services;

use App\Models\Siswa;
use App\Repositories\SiswaRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class SiswaService
{
    public function __construct(private SiswaRepository $repository) {}

    public function getAll(string $search = ''): LengthAwarePaginator
    {
        return $this->repository->getAll($search);
    }

    public function findById(int $id): Siswa
    {
        return $this->repository->findById($id);
    }

    public function create(array $data, ?UploadedFile $foto = null): Siswa
    {
        if ($foto) {
            $data['foto'] = $foto->store('siswa', 'public');
        }
        return $this->repository->create($data);
    }

    public function update(int $id, array $data, ?UploadedFile $foto = null): Siswa
    {
        if ($foto) {
            $siswa = $this->repository->findById($id);
            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $data['foto'] = $foto->store('siswa', 'public');
        }
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $siswa = $this->repository->findById($id);
        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }
        $this->repository->delete($id);
    }
}
