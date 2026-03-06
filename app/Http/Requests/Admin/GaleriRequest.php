<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GaleriRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $fotoRules = $this->isMethod('POST')
            ? ['required', 'image', 'max:3072']
            : ['nullable', 'image', 'max:3072'];

        return [
            'judul'      => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'foto'       => $fotoRules,
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul foto wajib diisi.',
            'foto.required'  => 'Foto wajib diupload.',
            'foto.image'     => 'File harus berupa gambar.',
            'foto.max'       => 'Ukuran foto maksimal 3MB.',
        ];
    }
}
