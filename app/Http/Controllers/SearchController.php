<?php
// File: app/Http/Controllers/SearchController.php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Main search page with filters
     */
    public function index(Request $request)
    {
        $query = Produk::with(['kategori', 'user', 'primaryImage']);

        // Get filter parameters
        $search = $request->get('search');
        $kategoriId = $request->get('kategori');
        $priceMin = $request->get('price_min');
        $priceMax = $request->get('price_max');
        $rating = $request->get('rating');
        $inStock = $request->get('in_stock');
        $sortBy = $request->get('sort_by', 'newest');

        // Apply filters
        $query->search($search)
              ->byKategori($kategoriId)
              ->priceRange($priceMin, $priceMax)
              ->minRating($rating)
              ->sortBy($sortBy);

        // Filter only in stock products if checked
        if ($inStock) {
            $query->inStock();
        }

        // Paginate results
        $produks = $query->paginate(12)->appends($request->except('page'));

        // Get all categories for filter
        $kategoris = Kategori::withCount('produks')->get();

        return view('search.index', compact(
            'produks',
            'kategoris',
            'search',
            'kategoriId',
            'priceMin',
            'priceMax',
            'rating',
            'inStock',
            'sortBy'
        ));
    }

    /**
     * AJAX autocomplete suggestions
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('q');
        
        if (strlen($search) < 2) {
            return response()->json([]);
        }

        $products = Produk::with(['kategori', 'primaryImage'])
            ->search($search)
            ->limit(5)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->nama_produk,
                    'category' => $product->kategori->nama_kategori ?? '',
                    'price' => $product->harga,
                    'price_formatted' => 'Rp ' . number_format($product->harga, 0, ',', '.'),
                    'image' => $product->main_image,
                    'url' => route('produk.detail', $product->id)
                ];
            });

        return response()->json($products);
    }

    /**
     * Get filter stats (for AJAX)
     */
    public function getFilterStats(Request $request)
    {
        $query = Produk::query();

        // Apply existing filters
        $query->search($request->get('search'))
              ->byKategori($request->get('kategori'))
              ->priceRange($request->get('price_min'), $request->get('price_max'))
              ->minRating($request->get('rating'));

        return response()->json([
            'total' => $query->count(),
            'in_stock' => $query->clone()->inStock()->count(),
            'price_range' => [
                'min' => $query->clone()->min('harga') ?? 0,
                'max' => $query->clone()->max('harga') ?? 0
            ]
        ]);
    }
}