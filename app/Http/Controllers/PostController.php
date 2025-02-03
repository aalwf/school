<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // Import redirect from Illuminate Laravel
use Illuminate\View\View; // Import view from Illuminate Laravel
use Illuminate\Support\Facades\Storage; // Import storage from Illuminate Laravel
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

    // Method untuk menyimpan postingan baru ke database
    public function store(Request $request): RedirectResponse
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

    // Method untuk menampilkan detail postingan
    public function show(string $id): View
    {
        // Membuat variabel data untuk dikirim ke halaman
        $data = [
            'title' => 'Detail Post',
            'post' => Post::findOrFail($id)
        ];

        // Menampilkan halaman detail postingan
        return view('pages.detail', $data);
    }

    // Method untuk menampilkan halaman edit postingan
    public function edit(string $id): View
    {
        // Membuat variabel data untuk dikirim ke halaman
        $data = [
            'title' => 'Edit Post',
            'post' => Post::findOrFail($id)
        ];

        // Menampilkan halaman edit postingan
        return view('pages.edit', $data);
    }

    // Method untuk mengupdate postingan
    public function update(Request $request, string $id): RedirectResponse
    {
        // validasi data yang dikirim dari form
        $this->validate($request, [
            // gambar harus diisi dan harus berformat jpeg, png, jpg, gif, svg dengan ukuran maksimum 2048 kb
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // judul harus diisi minimal 5 karakter
            'title' => 'required|min:5',
            // konten harus diisi minimal 10 karakter
            'content' => 'required|min:10'
        ]);

        // mengambil file gambar dari form yang dikirim
        $image = $request->file('image');

        // menambahkan data ke database
        $post = Post::findOrFail($id);
        $post->update([
            // memasukkan judul
            'title' => $request->title,
            // memasukkan konten
            'content' => $request->content
        ]);

        // menghapus gambar lama
        if ($request->file('image') != "") {
            Storage::delete('public/posts/' . basename($post->image));
        }

        // menyimpan gambar baru
        if ($image != null) {
            // menggunakan method storeAs untuk menyimpan gambar ke folder posts
            $image->storeAs('public/posts', $image->hashName());
            $post->update([
                // memasukkan hashname dari gambar ke database
                'image' => $image->hashName(),
            ]);
        }

        // mengalihkan ke halaman posts dengan mengirimkan pesan sukses
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    // Method untuk menghapus postingan
    public function destroy($id): RedirectResponse
    {
        // mengambil data postingan
        $post = Post::findOrFail($id);

        // menghapus gambar
        Storage::delete('public/posts/' . $post->image);

        // menghapus data postingan
        $post->delete();

        // mengalihkan ke halaman posts dengan mengirimkan pesan sukses
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
