@extends('layouts.store')
@section('title', $produk->nama_produk . ' - Detail Produk')

@section('content')
<nav class="flex mb-6 text-gray-500 text-sm" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('home') }}" class="inline-flex items-center hover:text-green-600">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                Beranda
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-gray-700 md:ml-2 font-medium truncate max-w-[200px]">{{ $produk->nama_produk }}</span>
            </div>
        </li>
    </ol>
</nav>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-10">
    <div class="md:flex">
        <div class="md:w-1/2 bg-gray-100 relative group">
            @if($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}" 
                     alt="{{ $produk->nama_produk }}" 
                     class="w-full h-[400px] md:h-[500px] object-cover object-center">
            @else
                <div class="w-full h-[400px] md:h-[500px] flex items-center justify-center bg-gray-200 text-gray-400">
                    <div class="text-center">
                        <svg class="w-20 h-20 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p>Tidak ada gambar</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="md:w-1/2 p-8 md:p-10 flex flex-col">
            <div class="mb-4">
                <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                    {{ $produk->kategori->nama_kategori ?? 'Umum' }}
                </span>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $produk->nama_produk }}</h1>
            
            <div class="flex items-center mb-6">
                <div class="flex text-yellow-400">
                    @for($i=0; $i<5; $i++)
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endfor
                </div>
                <span class="text-gray-500 text-sm ml-2">(Belum ada ulasan)</span>
            </div>

            <div class="text-4xl font-bold text-green-600 mb-8">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </div>

            <div class="prose prose-sm text-gray-600 mb-8 flex-grow">
                <h3 class="text-gray-900 font-semibold text-lg mb-2">Deskripsi Produk</h3>
                <p class="leading-relaxed">
                    {{ $produk->deskripsi ?? 'Tidak ada deskripsi untuk produk ini.' }}
                </p>
            </div>

            <div class="border-t border-gray-100 pt-6 mt-auto">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full border border-gray-200" src="https://ui-avatars.com/api/?name={{ urlencode($produk->user->name ?? 'Admin') }}&background=10b981&color=fff" alt="Seller">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Penjual</p>
                            <p class="text-sm text-gray-500">{{ $produk->user->name ?? 'Admin Toko' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Stok Tersedia</p>
                        <p class="text-lg font-bold text-gray-900">{{ $produk->stok }} Pcs</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('home') }}" class="flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                        Kembali
                    </a>
                    
                    <a href="https://wa.me/?text=Halo,%20saya%20tertarik%20dengan%20produk%20*{{ urlencode($produk->nama_produk) }}*%20seharga%20Rp%20{{ number_format($produk->harga, 0, ',', '.') }}%20di%20FANES.GO" 
                       target="_blank"
                       class="flex items-center justify-center px-6 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 shadow-lg hover:shadow-green-200 transition-all transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Beli Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection