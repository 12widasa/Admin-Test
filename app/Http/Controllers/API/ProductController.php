<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil ID dan semua produk dari database
        $products = Product::select('id', 'nama')->get();

        // Mengembalikan response JSON dengan daftar produk
        return response()->json($products);
    }
}

