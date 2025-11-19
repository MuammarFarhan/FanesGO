@extends('layouts.store')
@section('title', 'FANES.GO - Jual Beli Oleh-oleh UMKM')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Produk BestSeller</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($produks as $produk)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                <a href="#">
                    @if($produk->file)
                        <img src="{{ route('files.action', ['id' => $produk->file->id, 'action' => 'stream']) }}" 
                             alt="{{ $produk->nama_produk }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Tanpa Gambar</span>
                        </div>
                    @endif
                </a>
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-900 truncate">{{ $produk->nama_produk }}</h3>
                    <p class="text-sm text-gray-600 mb-2 h-10 overflow-hidden">{{ $produk->deskripsi_singkat }}</p>
                    <p class="font-bold text-green-600 text-xl">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <a href="#" class="mt-4 block w-full text-center bg-green-600 text-white px-4 py-2 rounded font-semibold hover:bg-green-700">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <p class="col-span-4 text-center text-gray-500">Belum ada produk untuk ditampilkan.</p>
        @endforelse
    </div>
@endsection