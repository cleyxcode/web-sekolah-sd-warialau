<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::where('status', 'publish')
            ->latest('tanggal_publish')
            ->paginate(9);

        return view('web.berita.index', compact('berita'));
    }

    public function show(Berita $berita)
    {
        abort_if($berita->status !== 'publish', 404);

        $related = Berita::where('status', 'publish')
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_publish')
            ->take(3)
            ->get();

        return view('web.berita.show', compact('berita', 'related'));
    }
}
