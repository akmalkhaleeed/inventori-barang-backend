<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Bersihkan data lama dengan urutan yang benar (biar gak error Foreign Key)
        DB::table('transaksi')->delete();
        DB::table('barang')->delete();
        DB::table('supplier')->delete();
        DB::table('kategori')->delete();
        DB::table('users')->delete();

        // 2. Masukkan Data Users (Primary Key: id_user)
        DB::table('users')->insert([
            [
                'id_user'      => 1,
                'nama_lengkap' => 'Ahmad Kamaludin (Admin)',
                'username'     => 'admin',
                'email'        => 'admin@gmail.com',
                'password'     => password_hash('admin123', PASSWORD_BCRYPT),
                'role'         => 'admin',
            ],
            [
                'id_user'      => 2,
                'nama_lengkap' => 'Ravindra Diaz',
                'username'     => 'diaz',
                'email'        => 'diaz@gmail.com',
                'password'     => password_hash('petugas123', PASSWORD_BCRYPT),
                'role'         => 'petugas',
            ],
            [
                'id_user'      => 3,
                'nama_lengkap' => 'Akmal Khaleed',
                'username'     => 'akmal',
                'email'        => 'akmal@gmail.com',
                'password'     => password_hash('petugas123', PASSWORD_BCRYPT),
                'role'         => 'petugas',
            ],
            [
                'id_user'      => 4,
                'nama_lengkap' => 'Bapak Pimpinan',
                'username'     => 'pimpinan',
                'email'        => 'pimpinan@gmail.com',
                'password'     => password_hash('pimpinan123', PASSWORD_BCRYPT),
                'role'         => 'pimpinan',
            ]
        ]);

        // 3. Masukkan Data Kategori (Primary Key: id_kategori)
        DB::table('kategori')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Alat Tulis Kantor (ATK)'],
            ['id_kategori' => 2, 'nama_kategori' => 'Elektronik'],
            ['id_kategori' => 3, 'nama_kategori' => 'Furnitur Kantor'],
        ]);

        // 4. Masukkan Data Supplier (Primary Key: id_supplier, Kolom: telepon)
        DB::table('supplier')->insert([
            ['id_supplier' => 1, 'nama_supplier' => 'PT. Gramedia Maju', 'telepon' => '08123456789', 'alamat' => 'Jakarta'],
            ['id_supplier' => 2, 'nama_supplier' => 'CV. Asus Indonesia', 'telepon' => '08987654321', 'alamat' => 'Bandung'],
            ['id_supplier' => 3, 'nama_supplier' => 'U制造 Jati Furniture', 'telepon' => '08554433221', 'alamat' => 'Jepara'],
        ]);

        // 5. Masukkan Data Barang (Primary Key: id_barang, Kolom: harga)
        DB::table('barang')->insert([
            [
                'id_barang'   => 1,
                'id_kategori' => 1,
                'id_supplier' => 1,
                'nama_barang' => 'Kertas A4 80gr',
                'stok'        => 3, // Kondisi Stok Kritis untuk UI Diaz
                'harga'       => 55000,
            ],
            [
                'id_barang'   => 2,
                'id_kategori' => 1,
                'id_supplier' => 1,
                'nama_barang' => 'Tinta Printer Epson Black',
                'stok'        => 5, // Kondisi Stok Kritis untuk UI Diaz
                'harga'       => 85000,
            ],
            [
                'id_barang'   => 3,
                'id_kategori' => 3,
                'id_supplier' => 3,
                'nama_barang' => 'Kursi Kerja Ergonomis',
                'stok'        => 25,
                'harga'       => 1200000,
            ],
            [
                'id_barang'   => 4,
                'id_kategori' => 2,
                'id_supplier' => 2,
                'nama_barang' => 'Laptop ASUS Core i7',
                'stok'        => 12,
                'harga'       => 15000000,
            ],
        ]);

        // 6. Masukkan Data Log Transaksi (Primary Key: id_transaksi, Kolom: jenis_transaksi, tanggal_transaksi)
        DB::table('transaksi')->insert([
            [
                'id_transaksi'      => 1,
                'id_user'           => 2, // Diinput oleh Diaz (id_user = 2)
                'id_barang'         => 3, // Kursi Kerja Ergonomis
                'jenis_transaksi'   => 'masuk', // Menggunakan huruf kecil sesuai enum migration
                'jumlah'            => 10,
                'tanggal_transaksi' => '2026-06-06 06:54:00',
            ],
            [
                'id_transaksi'      => 2,
                'id_user'           => 3, // Diinput oleh Akmal (id_user = 3)
                'id_barang'         => 4, // Laptop ASUS Core i7
                'jenis_transaksi'   => 'keluar', // Menggunakan huruf kecil sesuai enum migration
                'jumlah'            => 1,
                'tanggal_transaksi' => '2026-06-06 05:54:00',
            ],
        ]);
    }
}
