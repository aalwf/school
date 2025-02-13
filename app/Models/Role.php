<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * users
     *
     * @return void
     */
    public function users()
    {
        // Many-to-Many relationship
        return $this->belongsToMany(User::class, 'user_role');
    }
}
