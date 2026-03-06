@extends('admin.layouts.app')
@section('title', 'Upload Galeri')
@section('page-title', 'Upload Galeri')

@section('content')
<div class="max-w-xl mx-auto">
    <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-sm font-semibold text-gray-700">Upload Foto Galeri</h2>
            </div>

            <div class="p-6 space-y-5">

                {{-- Upload area --}}
                <div x-data="fotoPreview()">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden cursor-pointer hover:border-[#1e3a5f] transition min-h-48 flex items-center justify-center"
                        @click="$refs.fileInput.click()">
                        <template x-if="preview">
                            <img :src="preview" class="w-full max-h-64 object-contain p-2">
                        </template>
                        <template x-if="!preview">
                            <div class="flex flex-col items-center justify-center py-10 text-gray-400 w-full">
                                <svg class="w-12 h-12 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm font-medium">Klik untuk pilih foto</p>
                                <p class="text-xs mt-1">JPG, PNG, maks. 3MB</p>
                            </div>
                        </template>
                    </div>
                    <input type="file" name="foto" x-ref="fileInput" class="hidden" accept="image/*" @change="onFile($event)">
                    @error('foto') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Foto <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent @error('judul') border-red-400 bg-red-50 @enderror">
                    @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="3" placeholder="Deskripsi singkat foto..."
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent resize-none">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('admin.galeri.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium transition">← Kembali</a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1e3a5f] hover:bg-[#162d4a] text-white text-sm font-semibold rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Upload
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
