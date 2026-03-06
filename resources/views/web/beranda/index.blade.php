@extends('web.layouts.app')

@section('title', 'Beranda - SD Negeri Warialau')

@section('content')

{{-- ===== HERO ===== --}}
<section class="relative bg-[#1E3A5F] overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-64 h-64 bg-[#FFC107] rounded-full -translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#FFC107] rounded-full translate-x-32 translate-y-32"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="max-w-3xl">
            <span class="inline-block px-3 py-1 bg-[#FFC107] text-[#1E3A5F] text-xs font-bold rounded-full mb-4 uppercase tracking-wider">
                Sekolah Dasar Negeri
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-4">
                SD Negeri <span class="text-[#FFC107]">Warialau</span>
            </h1>
            <p class="text-lg text-blue-200 mb-8 max-w-xl">
                Menjadi sekolah dasar yang unggul, berkarakter, dan berwawasan lingkungan di wilayah Warialau, Maluku.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('web.info-pendaftaran') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-[#FFC107] hover:bg-[#e6ac00] text-[#1E3A5F] font-bold rounded-xl transition-colors duration-150 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Info Pendaftaran
                </a>
                <a href="{{ route('web.profil') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-colors duration-150 text-sm border border-white/20">
                    Profil Sekolah
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===== STATS ===== --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center">
            <p class="text-3xl font-extrabold text-[#1E3A5F]">{{ $totalGuru }}</p>
            <p class="text-sm text-gray-500 mt-1">Tenaga Pengajar</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center">
            <p class="text-3xl font-extrabold text-[#1E3A5F]">{{ $totalSiswa }}</p>
            <p class="text-sm text-gray-500 mt-1">Total Siswa</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center">
            <p class="text-3xl font-extrabold text-[#1E3A5F]">6</p>
            <p class="text-sm text-gray-500 mt-1">Kelas Aktif</p>
        </div>
        <div class="bg-[#FFC107] rounded-2xl p-5 shadow-sm text-center">
            <p class="text-3xl font-extrabold text-[#1E3A5F]">2026</p>
            <p class="text-sm text-[#1E3A5F] mt-1 font-medium">Tahun Ajaran</p>
        </div>
    </div>
</section>

{{-- ===== BANNER PENDAFTARAN ===== --}}
@if ($infoPendaftaran)
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="bg-gradient-to-r from-[#1E3A5F] to-[#2d5a8e] rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-[#FFC107] flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-[#1E3A5F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div class="text-white">
                <p class="font-bold text-base">Pendaftaran Siswa Baru Sedang Dibuka!</p>
                <p class="text-sm text-blue-200">Tahun Ajaran {{ $infoPendaftaran->tahun_ajaran }} &bull; Tutup: {{ $infoPendaftaran->tanggal_tutup->format('d M Y') }}</p>
            </div>
        </div>
        <a href="{{ route('web.pendaftaran.form') }}"
           class="shrink-0 px-5 py-2.5 bg-[#FFC107] hover:bg-[#e6ac00] text-[#1E3A5F] font-bold rounded-xl text-sm transition-colors">
            Daftar Sekarang
        </a>
    </div>
</section>
@endif

{{-- ===== BERITA TERBARU ===== --}}
@if ($beritaTerbaru->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#1E3A5F]">Berita & Pengumuman</h2>
            <p class="text-sm text-gray-500 mt-1">Informasi terkini dari sekolah</p>
        </div>
        <a href="{{ route('web.berita.index') }}" class="text-sm font-medium text-[#1E3A5F] hover:text-[#FFC107] transition-colors flex items-center gap-1">
            Lihat semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @foreach ($beritaTerbaru as $item)
        <a href="{{ route('web.berita.show', $item) }}"
           class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200 group">
            @if ($item->gambar)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
            @else
                <div class="aspect-video bg-gradient-to-br from-[#1E3A5F] to-[#2d5a8e] flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
            @endif
            <div class="p-5">
                <span class="text-xs font-semibold text-[#1E3A5F] bg-[#FFC107]/20 px-2 py-0.5 rounded-full">
                    {{ ucfirst($item->kategori ?? 'Umum') }}
                </span>
                <h3 class="font-bold text-gray-800 mt-2 line-clamp-2 group-hover:text-[#1E3A5F] transition-colors">
                    {{ $item->judul }}
                </h3>
                <p class="text-xs text-gray-400 mt-2">
                    {{ $item->tanggal_publish ? $item->tanggal_publish->format('d M Y') : $item->created_at->format('d M Y') }}
                </p>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

{{-- ===== GALERI ===== --}}
@if ($galeriTerbaru->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14 mb-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#1E3A5F]">Galeri Foto</h2>
            <p class="text-sm text-gray-500 mt-1">Dokumentasi kegiatan sekolah</p>
        </div>
        <a href="{{ route('web.galeri') }}" class="text-sm font-medium text-[#1E3A5F] hover:text-[#FFC107] transition-colors flex items-center gap-1">
            Lihat semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        @foreach ($galeriTerbaru as $item)
        <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 group relative">
            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            <div class="absolute inset-0 bg-[#1E3A5F]/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3">
                <p class="text-white text-xs font-medium line-clamp-2">{{ $item->judul }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

@endsection
