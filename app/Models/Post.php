<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Field yang dapat diisi secara massal
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'content',
    ];
}
