<?php

namespace App\Services;

use App\Models\InfoPendaftaran;
use App\Repositories\InfoPendaftaranRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class InfoPendaftaranService
{
    public function __construct(private InfoPendaftaranRepository $repository) {}

    public function getAll(): LengthAwarePaginator
    {
        return $this->repository->getAll();
    }

    public function findById(int $id): InfoPendaftaran
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): InfoPendaftaran
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): InfoPendaftaran
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
