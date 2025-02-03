<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // HasFactory dari Laravel
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Menggunakan HasFactory
    use HasFactory;

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
    ];
}
