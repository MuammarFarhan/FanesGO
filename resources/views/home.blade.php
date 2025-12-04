@extends('layouts.store') @section('title', 'FANES.GO - Jual Beli Oleh-oleh UMKM')

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-500 rounded-2xl shadow-xl p-8 md:p-12 mb-8 text-white">
    <div class="max-w-2xl">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Selamat Datang di FANES.GO</h1>
        <p class="text-lg text-green-50 mb-6">Marketplace Oleh-oleh UMKM terpercaya. Temukan berbagai produk lokal berkualitas dari seluruh Indonesia.</p>
        <div class="flex gap-4">
            <a href="#produk" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                Lihat Produk
            </a>
            @guest
            <a href="{{ route('register') }}" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition-colors">
                Daftar Sekarang
            </a>
            @endguest
        </div>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
    <div class="bg-white rounded-xl shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-green-600">{{ $produks->count() }}+</div>
        <div class="text-gray-600 mt-2">Produk</div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-green-600">100+</div>
        <div class="text-gray-600 mt-2">UMKM</div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-green-600">1000+</div>
        <div class="text-gray-600 mt-2">Pelanggan</div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-green-600">34</div>
        <div class="text-gray-600 mt-2">Provinsi</div>
    </div>
</div>

<div id="produk" class="mb-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Produk BestSeller</h2>
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
                        <div class="text-yellow-500 flex items-center bg-yellow-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                            </svg>
                            <span class="text-xs ml-1 font-bold text-gray-700">4.8</span>
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

<div class="bg-gradient-to-br from-green-700 to-green-600 rounded-2xl shadow-2xl p-8 md:p-16 mt-12 mb-8 text-white text-center relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Punya Produk UMKM?</h2>
        <p class="text-green-50 mb-8 max-w-2xl mx-auto text-lg">
            Bergabunglah dengan ribuan UMKM lainnya. Jangkau pelanggan baru dan tingkatkan penjualan Anda bersama FANES.GO.
        </p>
        @guest
        <a href="{{ route('register') }}" class="inline-block bg-white text-green-700 px-10 py-4 rounded-xl font-bold hover:bg-green-50 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
            Daftar Sebagai Penjual
        </a>
        @else
        <a href="{{ route('produk.create') }}" class="inline-block bg-white text-green-700 px-10 py-4 rounded-xl font-bold hover:bg-green-50 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
            Mulai Jual Produk
        </a>
        @endguest
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