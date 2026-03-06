<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfilSekolahResource;
use App\Services\ProfilSekolahService;

class ProfilSekolahController extends Controller
{
    public function __construct(private ProfilSekolahService $service) {}

    /**
     * C1 — GET /api/v1/profil-sekolah
     */
    public function index()
    {
        $profil = $this->service->getForApi();

        if (! $profil) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data'    => new ProfilSekolahResource($profil),
        ]);
    }
}
