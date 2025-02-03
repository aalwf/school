<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * fillable attributes that can be mass assigned
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'content',
    ];
}
