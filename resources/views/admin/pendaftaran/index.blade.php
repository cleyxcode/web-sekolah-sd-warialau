@extends('admin.layouts.app')
@section('title', 'Data Pendaftaran')
@section('page-title', 'Data Pendaftaran')

@section('content')
<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
        <form method="GET" action="{{ route('admin.pendaftaran.index') }}" class="flex flex-wrap gap-2 flex-1">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama anak, orang tua..."
                    class="pl-9 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm w-56 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
            </div>
            <select name="status" class="px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak"  {{ request('status') == 'ditolak'  ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-medium transition">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if ($pendaftaran->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-sm">Belum ada formulir pendaftaran masuk.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Anak</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Orang Tua</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Tahun Ajaran</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Tgl. Daftar</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($pendaftaran as $item)
                        @php
                            $statusColor = match($item->status) {
                                'diterima' => 'bg-green-100 text-green-700',
                                'ditolak'  => 'bg-red-100 text-red-700',
                                default    => 'bg-amber-100 text-amber-700',
                            };
                            $dotColor = match($item->status) {
                                'diterima' => 'bg-green-500',
                                'ditolak'  => 'bg-red-500',
                                default    => 'bg-amber-500',
                            };
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">{{ $item->nama_anak }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <p class="text-gray-700">{{ $item->nama_ortu }}</p>
                                <p class="text-xs text-gray-400">{{ $item->no_hp }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-600 hidden md:table-cell">
                                {{ $item->infoPendaftaran->tahun_ajaran }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs hidden lg:table-cell">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.pendaftaran.show', $item->id) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-medium transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($pendaftaran->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">{{ $pendaftaran->links() }}</div>
            @endif
        @endif
    </div>
</div>
@endsection
