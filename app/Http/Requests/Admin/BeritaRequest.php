<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'judul'           => ['required', 'string', 'max:255'],
            'isi'             => ['required', 'string'],
            'kategori'        => ['nullable', 'string', 'max:100'],
            'tanggal_publish' => ['nullable', 'date'],
            'status'          => ['required', 'in:draft,publish'],
            'gambar'          => ['nullable', 'image', 'max:3072'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul berita wajib diisi.',
            'isi.required'   => 'Isi berita wajib diisi.',
            'gambar.image'   => 'File harus berupa gambar.',
            'gambar.max'     => 'Ukuran gambar maksimal 3MB.',
        ];
    }
}
