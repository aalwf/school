<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // View dari Laravel
use App\Models\Product; // Model Product

class ProductController extends Controller
{
    // Method untuk menampilkan daftar produk
    public function index(): View
    {
        // Membuat variabel data untuk dikirim ke halaman
        $data = [
            'title' => 'Products',
            'products' => Product::all()
        ];

        // Menampilkan halaman postingan
        return view('pages.index', $data);
    }
}
