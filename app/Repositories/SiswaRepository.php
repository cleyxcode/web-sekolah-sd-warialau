<?php

namespace App\Repositories;

use App\Models\Siswa;
use Illuminate\Pagination\LengthAwarePaginator;

class SiswaRepository
{
    public function getAll(string $search = ''): LengthAwarePaginator
    {
        return Siswa::when($search, fn($q) => $q->where('nama', 'like', "%{$search}%")
                ->orWhere('nis', 'like', "%{$search}%")
                ->orWhere('kelas', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function findById(int $id): Siswa
    {
        return Siswa::findOrFail($id);
    }

    public function create(array $data): Siswa
    {
        return Siswa::create($data);
    }

    public function update(int $id, array $data): Siswa
    {
        $siswa = $this->findById($id);
        $siswa->update($data);
        return $siswa;
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }
}
