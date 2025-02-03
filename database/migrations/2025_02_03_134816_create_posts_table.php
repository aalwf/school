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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap postingan
            $table->string('image'); // Kolom untuk menyimpan URL gambar
            $table->string('title'); // Kolom untuk menyimpan judul
            $table->text('content'); // Kolom untuk menyimpan konten
            $table->timestamps(); // Kolom untuk menyimpan waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
