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
        // Mengambil semua data postingan dengan mengurutkan postingan terbaru & melimit 5 data per halaman
        $posts = Post::latest()->paginate(5);

        // Menampilkan halaman postingan
        return view('pages.index', compact('posts'));
    }
}
