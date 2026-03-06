@extends('admin.layouts.app')
@section('title', 'Edit Galeri')
@section('page-title', 'Edit Galeri')

@section('content')
<div class="max-w-xl mx-auto">
    <form method="POST" action="{{ route('admin.galeri.update', $galeri->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-sm font-semibold text-gray-700">Edit Foto Galeri</h2>
            </div>

            <div class="p-6 space-y-5">
                <div x-data="fotoPreview()">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Foto</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden cursor-pointer hover:border-[#1e3a5f] transition"
                        @click="$refs.fileInput.click()">
                        <template x-if="preview">
                            <img :src="preview" class="w-full max-h-64 object-contain p-2">
                        </template>
                        <template x-if="!preview">
                            <img src="{{ Storage::url($galeri->foto) }}" class="w-full max-h-64 object-cover">
                        </template>
                    </div>
                    <input type="file" name="foto" x-ref="fileInput" class="hidden" accept="image/*" @change="onFile($event)">
                    <p class="text-xs text-gray-400 mt-1">Klik untuk ganti foto. Biarkan kosong jika tidak ingin mengubah.</p>
                    @error('foto') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Foto <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent @error('judul') border-red-400 bg-red-50 @enderror">
                    @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent resize-none">{{ old('keterangan', $galeri->keterangan) }}</textarea>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('admin.galeri.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium transition">← Kembali</a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1e3a5f] hover:bg-[#162d4a] text-white text-sm font-semibold rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
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
            reader.onload = ev => this.preview = ev.target.result;
            reader.readAsDataURL(file);
        }
    }
}
</script>
@endpush
