<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(12);
        return view('web.galeri.index', compact('galeri'));
    }
}
