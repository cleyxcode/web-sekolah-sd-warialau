<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GaleriResource;
use App\Services\GaleriService;

class GaleriController extends Controller
{
    public function __construct(private GaleriService $service) {}

    /**
     * C4 — GET /api/v1/galeri
     */
    public function index()
    {
        $galeri = $this->service->getAllForApi();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data'    => $galeri,
        ]);
    }
}
