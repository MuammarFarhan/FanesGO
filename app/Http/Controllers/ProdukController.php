<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::where('user_id', Auth::id())
            ->with('kategori')
            ->latest()
            ->paginate(10);

        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create', [
            'kategoris' => Kategori::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'whatsapp' => 'required|string',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create([
            'user_id' => auth()->id(),
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'whatsapp' => $request->whatsapp,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // ✅ METHOD EDIT (INI YANG HILANG SEBELUMNYA)
    public function edit($id)
    {
        $produk = Produk::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('produk.edit', [
            'produk' => $produk,
            'kategoris' => Kategori::all(),
        ]);
    }

    // ✅ UPDATE PRODUK + WHATSAPP
    public function update(Request $request, $id)
    {
        $produk = Produk::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'whatsapp' => 'required|string',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $produk->gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'whatsapp' => $request->whatsapp,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}
