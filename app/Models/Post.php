<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Field yang dapat diisi
    protected $fillable = [
        'image',
        'title',
        'content',
    ];
}
