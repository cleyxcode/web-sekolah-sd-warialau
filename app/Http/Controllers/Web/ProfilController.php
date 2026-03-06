<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('web.profil.index', compact('profil'));
    }
}
