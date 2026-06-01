<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi'); // No Faktur [cite: 911]
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_user');
            $table->enum('jenis_transaksi', ['masuk', 'keluar']); // Identifikasi mutasi stok [cite: 1062]
            $table->integer('jumlah');
            $table->timestamp('tanggal_transaksi')->useCurrent(); // Waktu otomatis [cite: 931]
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
