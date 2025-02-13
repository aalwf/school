<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        // Inverse relationship
        return $this->belongsTo(User::class);
    }
}
