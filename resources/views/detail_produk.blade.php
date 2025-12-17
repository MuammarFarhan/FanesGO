@extends('layouts.store')

@section('title', $produk->nama_produk)

@section('content')

@php
// Format nomor WhatsApp (08xxx → 628xxx)
$wa = preg_replace('/^0/', '62', $produk->whatsapp);

// Pesan otomatis WhatsApp
$pesan = urlencode(
"Halo, saya tertarik dengan produk anda yang bernama {$produk->nama_produk}. Apakah produk ini masih tersedia?"
);
@endphp

<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white p-8 rounded-2xl shadow-lg">

        <!-- GAMBAR PRODUK -->
        <div>
            <img src="{{ $produk->gambar_url }}"
                alt="{{ $produk->nama_produk }}"
                class="w-full h-[450px] object-cover rounded-xl border">
        </div>

        <!-- INFO PRODUK -->
        <div class="flex flex-col">

            <!-- KATEGORI -->
            <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs w-max">
                {{ $produk->kategori->nama ?? 'Umum' }}
            </span>

            <!-- NAMA -->
            <h1 class="text-3xl font-bold mt-4 text-gray-800">
                {{ $produk->nama_produk }}
            </h1>

            <!-- HARGA -->
            <p class="text-3xl text-green-600 font-bold mt-4">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </p>

            <!-- DESKRIPSI -->
            <div class="mt-6 text-gray-600 leading-relaxed">
                {{ $produk->deskripsi ?: 'Tidak ada deskripsi produk.' }}
            </div>

            <!-- STOK -->
            <div class="mt-6 text-sm text-gray-700">
                Stok tersedia:
                <strong>{{ $produk->stok }}</strong>
            </div>

            <!-- TOMBOL WHATSAPP -->
            <div class="mt-8">
                <a href="https://wa.me/{{ $wa }}?text={{ $pesan }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition">

                    <!-- ICON WA -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 24 24">
                        <path d="M20.52 3.48A11.82 11.82 0 0012.01 0C5.38 0 .01 5.37.01 12c0 2.11.55 4.17 1.6 6L0 24l6.2-1.62a11.9 11.9 0 005.8 1.48h.01c6.63 0 12-5.37 12-12a11.9 11.9 0 00-3.49-8.38zM12 22a10 10 0 01-5.1-1.39l-.37-.22-3.68.96.98-3.58-.24-.37A9.94 9.94 0 012 12C2 6.48 6.49 2 12.01 2a10 10 0 017.07 2.93A9.93 9.93 0 0122 12c0 5.52-4.49 10-10 10zm5.02-7.45c-.27-.14-1.6-.79-1.85-.88-.25-.09-.43-.14-.61.14-.18.27-.7.88-.86 1.06-.16.18-.32.2-.59.07-.27-.14-1.15-.42-2.19-1.35-.81-.72-1.36-1.61-1.52-1.88-.16-.27-.02-.42.12-.56.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.14-.61-1.48-.84-2.03-.22-.53-.44-.46-.61-.47h-.52c-.18 0-.48.07-.73.34-.25.27-.96.94-.96 2.3s.98 2.68 1.12 2.86c.14.18 1.93 2.95 4.67 4.13.65.28 1.15.45 1.54.58.65.21 1.24.18 1.71.11.52-.08 1.6-.65 1.83-1.27.23-.62.23-1.15.16-1.27-.07-.12-.25-.18-.52-.32z" />
                    </svg>

                    Beli via WhatsApp
                </a>
            </div>

        </div>
    </div>

</div>

@endsection