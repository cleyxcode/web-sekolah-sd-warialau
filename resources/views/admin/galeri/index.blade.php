@extends('admin.layouts.app')
@section('title', 'Galeri Foto')
@section('page-title', 'Galeri Foto')

@section('content')
<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <form method="GET" action="{{ route('admin.galeri.index') }}" class="flex gap-2">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul foto..."
                    class="pl-9 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm w-52 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
            </div>
            <button type="submit" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-medium transition">Cari</button>
        </form>
        <a href="{{ route('admin.galeri.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#1e3a5f] hover:bg-[#162d4a] text-white text-sm font-semibold rounded-xl transition shadow-sm shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Upload Foto
        </a>
    </div>

    @if ($galeri->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-16 text-gray-400">
            <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-sm">Belum ada foto di galeri.</p>
            <a href="{{ route('admin.galeri.create') }}" class="mt-2 text-sm text-[#1e3a5f] font-medium hover:underline">Upload sekarang</a>
        </div>
    @else
        {{-- Grid foto --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($galeri as $item)
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="relative aspect-square overflow-hidden bg-gray-100">
                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-200 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100">
                        <a href="{{ route('admin.galeri.edit', $item->id) }}"
                            class="p-2 bg-white rounded-lg text-amber-600 hover:bg-amber-50 transition shadow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $item->id) }}"
                            x-data x-on:submit.prevent="if(confirm('Hapus foto ini?')) $el.submit()">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-white rounded-lg text-red-600 hover:bg-red-50 transition shadow">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $item->judul }}</p>
                    @if ($item->keterangan)
                        <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $item->keterangan }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        @if ($galeri->hasPages())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4">
                {{ $galeri->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
