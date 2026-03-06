<?php

namespace App\Repositories;

use App\Models\Berita;
use Illuminate\Pagination\LengthAwarePaginator;

class BeritaRepository
{
    public function getAll(string $search = '', string $status = ''): LengthAwarePaginator
    {
        return Berita::with('user')
            ->when($search, fn($q) => $q->where('judul', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function findById(int $id): Berita
    {
        return Berita::findOrFail($id);
    }

    public function create(array $data): Berita
    {
        return Berita::create($data);
    }

    public function update(int $id, array $data): Berita
    {
        $berita = $this->findById($id);
        $berita->update($data);
        return $berita;
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getAllPublished()
    {
        return Berita::where('status', 'publish')
            ->latest('tanggal_publish')
            ->get();
    }

    public function findPublishedById(int $id): ?Berita
    {
        return Berita::where('status', 'publish')->find($id);
    }
}
