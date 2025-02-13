<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get users form Model
        $users = User::latest()->get();

        //passing user to view
        return view('users', compact('users'));
    }
}
