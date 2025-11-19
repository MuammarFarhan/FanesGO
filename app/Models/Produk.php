<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'user_id',
        'deskripsi_singkat',
        'harga',
        'stok'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Gambar Produk (dari Jobsheet 5) [cite: 1954-1957]
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}