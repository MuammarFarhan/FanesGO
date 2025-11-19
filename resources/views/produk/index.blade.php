@extends('layouts.app')
@section('title', 'Manajemen Produk')
@section('page-title', 'Produk Saya')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold">Daftar Produk</h2>
        <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Produk</a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2 border">Gambar</th>
                <th class="p-2 border">Nama Produk</th>
                <th class="p-2 border">Kategori</th>
                <th class="p-2 border">Harga</th>
                <th class="p-2 border">Stok</th>
                <th class="p-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produks as $produk)
            <tr class="hover:bg-gray-50">
                <td class="p-2 border">
                    @if($produk->file)
                    <img src="{{ route('files.action', ['id' => $produk->file->id, 'action' => 'stream']) }}" alt="product image" class="w-16 h-16 object-cover rounded">
                    @else
                    <span class="text-xs text-gray-500">N/A</span>
                    @endif
                </td>
                <td class="p-2 border">{{ $produk->nama_produk }}</td>
                <td class="p-2 border">{{ $produk->kategori->nama_kategori ?? 'N/A' }}</td>
                <td class="p-2 border">Rp {{ number_format($produk->harga) }}</td>
                <td class="p-2 border">{{ $produk->stok }}</td>
                <td class="p-2 border text-center">
                    <a href="{{ route('produk.edit', $produk->id) }}" class="text-yellow-600 hover:underline">Edit</a> |
                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-4 text-center text-gray-500">Anda belum memiliki produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection