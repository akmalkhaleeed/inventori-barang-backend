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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->unsignedBigInteger('id_kategori'); // Harus sama tipe datanya dengan primary key target
            $table->unsignedBigInteger('id_supplier'); // Harus sama tipe datanya dengan primary key target
            $table->string('nama_barang');
            $table->integer('stok')->default(0);
            $table->integer('harga');
            $table->timestamps();

            // Deklarasi Relasi yang benar:
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->foreign('id_supplier')->references('id_supplier')->on('supplier')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
