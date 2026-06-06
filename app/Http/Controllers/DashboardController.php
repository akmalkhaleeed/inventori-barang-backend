<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {
    // 1. Hitung Total Unit Barang (Sum jumlah semua stok)
    $totalBarang = DB::table('barang')->sum('stok');

    // 2. Hitung Total Petugas (User yang rolenya petugas)
    $totalPetugas = DB::table('users')->where('role', 'petugas')->count();

    // 3. Hitung Total Log Transaksi yang pernah terjadi
    $totalTransaksi = DB::table('transaksi')->count();

    // 4. Ambil list barang yang stoknya kritis (di bawah 10) untuk alert di UI
    $stokKritis = DB::table('barang')
      ->where('stok', '<', 10)
      ->get(['nama_barang', 'stok']);

    // 5. Ambil aktivitas terbaru (Join tabel transaksi, users, dan barang biar dapat namanya)
    $aktivitasTerbaru = DB::table('transaksi')
      ->join('users', 'transaksi.id_user', '=', 'users.id_user')
      ->join('barang', 'transaksi.id_barang', '=', 'barang.id_barang')
      ->orderBy('transaksi.tanggal_transaksi', 'desc')
      ->limit(5)
      ->get([
        'users.nama_lengkap',
        'barang.nama_barang',
        'transaksi.jenis_transaksi',
        'transaksi.jumlah',
        'transaksi.tanggal_transaksi'
      ]);

    // 6. Kembalikan data dalam format JSON super rapi
    return response()->json([
      'status' => 'success',
      'data' => [
        'total_barang'      => (int) $totalBarang,
        'total_petugas'     => $totalPetugas,
        'total_transaksi'   => $totalTransaksi,
        'stok_kritis'       => $stokKritis,
        'aktivitas_terbaru' => $aktivitasTerbaru
      ]
    ]);
  }
}
