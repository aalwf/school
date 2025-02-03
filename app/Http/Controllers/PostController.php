<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Method untuk menampilkan halaman Postingan
     *
     * @return void
     */
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
        return view('posts.create');
    }

    // Method untuk menambahkan postingan ke database
    public function store(Request $request)
    {
        // validasi data yang dikirim dari form
        $this->validate($request, [
            // gambar harus diisi dan harus berformat jpeg, png, jpg, gif, svg dengan ukuran maksimum 2048 kb
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // judul harus diisi minimal 5 karakter
            'title' => 'required|min:5',
            // konten harus diisi minimal 10 karakter
            'content' => 'required|min:10'
        ]);
    }
}
