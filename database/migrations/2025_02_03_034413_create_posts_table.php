<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Membuat tabel "posts"
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts'); // Menghapus tabel "posts" pada sebuah rollback migrations
    }
};
