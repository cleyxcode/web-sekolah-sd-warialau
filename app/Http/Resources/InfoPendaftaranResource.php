<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoPendaftaranResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'tahun_ajaran'   => $this->tahun_ajaran,
            'tanggal_buka'   => $this->tanggal_buka?->toDateString(),
            'tanggal_tutup'  => $this->tanggal_tutup?->toDateString(),
            'kuota'          => $this->kuota,
            'syarat'         => $this->syarat,
            'status'         => $this->status,
        ];
    }
}
