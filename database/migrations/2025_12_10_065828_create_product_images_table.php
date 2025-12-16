<?php
// File: database/migrations/xxxx_create_product_images_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->string('image_path');
            $table->boolean('is_primary')->default(false); // Main image
            $table->integer('order')->default(0); // Image order/sequence
            $table->timestamps();

            $table->index(['produk_id', 'is_primary']);
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};

// File: database/migrations/xxxx_add_columns_to_produks_table.php

return new class extends Migration
{
    /**
     * Add columns for search & filter
     */
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Add these columns if not exist
            $table->integer('views')->default(0)->after('stok'); // Product views
            $table->integer('sold')->default(0)->after('views'); // Total sold
            $table->decimal('rating', 3, 2)->default(0)->after('sold'); // Average rating
            $table->integer('review_count')->default(0)->after('rating'); // Total reviews

            // Indexes for faster search
            $table->index('nama_produk');
            $table->index('kategori_id');
            $table->index('harga');
            $table->index('stok');
            $table->index('rating');
            $table->index('sold');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn(['views', 'sold', 'rating', 'review_count']);
        });
    }
};
