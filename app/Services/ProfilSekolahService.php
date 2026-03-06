<?php

namespace App\Services;

use App\Models\ProfilSekolah;
use App\Repositories\ProfilSekolahRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahService
{
    public function __construct(private ProfilSekolahRepository $repository) {}

    public function get(): ProfilSekolah
    {
        return $this->repository->get();
    }

    public function update(array $data, ?UploadedFile $logo = null): ProfilSekolah
    {
        if ($logo) {
            $profil = $this->repository->get();
            if ($profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $logo->store('logo', 'public');
        }

        $data['updated_at'] = now();

        return $this->repository->update($data);
    }
}
