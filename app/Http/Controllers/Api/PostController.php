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
}
