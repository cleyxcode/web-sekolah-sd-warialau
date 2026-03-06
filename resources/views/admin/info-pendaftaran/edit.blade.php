@extends('admin.layouts.app')
@section('title', 'Edit Info Pendaftaran')
@section('page-title', 'Edit Info Pendaftaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('admin.info-pendaftaran.update', $info->id) }}">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-sm font-semibold text-gray-700">Edit Info Pendaftaran</h2>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran <span class="text-red-500">*</span></label>
                        <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', $info->tahun_ajaran) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent @error('tahun_ajaran') border-red-400 @enderror">
                        @error('tahun_ajaran') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Buka <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka', $info->tanggal_buka->format('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                        @error('tanggal_buka') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Tutup <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup', $info->tanggal_tutup->format('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                        @error('tanggal_tutup') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kuota Siswa <span class="text-red-500">*</span></label>
                        <input type="number" name="kuota" value="{{ old('kuota', $info->kuota) }}" min="1"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                        @error('kuota') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                            <option value="nonaktif" {{ old('status', $info->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="aktif"    {{ old('status', $info->status) == 'aktif'    ? 'selected' : '' }}>Aktif</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Syarat Pendaftaran</label>
                        <textarea name="syarat" rows="5"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent resize-none">{{ old('syarat', $info->syarat) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('admin.info-pendaftaran.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium transition">← Kembali</a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1e3a5f] hover:bg-[#162d4a] text-white text-sm font-semibold rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
