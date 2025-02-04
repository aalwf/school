<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse; // RedirectResponse dari Laravel
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
            'products' => Product::latest()->paginate(10)
        ];

        // Menampilkan halaman postingan
        return view('pages.index', $data);
    }

    // Method untuk menampilkan halaman tambah produk
    public function create(): View
    {
        // Membuat variabel data untuk dikirim ke halaman
        $data = [
            'title' => 'Create Product'
        ];

        // Menampilkan halaman postingan
        return view('pages.create', $data);
    }

    // Method untuk menyimpan produk
    public function store(Request $request): RedirectResponse
    {
        // validasi data yang dikirim dari form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);


        // mengambil file gambar dari form yang dikirim
        $image = $request->file('image');

        // menggunakan method storeAs untuk menyimpan gambar ke folder posts
        $image->storeAs('public/products', $image->hashName());

        // menambahkan data ke database
        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        // mengalihkan ke halaman posts dengan mengirimkan pesan sukses
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    // Method untuk menampilkan detail product berdasarkan id
    public function show(string $id): View
    {
        // menyiapkan data untuk dikirim ke halaman
        $data = [
            'title' => 'Product Detail',
            'product' => Product::findOrFail($id)
        ];

        //render view with product
        return view('pages.detail', $data);
    }

    // Method untuk menampilkan halaman edit product berdasarkan id
    public function edit(string $id): View
    {
        // menyiapkan data untuk dikirim ke halaman
        $data = [
            'title' => 'Edit Product',
            'product' => Product::findOrFail($id)
        ];

        // menampilkan halaman edit product
        return view('pages.edit', $data);
    }
}
