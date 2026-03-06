@extends('web.layouts.app')

@section('title', 'Info Pendaftaran - SD Negeri Warialau')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1E3A5F] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">Informasi Pendaftaran</h1>
        <p class="text-blue-200 mt-2 text-sm">Penerimaan Peserta Didik Baru SD Negeri Warialau</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if ($info)
    <div class="space-y-6">

        {{-- Status Banner --}}
        <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-green-800 text-sm">Pendaftaran Sedang Dibuka</p>
                <p class="text-sm text-green-600">Tahun Ajaran {{ $info->tahun_ajaran }}</p>
            </div>
        </div>

        {{-- Info Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="bg-[#1E3A5F] px-6 py-4">
                <h2 class="text-lg font-bold text-white">Detail Pendaftaran</h2>
                <p class="text-blue-200 text-sm mt-0.5">Tahun Ajaran {{ $info->tahun_ajaran }}</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-gray-500 mb-1">Tanggal Buka</p>
                        <p class="font-bold text-[#1E3A5F]">{{ $info->tanggal_buka->format('d M Y') }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-gray-500 mb-1">Tanggal Tutup</p>
                        <p class="font-bold text-[#1E3A5F]">{{ $info->tanggal_tutup->format('d M Y') }}</p>
                    </div>
                    <div class="bg-[#FFC107]/10 rounded-xl p-4 text-center">
                        <p class="text-xs text-[#1E3A5F] mb-1">Kuota Siswa</p>
                        <p class="font-bold text-[#1E3A5F] text-xl">{{ $info->kuota }}</p>
                    </div>
                </div>

                @if ($info->syarat)
                <div class="border-t border-gray-100 pt-5">
                    <h3 class="font-semibold text-gray-800 mb-3 text-sm">Syarat Pendaftaran</h3>
                    <div class="text-sm text-gray-600 leading-relaxed whitespace-pre-line bg-gray-50 rounded-xl p-4">{{ $info->syarat }}</div>
                </div>
                @endif

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('web.pendaftaran.form') }}"
                       class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-[#FFC107] hover:bg-[#e6ac00] text-[#1E3A5F] font-bold rounded-xl text-sm transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Isi Formulir Pendaftaran
                    </a>
                    @auth
                        @if(auth()->user()->role === 'orangtua')
                        <a href="{{ route('web.pendaftaran.status') }}"
                           class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-[#1E3A5F] hover:bg-[#162d4a] text-white font-semibold rounded-xl text-sm transition-colors">
                            Cek Status Pendaftaran
                        </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

    </div>
    @else
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-8 text-center">
            <svg class="w-12 h-12 mx-auto mb-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <h3 class="font-semibold text-amber-800 mb-2">Pendaftaran Belum Dibuka</h3>
            <p class="text-sm text-amber-600">Saat ini belum ada pendaftaran yang sedang berlangsung. Pantau terus halaman ini untuk informasi terbaru.</p>
        </div>
    @endif

</div>
@endsection
