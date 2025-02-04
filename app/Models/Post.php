<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute; // import Eloquent Attribute
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Field yang dapat diisi
    protected $fillable = [
        'image',
        'title',
        'content',
    ];

    // Accessor untuk attribute image
    protected function image(): Attribute
    {
        // Mengembalikan URL gambar
        return Attribute::make(
            get: fn($image) => url('/storage/posts/' . $image),
        );
    }
}
