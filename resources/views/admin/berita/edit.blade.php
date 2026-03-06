@extends('admin.layouts.app')
@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')

@section('content')
<form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent @error('judul') border-red-400 bg-red-50 @enderror">
                    @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita <span class="text-red-500">*</span></label>
                    <textarea name="isi" rows="14"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent resize-y">{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" x-data="gambarPreview()">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Gambar Utama</h3>
                <div class="border-2 border-dashed border-gray-300 rounded-xl overflow-hidden cursor-pointer hover:border-[#1e3a5f] transition"
                    @click="$refs.fileInput.click()">
                    <template x-if="preview">
                        <img :src="preview" class="w-full max-h-64 object-cover">
                    </template>
                    <template x-if="!preview">
                        @if ($berita->gambar)
                            <img src="{{ Storage::url($berita->gambar) }}" class="w-full max-h-64 object-cover">
                        @else
                            <div class="flex flex-col items-center justify-center py-10 text-gray-400">
                                <svg class="w-10 h-10 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                <p class="text-sm">Klik untuk ganti gambar</p>
                            </div>
                        @endif
                    </template>
                </div>
                <input type="file" name="gambar" x-ref="fileInput" class="hidden" accept="image/*" @change="onFile($event)">
                @error('gambar') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="space-y-5">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                <h3 class="text-sm font-semibold text-gray-700">Pengaturan Publikasi</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                        <option value="draft"   {{ old('status', $berita->status) == 'draft'   ? 'selected' : '' }}>Draft</option>
                        <option value="publish" {{ old('status', $berita->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $berita->kategori) }}"
                        placeholder="cth. Pengumuman, Kegiatan..."
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publish</label>
                    <input type="date" name="tanggal_publish"
                        value="{{ old('tanggal_publish', $berita->tanggal_publish?->format('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent">
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#1e3a5f] hover:bg-[#162d4a] text-white text-sm font-semibold rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.berita.index') }}"
                    class="w-full text-center px-5 py-2.5 border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium rounded-xl transition">
                    Batal
                </a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function gambarPreview() {
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
