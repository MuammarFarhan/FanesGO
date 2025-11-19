@extends('layouts.app')
@section('title', 'Kategori Produk')
@section('page-title', 'Manajemen Kategori')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-1">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Tambah Kategori Baru</h2>
            <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 font-medium">Nama Kategori</label>
                    <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" class="w-full border rounded px-3 py-2">
                    @error('nama_kategori') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow w-full">Simpan</button>
            </form>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Daftar Kategori</h2>

            @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-2 border">Nama Kategori</th>
                        <th class="p-2 border">Slug</th>
                        <th class="p-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $kategori->nama_kategori }}</td>
                        <td class="p-2 border">{{ $kategori->slug }}</td>
                        <td class="p-2 border text-center">
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Belum ada kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection