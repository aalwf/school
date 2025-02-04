<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
