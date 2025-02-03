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
        // create products table
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap produk
            $table->string('image'); // URL gambar
            $table->string('title'); // Nama produk
            $table->text('description'); // Deskripsi produk
            $table->bigInteger('price'); // Harga produk
            $table->integer('stock')->default(0); // Stok
            $table->timestamps(); // Kolom untuk menyimpan waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
