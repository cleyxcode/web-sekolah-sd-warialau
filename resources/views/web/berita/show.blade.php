@extends('web.layouts.app')

@section('title', $berita->judul . ' - SD Negeri Warialau')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="mb-6">
        <a href="{{ route('web.berita.index') }}"
           class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-[#1E3A5F] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Berita
        </a>
    </div>

    <article class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        @if ($berita->gambar)
            <div class="aspect-video w-full overflow-hidden">
                <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->judul }}"
                     class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="text-xs font-semibold text-[#1E3A5F] bg-[#FFC107]/20 px-2.5 py-1 rounded-full">
                    {{ ucfirst($berita->kategori ?? 'Umum') }}
                </span>
                <span class="text-xs text-gray-400">
                    {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d F Y') : $berita->created_at->format('d F Y') }}
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-[#1E3A5F] leading-tight mb-6">
                {{ $berita->judul }}
            </h1>

            <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $berita->isi }}
            </div>
        </div>
    </article>

    {{-- Berita terkait --}}
    @if ($related->isNotEmpty())
    <div class="mt-10">
        <h2 class="text-lg font-bold text-[#1E3A5F] mb-5">Berita Lainnya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach ($related as $item)
            <a href="{{ route('web.berita.show', $item) }}"
               class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                @if ($item->gambar)
                    <div class="h-32 overflow-hidden">
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                @else
                    <div class="h-32 bg-gradient-to-br from-[#1E3A5F] to-[#2d5a8e]"></div>
                @endif
                <div class="p-4">
                    <p class="text-xs font-semibold text-gray-800 line-clamp-2 group-hover:text-[#1E3A5F] transition-colors">
                        {{ $item->judul }}
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        {{ $item->tanggal_publish ? $item->tanggal_publish->format('d M Y') : $item->created_at->format('d M Y') }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
