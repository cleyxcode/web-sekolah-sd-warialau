@extends('web.layouts.app')

@section('title', 'Berita & Pengumuman - SD Negeri Warialau')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1E3A5F] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">Berita & Pengumuman</h1>
        <p class="text-blue-200 mt-2 text-sm">Informasi terkini dari SD Negeri Warialau</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if ($berita->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <p class="text-sm">Belum ada berita yang dipublikasikan.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($berita as $item)
            <a href="{{ route('web.berita.show', $item) }}"
               class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200 group">
                @if ($item->gambar)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                @else
                    <div class="aspect-video bg-gradient-to-br from-[#1E3A5F] to-[#2d5a8e] flex items-center justify-center">
                        <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                @endif
                <div class="p-5">
                    <span class="text-xs font-semibold text-[#1E3A5F] bg-[#FFC107]/20 px-2 py-0.5 rounded-full">
                        {{ ucfirst($item->kategori ?? 'Umum') }}
                    </span>
                    <h3 class="font-bold text-gray-800 mt-2 line-clamp-2 group-hover:text-[#1E3A5F] transition-colors text-sm">
                        {{ $item->judul }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">
                        {{ $item->tanggal_publish ? $item->tanggal_publish->format('d M Y') : $item->created_at->format('d M Y') }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        @if ($berita->hasPages())
            <div class="mt-8">{{ $berita->links() }}</div>
        @endif
    @endif

</div>
@endsection
