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
        // membuat tabel posts
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // primary key untuk setiap postingan
            $table->string('image'); // field untuk menyimpan gambar
            $table->string('title'); // field untuk menyimpan judul dari postingan
            $table->text('content'); // field untuk menyimpan konten dari postingan
            $table->timestamps(); // field untuk menyimpan waktu pembuatan dan pembaruan postingan
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
