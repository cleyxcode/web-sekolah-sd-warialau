@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        {{-- Total Guru --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_guru'] }}</p>
                <p class="text-sm text-gray-500">Total Guru</p>
            </div>
        </div>

        {{-- Total Siswa --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_siswa'] }}</p>
                <p class="text-sm text-gray-500">Total Siswa</p>
            </div>
        </div>

        {{-- Pendaftaran Masuk --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_pendaftaran'] }}</p>
                <p class="text-sm text-gray-500">Pendaftaran Masuk</p>
            </div>
        </div>

        {{-- Berita Tayang --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_berita'] }}</p>
                <p class="text-sm text-gray-500">Berita Tayang</p>
            </div>
        </div>
    </div>

    {{-- Quick Access --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-base font-semibold text-gray-800 mb-4">Akses Cepat</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
            @php
                $links = [
                    ['href' => route('admin.guru.create'),              'label' => 'Tambah Guru',        'color' => 'blue'],
                    ['href' => route('admin.siswa.create'),             'label' => 'Tambah Siswa',       'color' => 'green'],
                    ['href' => route('admin.berita.create'),            'label' => 'Buat Berita',        'color' => 'purple'],
                    ['href' => route('admin.galeri.create'),            'label' => 'Upload Galeri',      'color' => 'pink'],
                    ['href' => route('admin.info-pendaftaran.create'),  'label' => 'Info Pendaftaran',   'color' => 'orange'],
                    ['href' => route('admin.pendaftaran.index'),        'label' => 'Lihat Pendaftaran',  'color' => 'amber'],
                    ['href' => route('admin.profil-sekolah.edit'),      'label' => 'Profil Sekolah',     'color' => 'teal'],
                ];
                $colors = [
                    'blue'   => 'bg-blue-50 text-blue-700 hover:bg-blue-100 border-blue-200',
                    'green'  => 'bg-green-50 text-green-700 hover:bg-green-100 border-green-200',
                    'purple' => 'bg-purple-50 text-purple-700 hover:bg-purple-100 border-purple-200',
                    'pink'   => 'bg-pink-50 text-pink-700 hover:bg-pink-100 border-pink-200',
                    'orange' => 'bg-orange-50 text-orange-700 hover:bg-orange-100 border-orange-200',
                    'amber'  => 'bg-amber-50 text-amber-700 hover:bg-amber-100 border-amber-200',
                    'teal'   => 'bg-teal-50 text-teal-700 hover:bg-teal-100 border-teal-200',
                ];
            @endphp

            @foreach ($links as $link)
                <a href="{{ $link['href'] }}"
                   class="flex items-center justify-center text-center px-3 py-3 rounded-xl border text-sm font-medium transition-all duration-150 {{ $colors[$link['color']] }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>

@endsection
