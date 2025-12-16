@extends('layouts.store')
@section('title', 'Cari Produk - FANES.GO')

@section('content')
<div x-data="searchManager()" x-init="init()">
    <!-- Search Bar -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <form method="GET" action="{{ route('search.index') }}" class="flex gap-4">
            <div class="flex-1 relative">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    @input="debounceSearch($event.target.value)"
                    placeholder="Cari produk, kategori, atau penjual..."
                    class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none transition-colors text-lg"
                >
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>

                <!-- Autocomplete Suggestions -->
                <div x-show="suggestions.length > 0 && showSuggestions" 
                     @click.away="showSuggestions = false"
                     class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
                    <template x-for="product in suggestions" :key="product.id">
                        <a :href="product.url" 
                           class="flex items-center gap-3 px-4 py-3 hover:bg-green-50 transition-colors">
                            <img :src="product.image" :alt="product.name" class="w-12 h-12 object-cover rounded-lg">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800" x-text="product.name"></p>
                                <p class="text-sm text-gray-500">
                                    <span x-text="product.category"></span> • 
                                    <span x-text="product.price_formatted"></span>
                                </p>
                            </div>
                        </a>
                    </template>
                </div>
            </div>

            <button @click="showFilters = !showFilters" type="button"
                    class="px-6 py-4 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold flex items-center gap-2 transition-colors relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter
                <span x-show="activeFiltersCount > 0" 
                      x-text="activeFiltersCount"
                      class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center font-bold">
                </span>
            </button>
        </form>
    </div>

    <!-- Filters Panel -->
    <div x-show="showFilters" 
         x-transition
         class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <form method="GET" action="{{ route('search.index') }}" id="filterForm">
            <input type="hidden" name="search" value="{{ $search }}">
            
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Filter Pencarian</h3>
                <a href="{{ route('search.index') }}" class="text-red-600 hover:text-red-700 font-semibold text-sm flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset Filter
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kategoriId == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }} ({{ $kategori->produks_count }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Range Harga</label>
                    <div class="flex gap-2">
                        <input type="number" name="price_min" value="{{ $priceMin }}" placeholder="Min" 
                               class="w-1/2 px-3 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none">
                        <input type="number" name="price_max" value="{{ $priceMax }}" placeholder="Max"
                               class="w-1/2 px-3 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none">
                    </div>
                </div>

                <!-- Rating Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Rating Minimal</label>
                    <select name="rating" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none">
                        <option value="">Semua Rating</option>
                        @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ $rating == $i ? 'selected' : '' }}>
                            {{ $i }} ⭐ ke atas
                        </option>
                        @endfor
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Urutkan</label>
                    <select name="sort_by" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none">
                        <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price-low" {{ $sortBy == 'price-low' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price-high" {{ $sortBy == 'price-high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="rating" {{ $sortBy == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="popular" {{ $sortBy == 'popular' ? 'selected' : '' }}>Terlaris</option>
                        <option value="name" {{ $sortBy == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Stock Filter -->
            <div class="mt-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="in_stock" value="1" {{ $inStock ? 'checked' : '' }}
                           class="w-5 h-5 text-green-600 rounded focus:ring-green-500">
                    <span class="text-gray-700 font-medium">Tampilkan hanya produk yang tersedia</span>
                </label>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition-colors">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Results Info -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <p class="text-gray-600">
                Menampilkan <span class="font-bold text-gray-800">{{ $produks->count() }}</span> 
                dari <span class="font-bold text-gray-800">{{ $produks->total() }}</span> produk
                @if($search)
                untuk "<span class="font-bold text-green-600">{{ $search }}</span>"
                @endif
            </p>
        </div>
    </div>

    <!-- Products Grid -->
    @if($produks->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @foreach($produks as $produk)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group">
            <a href="{{ route('produk.detail', $produk->id) }}" class="block relative overflow-hidden">
                <img src="{{ $produk->main_image }}" 
                     alt="{{ $produk->nama_produk }}"
                     class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-300">
                
                @if($produk->kategori)
                <div class="absolute top-3 left-3">
                    <span class="bg-green-600/90 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                        {{ $produk->kategori->nama_kategori }}
                    </span>
                </div>
                @endif

                @if(!$produk->isInStock())
                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                    <span class="bg-red-500 text-white px-4 py-2 rounded-lg font-bold">HABIS</span>
                </div>
                @endif
            </a>

            <div class="p-5">
                <a href="{{ route('produk.detail', $produk->id) }}">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 hover:text-green-600 transition-colors line-clamp-1">
                        {{ $produk->nama_produk }}
                    </h3>
                </a>

                <p class="text-sm text-gray-600 mb-2 line-clamp-2 h-10">
                    {{ $produk->deskripsi ?? 'Produk berkualitas dari UMKM lokal pilihan.' }}
                </p>

                <div class="flex items-center gap-2 mb-3">
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $produk->rating ? 'text-yellow-500 fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                        @endfor
                    </div>
                    <span class="text-sm font-bold text-gray-700">{{ number_format($produk->rating, 1) }}</span>
                    <span class="text-xs text-gray-500">({{ $produk->review_count }})</span>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="font-bold text-green-600 text-xl">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Terjual: {{ $produk->sold }} | Stok: {{ $produk->stok }}
                        </p>
                    </div>
                </div>

                <a href="{{ route('produk.detail', $produk->id) }}" 
                   class="block w-full text-center bg-green-600 text-white px-4 py-2.5 rounded-lg font-semibold hover:bg-green-700 transition-colors shadow-md hover:shadow-lg">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $produks->links() }}
    </div>

    @else
    <div class="bg-white rounded-2xl p-16 text-center">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Produk Tidak Ditemukan</h3>
        <p class="text-gray-500 mb-6">Coba gunakan kata kunci lain atau ubah filter pencarian</p>
        <a href="{{ route('search.index') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold">
            Reset Pencarian
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function searchManager() {
    return {
        showFilters: false,
        showSuggestions: false,
        suggestions: [],
        searchTimer: null,
        activeFiltersCount: 0,

        init() {
            this.calculateActiveFilters();
        },

        calculateActiveFilters() {
            let count = 0;
            const params = new URLSearchParams(window.location.search);
            
            if (params.get('kategori')) count++;
            if (params.get('price_min') || params.get('price_max')) count++;
            if (params.get('rating')) count++;
            if (params.get('in_stock')) count++;
            
            this.activeFiltersCount = count;
        },

        debounceSearch(query) {
            clearTimeout(this.searchTimer);
            
            if (query.length < 2) {
                this.suggestions = [];
                this.showSuggestions = false;
                return;
            }

            this.searchTimer = setTimeout(() => {
                this.fetchSuggestions(query);
            }, 300);
        },

        fetchSuggestions(query) {
            fetch(`{{ route('search.autocomplete') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    this.suggestions = data;
                    this.showSuggestions = data.length > 0;
                })
                .catch(error => console.error('Error:', error));
        }
    }
}
</script>
@endpush

@push('styles')
<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush