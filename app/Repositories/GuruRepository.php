<?php

namespace App\Repositories;

use App\Models\Guru;
use Illuminate\Pagination\LengthAwarePaginator;

class GuruRepository
{
    public function getAll(string $search = ''): LengthAwarePaginator
    {
        return Guru::when($search, fn($q) => $q->where('nama', 'like', "%{$search}%")
                ->orWhere('nip', 'like', "%{$search}%")
                ->orWhere('jabatan', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function findById(int $id): Guru
    {
        return Guru::findOrFail($id);
    }

    public function create(array $data): Guru
    {
        return Guru::create($data);
    }

    public function update(int $id, array $data): Guru
    {
        $guru = $this->findById($id);
        $guru->update($data);
        return $guru;
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }
}
