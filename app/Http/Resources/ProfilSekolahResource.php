<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'nama_sekolah' => $this->nama_sekolah,
            'visi'         => $this->visi,
            'misi'         => $this->misi,
            'sejarah'      => $this->sejarah,
            'alamat'       => $this->alamat,
            'kontak'       => $this->kontak,
            'logo'         => $this->logo ? Storage::url($this->logo) : null,
        ];
    }
}
