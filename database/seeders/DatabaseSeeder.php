<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@warialau.sch.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Orang Tua Contoh',
            'email'    => 'orangtua@warialau.sch.id',
            'password' => Hash::make('password'),
            'role'     => 'orangtua',
            'no_hp'    => '081234567890',
        ]);

        ProfilSekolah::create([
            'nama_sekolah' => 'SD Negeri Warialau',
            'visi'         => 'Menjadi sekolah dasar yang unggul, berkarakter, dan berwawasan lingkungan.',
            'misi'         => "1. Melaksanakan pembelajaran yang aktif, kreatif, efektif, dan menyenangkan.\n2. Membangun karakter peserta didik yang beriman dan bertaqwa.\n3. Menjalin kerjasama dengan orang tua dan masyarakat.",
            'sejarah'      => 'SD Negeri Warialau berdiri dan mulai beroperasi melayani pendidikan dasar di wilayah Warialau.',
            'alamat'       => 'Warialau, Maluku, Indonesia',
            'kontak'       => '-',
            'logo'         => null,
            'updated_at'   => now(),
        ]);
    }
}
