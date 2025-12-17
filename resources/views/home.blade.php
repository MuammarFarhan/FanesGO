@extends('layouts.store') @section('title', 'FANES.GO - UMKM Bengkalis')

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-500 rounded-2xl shadow-xl p-8 md:p-12 mb-8 text-white">
    <div class="max-w-2xl">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Selamat Datang di FANES.GO</h1>
        <p class="text-lg text-green-50 mb-6">Marketplace UMKM terpercaya. Temukan berbagai produk lokal berkualitas hanya disini.</p>
        <div class="flex gap-4">
            <a href="#produk" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                Lihat Produk
            </a>
        </div>
    </div>
</div>

<div id="produk" class="mb-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Produk Best Seller</h2>
            <p class="text-gray-600 mt-1">Produk favorit pilihan pelanggan</p>
        </div>
    </div>

    @if($produks->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($produks as $produk)
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 group flex flex-col h-full">

            <a href="{{ route('produk.detail', $produk->id) }}" class="block relative overflow-hidden">
                @if($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}"
                    alt="{{ $produk->nama_produk }}"
                    class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-300">
                @else
                <div class="w-full h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif

                <div class="absolute top-3 left-3">
                    <span class="bg-green-600/90 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                        {{ $produk->kategori->nama_kategori ?? 'Umum' }}
                    </span>
                </div>
            </a>

            <div class="p-5 flex flex-col flex-grow">
                <a href="{{ route('produk.detail', $produk->id) }}" class="block">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 hover:text-green-600 transition-colors line-clamp-1">
                        {{ $produk->nama_produk }}
                    </h3>
                </a>

                <p class="text-sm text-gray-600 mb-4 line-clamp-2 h-10">
                    {{ $produk->deskripsi ?? 'Produk berkualitas dari UMKM lokal pilihan.' }}
                </p>

                <div class="mt-auto">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="font-bold text-green-600 text-xl">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                Stok: {{ $produk->stok > 0 ? $produk->stok : 'Habis' }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('produk.detail', $produk->id) }}" class="block w-full text-center bg-green-600 text-white px-4 py-2.5 rounded-lg font-semibold hover:bg-green-700 transition-colors shadow-md hover:shadow-lg focus:ring-4 focus:ring-green-200">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-12 mb-8">
        <button class="bg-white text-green-600 border-2 border-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md">
            Lihat Lebih Banyak
        </button>
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-md p-12 text-center border border-gray-100">
        <div class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Produk</h3>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">Saat ini belum ada produk yang tersedia. Jadilah yang pertama menjual produk di sini!</p>

        @auth
        <a href="{{ route('produk.create') }}" class="inline-flex items-center bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Produk
        </a>
        @endauth
    </div>
    @endif
</div>

<div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-10 text-center text-white shadow-xl mt-16">
    <h2 class="text-3xl font-bold mb-4">
        Kenapa Belanja di FANES.GO?
    </h2>

    <p class="max-w-2xl mx-auto text-green-100 mb-6">
        FANES.GO menghadirkan produk oleh-oleh UMKM pilihan
        dengan kualitas terbaik langsung dari pelaku usaha lokal terpercaya.
    </p>

    <a href="{{ route('kategori.index') }}"
        class="inline-flex items-center justify-center px-8 py-3
          bg-white text-green-700 font-semibold rounded-xl
          hover:bg-green-100 transition shadow-lg">
        Lihat Kategori
    </a>
</div>

</div>
@endsection

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