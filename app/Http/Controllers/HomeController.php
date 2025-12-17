<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Beranda publik
     */
    public function index()
    {
        $produks = Produk::with('kategori')
            ->latest()
            ->take(8) // tampilkan sebagian saja di home
            ->get();

        return view('home', compact('produks'));
    }

    /**
     * List semua produk (publik)
     */
    public function produk()
    {
        $produks = Produk::with('kategori')
            ->latest()
            ->paginate(12);

        return view('produk.index', compact('produks'));
    }

    /**
     * Detail produk (publik)
     */
    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        return view('detail_produk', compact('produk'));
    }

    /**
     * Filter produk berdasarkan kategori (publik)
     */
    public function kategori(Request $request)
    {
        $kategoris = Kategori::all();

        $produks = Produk::with('kategori')
            ->when($request->kategori, function ($query) use ($request) {
                $query->whereHas('kategori', function ($q) use ($request) {
                    $q->where('nama_kategori', $request->kategori);
                });
            })
            ->latest()
            ->paginate(12);

        return view('kategori', compact('produks', 'kategoris'));
    }

    /**
     * Halaman statis
     */
    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
