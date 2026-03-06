<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'info_pendaftaran_id',
        'user_id',
        'nama_anak',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nama_ortu',
        'no_hp',
        'dokumen',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function infoPendaftaran()
    {
        return $this->belongsTo(InfoPendaftaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
