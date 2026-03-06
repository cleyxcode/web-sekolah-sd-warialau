<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'judul'            => $this->judul,
            'ringkasan'        => Str::limit(strip_tags($this->isi), 150),
            'isi'              => $this->isi,
            'gambar'           => $this->gambar ? Storage::url($this->gambar) : null,
            'kategori'         => $this->kategori,
            'tanggal_publish'  => $this->tanggal_publish?->toDateString(),
        ];
    }
}
