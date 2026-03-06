<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::latest()->paginate(12);
        return view('web.guru.index', compact('guru'));
    }
}
