<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * post
     *
     * @return void
     */
    public function post()
    {
        // Inverse relationship
        return $this->belongsTo(Post::class);
    }
}
