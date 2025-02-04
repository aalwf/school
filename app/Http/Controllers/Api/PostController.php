<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // import validator dari laravel
use Illuminate\Support\Facades\Storage; // import storage dari laravel
use App\Http\Resources\PostResource; // import resource Post
use App\Models\Post; // import model Post

class PostController extends Controller
{
    // Method untuk menampilkan semua data Post
    public function index()
    {
        // Mengambil semua data Post
        $posts = Post::latest()->paginate(5);

        // Mengembalikan data Post dalam bentuk Resource
        return new PostResource(true, 'List Data Posts', $posts);
    }

    // Method untuk menambahkan data Post
    public function store(Request $request)
    {
        // validasi data request dari client
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
        ]);

        // return error dengan status 422 jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // ambil file gambar dari request
        $image = $request->file('image');

        // upload image ke storage
        $image->storeAs('public/posts', $image->hashName());

        // buat postingan baru
        $post = Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        // mengembalikan data Post yang dibuat dalam bentuk Resource
        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }

    // Method untuk menampilkan detail data Post
    public function show($id)
    {
        // mengambil data post berdasarkan id
        $post = Post::find($id);

        // mengembalikan data Post dalam bentuk Resource
        return new PostResource(true, 'Detail Data Post!', $post);
    }

    // Method untuk mengupdate data Post
    public function update(Request $request, $id)
    {
        // validasi data request dari client
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        // return error dengan status 422 jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // ambil data post berdasarkan id
        $post = Post::find($id);

        // mengecek apakah request memiliki file gambar
        if ($request->hasFile('image')) {
            // ambil image dari request
            $image = $request->file('image');

            // upload image ke storage
            $image->storeAs('public/posts', $image->hashName());

            // hapus image lama
            Storage::delete('public/posts/' . basename($post->image));

            // update post
            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        } else {
            // update post tanpa mengubah image
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        }

        // mengembalikan data Post yang diubah dalam bentuk Resource
        return new PostResource(true, 'Data Post Berhasil Diubah!', $post);
    }

    // Method untuk menghapus data Post
    public function destroy($id)
    {
        // ambil data post berdasarkan id
        $post = Post::find($id);

        // hapus image
        Storage::delete('public/posts/' . basename($post->image));

        // hapus post
        $post->delete();

        // mengembalikan response sukses
        return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
