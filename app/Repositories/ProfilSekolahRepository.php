<?php

namespace App\Repositories;

use App\Models\ProfilSekolah;

class ProfilSekolahRepository
{
    public function get(): ProfilSekolah
    {
        return ProfilSekolah::firstOrCreate(
            ['id' => 1],
            ['nama_sekolah' => 'SD Negeri Warialau']
        );
    }

    public function update(array $data): ProfilSekolah
    {
        $profil = $this->get();
        $profil->update($data);
        return $profil;
    }
}
