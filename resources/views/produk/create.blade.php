@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-bold mb-4">Form Produk Baru</h1>

    <form action="{{ route('produk.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <div>
            <label class="block mb-1 font-medium">Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" class="w-full border rounded px-3 py-2">
            @error('nama_produk') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Kategori</label>
            <select name="kategori_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
                @endforeach
            </select>
            @error('kategori_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Harga (Rp)</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="w-full border rounded px-3 py-2">
            @error('harga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Stok</label>
            <input type="number" name="stok" value="{{ old('stok') }}" class="w-full border rounded px-3 py-2">
            @error('stok') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Deskripsi Singkat</label>
            <input name="deskripsi_singkat" value="{{ old('deskripsi_singkat') }}" class="w-full border rounded px-3 py-2">
            @error('deskripsi_singkat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Gambar Produk</label>
            <input type="file" name="gambar_produk" class="w-full border rounded px-3 py-2">
            @error('gambar_produk') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('produk.index') }}" class="text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Simpan</button>
        </div>
    </form>
</div>
@endsection