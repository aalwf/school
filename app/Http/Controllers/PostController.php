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
        // Mengambil semua data postingan dengan mengurutkan postingan terbaru & melimit 5 data per halaman
        $posts = Post::latest()->paginate(5);

        // Menampilkan halaman postingan
        return view('pages.index', compact('posts'));
    }
}
