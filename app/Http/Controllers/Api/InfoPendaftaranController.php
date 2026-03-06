<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfoPendaftaranResource;
use App\Services\InfoPendaftaranService;

class InfoPendaftaranController extends Controller
{
    public function __construct(private InfoPendaftaranService $service) {}

    /**
     * C5 — GET /api/v1/info-pendaftaran/aktif
     */
    public function aktif()
    {
        $info = $this->service->getAktifForApi();

        if (! $info) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pendaftaran yang sedang aktif',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data'    => new InfoPendaftaranResource($info),
        ]);
    }
}
