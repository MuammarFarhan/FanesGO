<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->get();
        return view('home', compact('produks'));
    }

    public function show($id)
    {
        $produk = Produk::with(['kategori', 'user'])->findOrFail($id);
        return view('detail_produk', compact('produk'));
    }


    public function kategori(Request $request)
    {
        $query = Produk::with('kategori');

        if ($request->has('kategori')) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        $produks = $query->latest()->get();
        $kategoris = Kategori::all();

        return view('kategori', compact('produks', 'kategoris'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}