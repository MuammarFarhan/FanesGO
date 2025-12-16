<?php
// File: app/Http/Controllers/ProdukController.php (Update existing)

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProductImage;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the products
     */
    public function index()
    {
        $produks = Produk::where('user_id', Auth::id())
            ->with(['kategori', 'images'])
            ->latest()
            ->paginate(12);

        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    /**
     * Store a newly created product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'primary_image' => 'nullable|integer' // Index of primary image
        ]);

        DB::beginTransaction();
        try {
            // Create product
            $produk = Produk::create([
                'user_id' => Auth::id(),
                'nama_produk' => $validated['nama_produk'],
                'kategori_id' => $validated['kategori_id'],
                'deskripsi' => $validated['deskripsi'],
                'harga' => $validated['harga'],
                'stok' => $validated['stok'],
            ]);

            // Upload and save images
            if ($request->hasFile('images')) {
                $primaryIndex = $request->get('primary_image', 0);
                
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');
                    
                    ProductImage::create([
                        'produk_id' => $produk->id,
                        'image_path' => $path,
                        'is_primary' => ($index == $primaryIndex),
                        'order' => $index
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('produk.index')
                ->with('success', 'Produk berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified product
     */
    public function show($id)
    {
        $produk = Produk::with(['kategori', 'user', 'images'])
            ->findOrFail($id);

        // Increment views
        $produk->incrementViews();

        // Get related products (same category)
        $relatedProducts = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->with(['kategori', 'primaryImage'])
            ->limit(4)
            ->get();

        return view('produk.show', compact('produk', 'relatedProducts'));
    }

    /**
     * Show the form for editing the product
     */
    public function edit($id)
    {
        $produk = Produk::where('user_id', Auth::id())
            ->with('images')
            ->findOrFail($id);
        
        $kategoris = Kategori::all();
        
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update the specified product
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'new_images' => 'nullable|array|max:5',
            'new_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'primary_image' => 'nullable|integer',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:product_images,id'
        ]);

        DB::beginTransaction();
        try {
            // Update product
            $produk->update([
                'nama_produk' => $validated['nama_produk'],
                'kategori_id' => $validated['kategori_id'],
                'deskripsi' => $validated['deskripsi'],
                'harga' => $validated['harga'],
                'stok' => $validated['stok'],
            ]);

            // Delete selected images
            if ($request->has('delete_images')) {
                ProductImage::whereIn('id', $request->delete_images)
                    ->where('produk_id', $produk->id)
                    ->delete();
            }

            // Upload new images
            if ($request->hasFile('new_images')) {
                $currentCount = $produk->images()->count();
                
                foreach ($request->file('new_images') as $index => $image) {
                    if ($currentCount + $index >= 5) break; // Max 5 images
                    
                    $path = $image->store('products', 'public');
                    
                    ProductImage::create([
                        'produk_id' => $produk->id,
                        'image_path' => $path,
                        'is_primary' => false,
                        'order' => $currentCount + $index
                    ]);
                }
            }

            // Update primary image
            if ($request->has('primary_image')) {
                ProductImage::where('produk_id', $produk->id)
                    ->update(['is_primary' => false]);
                
                ProductImage::where('produk_id', $produk->id)
                    ->where('id', $request->primary_image)
                    ->update(['is_primary' => true]);
            }

            DB::commit();
            return redirect()->route('produk.index')
                ->with('success', 'Produk berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengupdate produk: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified product
     */
    public function destroy($id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);
        
        // Images will be auto-deleted via model boot method
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * AJAX: Delete single image
     */
    public function deleteImage(Request $request)
    {
        $imageId = $request->get('image_id');
        
        $image = ProductImage::findOrFail($imageId);
        
        // Check authorization
        if ($image->produk->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    /**
     * AJAX: Set primary image
     */
    public function setPrimaryImage(Request $request)
    {
        $imageId = $request->get('image_id');
        
        $image = ProductImage::findOrFail($imageId);
        
        // Check authorization
        if ($image->produk->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Remove primary from all images
        ProductImage::where('produk_id', $image->produk_id)
            ->update(['is_primary' => false]);

        // Set new primary
        $image->update(['is_primary' => true]);

        return response()->json(['success' => true]);
    }
}