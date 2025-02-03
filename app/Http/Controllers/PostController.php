<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Method to get all posts
     *
     * @return void
     */
    public function index()
    {
        // Get all posts from the Post model and limit the data displayed to 5 on each page
        $posts = Post::latest()->paginate(5);
    }
}
