<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoPendaftaran extends Model
{
    protected $table = 'info_pendaftaran';

    protected $fillable = [
        'user_id',
        'tahun_ajaran',
        'tanggal_buka',
        'tanggal_tutup',
        'kuota',
        'syarat',
        'status',
    ];

    protected $casts = [
        'tanggal_buka' => 'date',
        'tanggal_tutup' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
