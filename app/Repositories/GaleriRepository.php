<?php

namespace App\Repositories;

use App\Models\Galeri;
use Illuminate\Pagination\LengthAwarePaginator;

class GaleriRepository
{
    public function getAll(string $search = ''): LengthAwarePaginator
    {
        return Galeri::with('user')
            ->when($search, fn($q) => $q->where('judul', 'like', "%{$search}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();
    }

    public function findById(int $id): Galeri
    {
        return Galeri::findOrFail($id);
    }

    public function create(array $data): Galeri
    {
        return Galeri::create($data);
    }

    public function update(int $id, array $data): Galeri
    {
        $galeri = $this->findById($id);
        $galeri->update($data);
        return $galeri;
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }
}
