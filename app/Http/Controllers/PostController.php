<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // import class Storage laravel
use App\Models\Post; // import model Post

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
        $data = [
            'title' => 'Tambah Post'
        ];

        return view('pages.create', $data);
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

        // mengambil file gambar dari form yang dikirim
        $image = $request->file('image');

        // menggunakan method storeAs untuk menyimpan gambar ke folder posts
        $image->storeAs('public/posts', $image->hashName());

        // menambahkan data ke database
        Post::create([
            // memasukkan hashname dari gambar ke database
            'image' => $image->hashName(),
            // memasukkan judul
            'title' => $request->title,
            // memasukkan konten
            'content' => $request->content
        ]);

        // mengalihkan ke halaman posts dengan mengirimkan pesan sukses
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    // Method untuk menampilkan halaman edit postingan
    public function edit(Post $post)
    {
        // menyiapkan data untuk dikirim ke halaman
        $data = [
            // judul halaman
            'title' => 'Edit Post',
            // data postingan yang akan diedit
            'post' => $post
        ];

        // menampilkan halaman dan mengirimkan data
        return view('pages.edit', $data);
    }
}
