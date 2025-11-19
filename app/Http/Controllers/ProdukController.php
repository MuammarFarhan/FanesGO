<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Diambil dari Jobsheet 5 [cite: 1998]

class ProdukController extends Controller
{
    public function index()
    {
        // [cite: 533-538]
        $produks = Produk::with('kategori', 'file')
                       ->where('user_id', Auth::id()) // Tampilkan produk milik user yg login
                       ->latest()->get();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        // [cite: 540-542]
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // [cite: 544-560]
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi_singkat' => 'required|string|max:255',
            'gambar_produk' => 'required|image|mimes:jpg,jpeg,png|max:2048' // Validasi dari Jobsheet 5 [cite: 2009]
        ]);

        $validated['user_id'] = Auth::id();
        $produk = Produk::create($validated);

        // Logika Upload File (dari Jobsheet 5) [cite: 2020-2032]
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = $produk->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $folder = 'produk_images';
            $path = $file->storeAs($folder, $filename);

            $produk->file()->create([
                'alias' => 'gambar-produk',
                'filename' => $filename,
                'path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Produk $produk)
    {
        // (Tidak diimplementasikan di Jobsheet 3, tapi ini strukturnya)
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        // [cite: 570-573]
        if ($produk->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }
        $kategoris = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        // [cite: 575-592]
        if ($produk->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi_singkat' => 'required|string|max:255',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $produk->update($validated);

        // Logika Update File (dari Jobsheet 5) [cite: 2020-2032]
        if ($request->hasFile('gambar_produk')) {
            if ($produk->file) { // [cite: 2017]
                Storage::delete($produk->file->path); // [cite: 2018]
                $produk->file->delete(); // [cite: 2019]
            }
            $file = $request->file('gambar_produk');
            $filename = $produk->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $folder = 'produk_images';
            $path = $file->storeAs($folder, $filename);
            $produk->file()->create([
                'alias'
                => 'gambar-produk',
                'filename' => $filename,
                'path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        // [cite: 594-602]
        if ($produk->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        if ($produk->file) {
            Storage::delete($produk->file->path); // [cite: 2018]
            $produk->file->delete(); // [cite: 2019]
        }

        $produk->delete(); // [cite: 600]
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}