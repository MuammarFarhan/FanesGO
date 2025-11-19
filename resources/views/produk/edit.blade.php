@extends('layouts.app')
@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-bold mb-4">Edit: {{ $produk->nama_produk }}</h1>

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="w-full border rounded px-3 py-2">
            @error('nama_produk') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Kategori</label>
            <select name="kategori_id" class="w-full border rounded px-3 py-2">
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
                @endforeach
            </select>
            @error('kategori_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Harga (Rp)</label>
            <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="w-full border rounded px-3 py-2">
            @error('harga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Stok</label>
            <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="w-full border rounded px-3 py-2">
            @error('stok') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Deskripsi Singkat</label>
            <input name="deskripsi_singkat" value="{{ old('deskripsi_singkat', $produk->deskripsi_singkat) }}" class="w-full border rounded px-3 py-2">
            @error('deskripsi_singkat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Ganti Gambar Produk (Opsional)</label>
            @if($produk->file)
            <img src="{{ route('files.action', ['id' => $produk->file->id, 'action' => 'stream']) }}" alt="product image" class="w-24 h-24 object-cover rounded mb-2">
            @endif
            <input type="file" name="gambar_produk" class="w-full border rounded px-3 py-2">
            <p class="text-xs text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</p>
            @error('gambar_produk') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('produk.index') }}" class="text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Update</button>
        </div>
    </form>
</div>
@endsection