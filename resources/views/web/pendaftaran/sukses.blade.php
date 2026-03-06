@extends('web.layouts.app')

@section('title', 'Pendaftaran Berhasil - SD Negeri Warialau')

@section('content')

<div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10">
        <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-[#1E3A5F] mb-3">Pendaftaran Berhasil!</h1>
        <p class="text-gray-500 text-sm mb-8">
            Formulir pendaftaran Anda telah berhasil dikirim. Pihak sekolah akan memproses pendaftaran Anda dan menghubungi Anda dalam waktu dekat.
        </p>
        <div class="flex flex-col gap-3">
            <a href="{{ route('web.pendaftaran.status') }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-[#1E3A5F] hover:bg-[#162d4a] text-white font-semibold rounded-xl text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Cek Status Pendaftaran
            </a>
            <a href="{{ route('web.beranda') }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl text-sm transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
