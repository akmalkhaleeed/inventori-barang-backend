<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Hapus semua isi tabel users biar bersih dan tidak bentrok
        DB::table('users')->delete();

        // 2. Baru masukkan data baru yang fresh
        DB::table('users')->insert([
            [
                'nama_lengkap' => 'Ahmad Kamaludin (Admin)',
                'username'     => 'admin',
                'email'        => 'admin@gmail.com',
                'password'     => password_hash('admin123', PASSWORD_BCRYPT),
                'role'         => 'admin',
            ],
            [
                'nama_lengkap' => 'Ravindra Diaz (Petugas)',
                'username'     => 'petugas',
                'email'        => 'petugas@gmail.com',
                'password'     => password_hash('petugas123', PASSWORD_BCRYPT),
                'role'         => 'petugas',
            ],
            [
                'nama_lengkap' => 'Bapak Pimpinan',
                'username'     => 'pimpinan',
                'email'        => 'pimpinan@gmail.com',
                'password'     => password_hash('pimpinan123', PASSWORD_BCRYPT),
                'role'         => 'pimpinan',
            ]
        ]);
    }
}
