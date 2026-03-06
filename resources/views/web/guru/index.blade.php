@extends('web.layouts.app')

@section('title', 'Data Guru - SD Negeri Warialau')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1E3A5F] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">Tenaga Pengajar</h1>
        <p class="text-blue-200 mt-2 text-sm">Guru dan staf SD Negeri Warialau</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if ($guru->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-sm">Data guru belum tersedia.</p>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @foreach ($guru as $item)
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center hover:shadow-md transition-shadow">
                <div class="w-20 h-20 rounded-full mx-auto mb-3 overflow-hidden bg-gray-100">
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#1E3A5F] flex items-center justify-center">
                            <span class="text-white font-bold text-xl">{{ strtoupper(substr($item->nama, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                <h3 class="font-semibold text-gray-800 text-sm line-clamp-2">{{ $item->nama }}</h3>
                @if ($item->jabatan)
                    <p class="text-xs text-[#1E3A5F] font-medium mt-1">{{ $item->jabatan }}</p>
                @endif
                @if ($item->mata_pelajaran)
                    <p class="text-xs text-gray-400 mt-0.5">{{ $item->mata_pelajaran }}</p>
                @endif
            </div>
            @endforeach
        </div>

        @if ($guru->hasPages())
            <div class="mt-8">{{ $guru->links() }}</div>
        @endif
    @endif

</div>
@endsection
