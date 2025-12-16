<?php
// File: app/Models/Produk.php (Update existing)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'gambar', // Keep for backward compatibility
        'views',
        'sold',
        'rating',
        'review_count'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'rating' => 'decimal:2'
    ];

    // ========== RELATIONSHIPS ==========
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Multi-images relationship
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    // Get primary image
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    // Get all non-primary images
    public function additionalImages()
    {
        return $this->hasMany(ProductImage::class)
            ->where('is_primary', false)
            ->orderBy('order');
    }

    // ========== SCOPES FOR SEARCH & FILTER ==========
    
    /**
     * Search by name, description, or category
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%")
                  ->orWhereHas('kategori', function($q) use ($search) {
                      $q->where('nama_kategori', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }
        return $query;
    }

    /**
     * Filter by category
     */
    public function scopeByKategori($query, $kategoriId)
    {
        if ($kategoriId && $kategoriId !== 'all') {
            return $query->where('kategori_id', $kategoriId);
        }
        return $query;
    }

    /**
     * Filter by price range
     */
    public function scopePriceRange($query, $min, $max)
    {
        if ($min !== null) {
            $query->where('harga', '>=', $min);
        }
        if ($max !== null) {
            $query->where('harga', '<=', $max);
        }
        return $query;
    }

    /**
     * Filter by rating
     */
    public function scopeMinRating($query, $rating)
    {
        if ($rating) {
            return $query->where('rating', '>=', $rating);
        }
        return $query;
    }

    /**
     * Filter only in stock
     */
    public function scopeInStock($query)
    {
        return $query->where('stok', '>', 0);
    }

    /**
     * Sort products
     */
    public function scopeSortBy($query, $sortBy)
    {
        switch ($sortBy) {
            case 'price-low':
                return $query->orderBy('harga', 'asc');
            case 'price-high':
                return $query->orderBy('harga', 'desc');
            case 'rating':
                return $query->orderBy('rating', 'desc');
            case 'popular':
                return $query->orderBy('sold', 'desc');
            case 'views':
                return $query->orderBy('views', 'desc');
            case 'name':
                return $query->orderBy('nama_produk', 'asc');
            case 'newest':
            default:
                return $query->orderBy('created_at', 'desc');
        }
    }

    // ========== HELPER METHODS ==========
    
    /**
     * Get main image URL (backward compatible)
     */
    public function getMainImageAttribute()
    {
        // Try to get primary image first
        $primaryImage = $this->primaryImage;
        if ($primaryImage) {
            return $primaryImage->image_url;
        }
        
        // Fallback to old gambar field
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        
        // Default placeholder
        return asset('images/no-image.png');
    }

    /**
     * Get all image URLs
     */
    public function getAllImagesAttribute()
    {
        $images = $this->images;
        
        if ($images->isEmpty() && $this->gambar) {
            // Backward compatibility
            return [asset('storage/' . $this->gambar)];
        }
        
        return $images->pluck('image_url')->toArray();
    }

    /**
     * Increment views counter
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Check if product is in stock
     */
    public function isInStock()
    {
        return $this->stok > 0;
    }

    /**
     * Get stock status label
     */
    public function getStockStatusAttribute()
    {
        if ($this->stok == 0) {
            return 'Habis';
        } elseif ($this->stok < 10) {
            return 'Stok Terbatas';
        } else {
            return 'Tersedia';
        }
    }
}