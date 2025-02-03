<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Import view from Illuminate Laravel
use App\Models\Post; // Import model Post

class PostController extends Controller
{
    // Method untuk menampilkan postingan
    public function index()
    {
        // Membuat variabel data untuk dikirim ke halaman
        $data = [
            // Judul halaman untuk di tampilkan di layout
            'title' => 'Posts',
            // Mengambil semua data postingan dengan mengurutkan postingan terbaru & melimit 5 data per halaman
            'posts' => Post::latest()->paginate(5)
        ];

        // Menampilkan halaman postingan
        return view('pages.index', $data);
    }

    // Method untuk menampilkan halaman tambah postingan
    public function create()
    {
        // Membuat variabel data untuk dikirim ke halaman
        $data = [
            'title' => 'Tambah Post'
        ];

        // Menampilkan halaman tambah postingan
        return view('pages.create', $data);
    }
}
