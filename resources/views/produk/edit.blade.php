@extends('layouts.dashboard')

@section('title', 'Edit Produk')

@section('content')

<a href="{{ route('produk.index') }}" class="text-sm text-green-600 hover:underline">
    ← Kembali ke Daftar Produk
</a>

<div class="flex justify-center mt-6">
    <div class="w-full max-w-3xl bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold mb-4">Edit Produk</h2>

        <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="font-medium">Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}"
                       class="w-full border rounded-lg px-3 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="font-medium">Kategori</label>
                <select name="kategori_id" class="w-full border rounded-lg px-3 py-2 mt-1">
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-medium">Harga</label>
                    <input type="number" name="harga" value="{{ $produk->harga }}"
                           class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
                <div>
                    <label class="font-medium">Stok</label>
                    <input type="number" name="stok" value="{{ $produk->stok }}"
                           class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
            </div>

            <div class="mb-4">
                <label class="font-medium">Nomor WhatsApp</label>
                <input type="text" name="whatsapp" value="{{ $produk->whatsapp }}"
                       class="w-full border rounded-lg px-3 py-2 mt-1"
                       placeholder="628xxxxxxxxxx">
                <p class="text-xs text-gray-500 mt-1">
                    Nomor ini akan digunakan untuk tombol “Beli via WhatsApp”
                </p>
            </div>

            <div class="mb-4">
                <label class="font-medium">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                          class="w-full border rounded-lg px-3 py-2 mt-1">{{ $produk->deskripsi }}</textarea>
            </div>

            <div class="mb-4">
                <label class="font-medium">Ganti Foto Produk</label>
                <input type="file" name="gambar" class="w-full border rounded-lg px-3 py-2 mt-1">
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('produk.index') }}" class="px-4 py-2 border rounded-lg">
                    Batal
                </a>
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
