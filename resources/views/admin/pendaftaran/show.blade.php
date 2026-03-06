@extends('admin.layouts.app')
@section('title', 'Detail Pendaftaran')
@section('page-title', 'Detail Pendaftaran')

@section('content')
<div class="max-w-3xl mx-auto space-y-5">

    {{-- Header card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800">{{ $pendaftaran->nama_anak }}</h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    Didaftarkan pada {{ $pendaftaran->created_at->format('d M Y, H:i') }}
                </p>
            </div>
            @php
                $statusConfig = [
                    'pending'  => ['bg-amber-100 text-amber-700',  'Menunggu Verifikasi'],
                    'diterima' => ['bg-green-100 text-green-700',  'Diterima'],
                    'ditolak'  => ['bg-red-100 text-red-700',      'Ditolak'],
                ];
                [$statusClass, $statusLabel] = $statusConfig[$pendaftaran->status];
            @endphp
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold {{ $statusClass }}">
                {{ $statusLabel }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        {{-- Data Anak --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Data Anak</h3>
            <dl class="space-y-3">
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Nama Lengkap</dt>
                    <dd class="font-medium text-gray-800 text-right">{{ $pendaftaran->nama_anak }}</dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Tanggal Lahir</dt>
                    <dd class="font-medium text-gray-800">{{ $pendaftaran->tanggal_lahir->format('d M Y') }}</dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Jenis Kelamin</dt>
                    <dd class="font-medium text-gray-800">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Alamat</dt>
                    <dd class="font-medium text-gray-800 text-right max-w-xs">{{ $pendaftaran->alamat }}</dd>
                </div>
            </dl>
        </div>

        {{-- Data Orang Tua --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Data Orang Tua/Wali</h3>
            <dl class="space-y-3">
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Nama Orang Tua</dt>
                    <dd class="font-medium text-gray-800">{{ $pendaftaran->nama_ortu }}</dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">No. HP</dt>
                    <dd class="font-medium text-gray-800">{{ $pendaftaran->no_hp }}</dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Tahun Ajaran</dt>
                    <dd class="font-medium text-gray-800">{{ $pendaftaran->infoPendaftaran->tahun_ajaran }}</dd>
                </div>
                @if ($pendaftaran->dokumen)
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Dokumen</dt>
                    <dd>
                        <a href="{{ Storage::url($pendaftaran->dokumen) }}" target="_blank"
                            class="text-blue-600 hover:underline text-sm font-medium">Lihat Dokumen</a>
                    </dd>
                </div>
                @endif
            </dl>
        </div>
    </div>

    {{-- Update Status --}}
    @if ($pendaftaran->status === 'pending')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">Tindakan Verifikasi</h3>
        <div class="flex flex-col sm:flex-row gap-3">
            <form method="POST" action="{{ route('admin.pendaftaran.updateStatus', $pendaftaran->id) }}" class="flex-1">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="diterima">
                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Terima Pendaftaran
                </button>
            </form>
            <form method="POST" action="{{ route('admin.pendaftaran.updateStatus', $pendaftaran->id) }}"
                class="flex-1" x-data x-on:submit.prevent="if(confirm('Tolak pendaftaran ini?')) $el.submit()">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="ditolak">
                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Tolak Pendaftaran
                </button>
            </form>
        </div>
    </div>
    @endif

    <div>
        <a href="{{ route('admin.pendaftaran.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 font-medium transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Pendaftaran
        </a>
    </div>
</div>
@endsection
