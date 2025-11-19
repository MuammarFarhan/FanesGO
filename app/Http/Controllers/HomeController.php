<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil produk, eager load relasi 'file' (gambar)
        $produks = Produk::with('file')->latest()->get();
        return view('home', compact('produks'));
    }

    public function show($id)
    {
        // Untuk halaman detail produk
        $produk = Produk::with('file', 'kategori', 'user')->findOrFail($id);
        return view('produk_detail', compact('produk')); // (View produk_detail.blade.php tidak saya buatkan, tapi ini pondasinya)
    }
}