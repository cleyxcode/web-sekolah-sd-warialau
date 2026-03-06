<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GaleriResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'judul'      => $this->judul,
            'foto'       => Storage::url($this->foto),
            'keterangan' => $this->keterangan,
        ];
    }
}
