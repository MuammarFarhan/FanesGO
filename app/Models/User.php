<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'no_hp',
    'alamat_toko',
    'deskripsi_toko'
];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi Foto Profil (dari Jobsheet 5) [cite: 1954-1957]
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    // Relasi User (Penjual) ke Produk
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}