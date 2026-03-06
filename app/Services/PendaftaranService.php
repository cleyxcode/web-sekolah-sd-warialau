<?php

namespace App\Services;

use App\Models\Pendaftaran;
use App\Repositories\PendaftaranRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PendaftaranService
{
    public function __construct(private PendaftaranRepository $repository) {}

    public function getAll(string $search = '', string $status = ''): LengthAwarePaginator
    {
        return $this->repository->getAll($search, $status);
    }

    public function findById(int $id): Pendaftaran
    {
        return $this->repository->findById($id);
    }

    public function updateStatus(int $id, string $status): Pendaftaran
    {
        return $this->repository->updateStatus($id, $status);
    }
}
