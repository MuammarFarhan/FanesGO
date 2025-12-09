<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            // Data Utama Produk
            $table->string('nama_produk');
            
            // Relasi ke Tabel Kategori (PENTING untuk fitur dropdown)
            // Ini akan membuat kolom kategori_id yang terhubung ke id di tabel kategoris
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            
            // Data Harga & Stok
            $table->integer('harga');
            $table->integer('stok');
            
            // Data Tambahan
            $table->text('deskripsi')->nullable();
            
            // Kolom Gambar (PENTING untuk fitur upload gambar)
            // Kita gunakan string karena yang disimpan hanya path/alamat filenya
            $table->string('gambar')->nullable(); 

            // Opsional: Jika Anda memakai fitur login, simpan siapa yang upload
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};