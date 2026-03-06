<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InfoPendaftaranRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tahun_ajaran'   => ['required', 'string', 'max:20'],
            'tanggal_buka'   => ['required', 'date'],
            'tanggal_tutup'  => ['required', 'date', 'after_or_equal:tanggal_buka'],
            'kuota'          => ['required', 'integer', 'min:1'],
            'syarat'         => ['nullable', 'string'],
            'status'         => ['required', 'in:aktif,nonaktif'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun_ajaran.required'  => 'Tahun ajaran wajib diisi.',
            'tanggal_buka.required'  => 'Tanggal buka pendaftaran wajib diisi.',
            'tanggal_tutup.required' => 'Tanggal tutup pendaftaran wajib diisi.',
            'tanggal_tutup.after_or_equal' => 'Tanggal tutup harus setelah tanggal buka.',
            'kuota.required'         => 'Kuota wajib diisi.',
            'kuota.min'              => 'Kuota minimal 1.',
        ];
    }
}
