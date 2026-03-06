<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GuruResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'nama'           => $this->nama,
            'nip'            => $this->nip,
            'jabatan'        => $this->jabatan,
            'mata_pelajaran' => $this->mata_pelajaran,
            'foto'           => $this->foto ? Storage::url($this->foto) : null,
        ];
    }
}
