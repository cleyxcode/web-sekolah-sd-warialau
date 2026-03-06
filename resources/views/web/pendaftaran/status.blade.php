@extends('web.layouts.app')

@section('title', 'Status Pendaftaran - SD Negeri Warialau')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E3A5F]">Status Pendaftaran</h1>
        <p class="text-sm text-gray-500 mt-1">Riwayat pendaftaran atas nama {{ auth()->user()->name }}</p>
    </div>

    @if ($pendaftaran->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10 text-center">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-gray-400 text-sm mb-4">Anda belum mengajukan pendaftaran.</p>
            <a href="{{ route('web.pendaftaran.form') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#FFC107] text-[#1E3A5F] font-bold rounded-xl text-sm hover:bg-[#e6ac00] transition-colors">
                Isi Formulir Pendaftaran
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($pendaftaran as $item)
            @php
                $statusConfig = [
                    'pending'  => ['bg-amber-100 text-amber-700',  'Menunggu Verifikasi'],
                    'diterima' => ['bg-green-100 text-green-700',  'Diterima'],
                    'ditolak'  => ['bg-red-100 text-red-700',      'Ditolak'],
                ];
                [$statusClass, $statusLabel] = $statusConfig[$item->status];
            @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $item->nama_anak }}</h3>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Tahun Ajaran {{ $item->infoPendaftaran->tahun_ajaran }} &bull;
                            Didaftarkan {{ $item->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>
                <div class="px-6 py-4 grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-400">Tanggal Lahir</p>
                        <p class="font-medium text-gray-700 mt-0.5">{{ $item->tanggal_lahir->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Jenis Kelamin</p>
                        <p class="font-medium text-gray-700 mt-0.5">{{ $item->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Nama Orang Tua</p>
                        <p class="font-medium text-gray-700 mt-0.5">{{ $item->nama_ortu }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">No. HP</p>
                        <p class="font-medium text-gray-700 mt-0.5">{{ $item->no_hp }}</p>
                    </div>
                </div>

                @if ($item->status === 'diterima')
                <div class="px-6 py-3 bg-green-50 border-t border-green-100">
                    <p class="text-xs text-green-700 font-medium">
                        Selamat! Anak Anda telah diterima. Silakan datang ke sekolah untuk proses selanjutnya.
                    </p>
                </div>
                @elseif ($item->status === 'ditolak')
                <div class="px-6 py-3 bg-red-50 border-t border-red-100">
                    <p class="text-xs text-red-600">Mohon maaf, pendaftaran tidak dapat diproses. Silakan hubungi pihak sekolah untuk informasi lebih lanjut.</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
