<?php

use App\Http\Controllers\ProductController; // Import ProductController
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Jalur untuk resource product
Route::resource('/products', \App\Http\Controllers\ProductController::class);
