<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts from Model
        $posts = Post::latest()->get();

        //passing posts to view
        return view('posts', compact('posts'));
    }
}
