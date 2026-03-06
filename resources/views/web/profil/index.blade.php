@extends('web.layouts.app')

@section('title', 'Profil Sekolah - SD Negeri Warialau')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1E3A5F] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">Profil Sekolah</h1>
        <p class="text-blue-200 mt-2 text-sm">Mengenal lebih dalam SD Negeri Warialau</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if ($profil)
    <div class="space-y-8">

        {{-- Logo + Nama --}}
        <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-6">
            <div class="shrink-0">
                @if ($profil->logo)
                    <img src="{{ Storage::url($profil->logo) }}" alt="Logo Sekolah"
                         class="w-28 h-28 object-contain rounded-xl border border-gray-100">
                @else
                    <div class="w-28 h-28 rounded-xl bg-[#1E3A5F] flex items-center justify-center">
                        <span class="text-white font-bold text-3xl">SD</span>
                    </div>
                @endif
            </div>
            <div>
                <h2 class="text-2xl font-bold text-[#1E3A5F]">{{ $profil->nama_sekolah }}</h2>
                <p class="text-gray-500 mt-1 flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    {{ $profil->alamat }}
                </p>
                @if ($profil->kontak && $profil->kontak !== '-')
                <p class="text-gray-500 mt-1 flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ $profil->kontak }}
                </p>
                @endif
            </div>
        </div>

        {{-- Visi --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
            <h3 class="text-sm font-bold text-[#FFC107] uppercase tracking-wider mb-3">Visi</h3>
            <p class="text-gray-700 leading-relaxed">{{ $profil->visi }}</p>
        </div>

        {{-- Misi --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
            <h3 class="text-sm font-bold text-[#FFC107] uppercase tracking-wider mb-3">Misi</h3>
            <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $profil->misi }}</div>
        </div>

        {{-- Sejarah --}}
        @if ($profil->sejarah)
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
            <h3 class="text-sm font-bold text-[#FFC107] uppercase tracking-wider mb-3">Sejarah Singkat</h3>
            <p class="text-gray-700 leading-relaxed">{{ $profil->sejarah }}</p>
        </div>
        @endif

    </div>
    @else
        <div class="text-center py-16 text-gray-400">
            <p>Informasi profil sekolah belum tersedia.</p>
        </div>
    @endif

</div>
@endsection
