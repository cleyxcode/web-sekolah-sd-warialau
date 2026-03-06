@extends('web.layouts.app')

@section('title', 'Galeri Foto - SD Negeri Warialau')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1E3A5F] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">Galeri Foto</h1>
        <p class="text-blue-200 mt-2 text-sm">Dokumentasi kegiatan dan prestasi sekolah</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if ($galeri->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-sm">Belum ada foto dalam galeri.</p>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach ($galeri as $item)
            <div x-data="{ open: false }" class="group relative aspect-square rounded-2xl overflow-hidden cursor-pointer bg-gray-100"
                 @click="open = true">
                <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute inset-0 bg-[#1E3A5F]/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center p-3 text-center">
                    <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                    </svg>
                    <p class="text-white text-xs font-medium line-clamp-2">{{ $item->judul }}</p>
                </div>

                {{-- Lightbox --}}
                <div x-show="open" x-cloak @click.self="open = false"
                     class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                    <div class="relative max-w-3xl w-full" @click.stop>
                        <button @click="open = false"
                                class="absolute -top-10 right-0 text-white hover:text-[#FFC107] transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                             class="w-full rounded-2xl max-h-[80vh] object-contain">
                        <div class="mt-3 text-center">
                            <p class="text-white font-medium">{{ $item->judul }}</p>
                            @if ($item->keterangan)
                                <p class="text-gray-300 text-sm mt-1">{{ $item->keterangan }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if ($galeri->hasPages())
            <div class="mt-8">{{ $galeri->links() }}</div>
        @endif
    @endif

</div>
@endsection
