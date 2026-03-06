<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeritaResource;
use App\Services\BeritaService;

class BeritaController extends Controller
{
    public function __construct(private BeritaService $service) {}

    /**
     * C3 — GET /api/v1/berita
     */
    public function index()
    {
        $berita = $this->service->getAllForApi();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data'    => $berita,
        ]);
    }

    /**
     * C3 — GET /api/v1/berita/{id}
     */
    public function show(int $id)
    {
        $berita = $this->service->getByIdForApi($id);

        if (! $berita) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data'    => $berita,
        ]);
    }
}
