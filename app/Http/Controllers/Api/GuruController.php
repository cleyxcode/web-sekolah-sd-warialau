<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuruResource;
use App\Services\GuruService;

class GuruController extends Controller
{
    public function __construct(private GuruService $service) {}

    /**
     * C2 — GET /api/v1/guru
     */
    public function index()
    {
        $guru = $this->service->getAllForApi();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data'    => $guru,
        ]);
    }
}
