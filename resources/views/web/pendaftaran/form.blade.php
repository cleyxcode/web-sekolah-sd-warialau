@extends('web.layouts.app')

@section('title', 'Formulir Pendaftaran - SD Negeri Warialau')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E3A5F]">Formulir Pendaftaran Siswa Baru</h1>
        @if ($info)
            <p class="text-sm text-gray-500 mt-1">
                Tahun Ajaran {{ $info->tahun_ajaran }} &bull;
                Tutup: {{ $info->tanggal_tutup->format('d M Y') }}
            </p>
        @endif
    </div>

    @if ($sudahDaftar)
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 text-center">
        <svg class="w-12 h-12 mx-auto mb-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
        </svg>
        <h3 class="font-semibold text-amber-800 mb-2">Anda Sudah Mendaftar</h3>
        <p class="text-sm text-amber-600 mb-4">Anda sudah mengajukan pendaftaran untuk tahun ajaran ini.</p>
        <a href="{{ route('web.pendaftaran.status') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1E3A5F] text-white font-semibold rounded-xl text-sm hover:bg-[#162d4a] transition-colors">
            Lihat Status Pendaftaran
        </a>
    </div>
    @else
    <form method="POST" action="{{ route('web.pendaftaran.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="space-y-5">

            {{-- Data Anak --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700">Data Anak</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Anak <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_anak" value="{{ old('nama_anak') }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] @error('nama_anak') border-red-400 @enderror">
                        @error('nama_anak') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] @error('tanggal_lahir') border-red-400 @enderror">
                        @error('tanggal_lahir') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] @error('jenis_kelamin') border-red-400 @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" required
                                  class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] resize-none @error('alamat') border-red-400 @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Data Orang Tua --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700">Data Orang Tua/Wali</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua/Wali <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_ortu" value="{{ old('nama_ortu', auth()->user()->name) }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] @error('nama_ortu') border-red-400 @enderror">
                        @error('nama_ortu') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] @error('no_hp') border-red-400 @enderror">
                        @error('no_hp') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Dokumen --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" x-data="{ name: '' }">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700">Dokumen (Opsional)</h2>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Upload Dokumen
                        <span class="text-gray-400 font-normal">(PDF/JPG/PNG, max 2MB)</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-[#1E3A5F] transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        <span class="text-sm text-gray-500" x-text="name || 'Klik untuk upload dokumen'"></span>
                        <input type="file" name="dokumen" class="hidden" accept=".pdf,.jpg,.jpeg,.png"
                               @change="name = $event.target.files[0]?.name">
                    </label>
                    @error('dokumen') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#FFC107] hover:bg-[#e6ac00] text-[#1E3A5F] font-bold rounded-xl text-sm transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Kirim Pendaftaran
            </button>
        </div>
    </form>
    @endif

</div>
@endsection
