<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute; // import Eloquent Attribute
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Field yang dapat diisi
    protected $fillable = [
        'image',
        'title',
        'content',
    ];
}
