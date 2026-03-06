@extends('admin.layouts.app')
@section('title', 'Edit Siswa')
@section('page-title', 'Edit Siswa')

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('admin.siswa.update', $siswa->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-sm font-semibold text-gray-700">Edit Data Siswa</h2>
            </div>

            <div class="p-6 space-y-5">
                {{-- Foto --}}
                <div x-data="fotoPreview()" class="flex flex-col items-center gap-3">
                    <div class="w-24 h-24 rounded-full bg-green-100 overflow-hidden flex items-center justify-center border-2 border-dashed border-gray-300">
                        <template x-if="preview">
                            <img :src="preview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!preview">
                            @if ($siswa->foto)
                                <img src="{{ Storage::url($siswa->foto) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-green-600 font-bold text-2xl">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</span>
                            @endif
                        </template>
                    </div>
                    <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm rounded-xl transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Ganti Foto
                        <input type="file" name="foto" class="hidden" accept="image/*" @change="onFile($event)">
                    </label>
                    @error('foto') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent @error('nama') border-red-400 bg-red-50 @enderror">
                        @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                        <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select name="kelas"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach (['1A','1B','2A','2B','3A','3B','4A','4B','5A','5B','6A','6B'] as $k)
                                <option value="{{ $k }}" {{ old('kelas', $siswa->kelas) == $k ? 'selected' : '' }}>Kelas {{ $k }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', $siswa->tahun_ajaran) }}"
                            placeholder="cth. 2025/2026"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('admin.siswa.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium transition">← Kembali</a>
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

@push('scripts')
<script>
function fotoPreview() {
    return {
        preview: null,
        onFile(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (ev) => this.preview = ev.target.result;
            reader.readAsDataURL(file);
        }
    }
}
</script>
@endpush
