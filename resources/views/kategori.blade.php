@extends('layouts.store')
@section('title', 'Kategori Produk - FANES.GO')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    <aside class="w-full md:w-1/4">
        <div class="bg-white rounded-xl shadow-md p-6 sticky top-24 border border-gray-100">
            <h3 class="font-bold text-lg mb-4 text-gray-800 border-b pb-2">Kategori</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('kategori.index') }}"
                        class="block px-4 py-2 rounded-lg transition-colors {{ !request('kategori') ? 'bg-green-600 text-white font-semibold shadow-md' : 'text-gray-600 hover:bg-green-50 hover:text-green-600' }}">
                        Semua Produk
                    </a>
                </li>
                @foreach($kategoris as $kategori)
                <li>
                    <a href="{{ route('kategori.index', ['kategori' => $kategori->nama_kategori]) }}"
                        class="block px-4 py-2 rounded-lg transition-colors {{ request('kategori') == $kategori->nama_kategori ? 'bg-green-600 text-white font-semibold shadow-md' : 'text-gray-600 hover:bg-green-50 hover:text-green-600' }}">
                        {{ $kategori->nama_kategori }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </aside>

    <div class="w-full md:w-3/4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                {{ request('kategori') ? 'Kategori: ' . request('kategori') : 'Semua Produk' }}
            </h1>
            <p class="text-gray-500 text-sm mt-1">Menampilkan {{ $produks->count() }} produk</p>
        </div>

        @if($produks->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($produks as $produk)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group hover:-translate-y-1 border border-gray-100">
                <a href="{{ route('produk.detail', $produk->id) }}" class="block relative">
                    @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-2 left-2">
                        <span class="bg-white/90 backdrop-blur text-green-700 text-xs font-bold px-2 py-1 rounded shadow-sm">
                            {{ $produk->kategori->nama_kategori }}
                        </span>
                    </div>
                </a>
                <div class="p-4">
                    <a href="{{ route('produk.detail', $produk->id) }}">
                        <h3 class="font-bold text-gray-800 mb-1 hover:text-green-600 transition-colors truncate">{{ $produk->nama_produk }}</h3>
                    </a>
                    <p class="text-green-600 font-bold text-lg">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xs text-gray-500">Stok: {{ $produk->stok }}</span>
                        <a href="{{ route('produk.detail', $produk->id) }}" class="text-sm font-semibold text-green-600 hover:underline">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-xl p-12 text-center border border-dashed border-gray-300">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900">Tidak ada produk</h3>
            <p class="text-gray-500 mt-1">Belum ada produk untuk kategori ini.</p>
            <a href="{{ route('kategori.index') }}" class="mt-4 inline-block text-green-600 font-semibold hover:underline">Lihat semua kategori</a>
        </div>
        @endif
    </div>
</div>
@endsection