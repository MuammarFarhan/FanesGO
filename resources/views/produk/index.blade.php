@extends('layouts.dashboard')

@section('title', 'Daftar Produk')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold">Daftar Produk</h1>
        <p class="text-gray-500 text-sm">Kelola semua produk Anda di sini</p>
    </div>

    <a href="{{ route('produk.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
        + Tambah Produk
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-gray-100 text-gray-700 text-sm">
            <tr>
                <th class="px-6 py-4">Gambar</th>
                <th class="px-6 py-4">Nama Produk</th>
                <th class="px-6 py-4">Harga</th>
                <th class="px-6 py-4">Stok</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-gray-800 text-base">
            @forelse ($produks as $produk)
                <tr class="border-t hover:bg-gray-50">
                    <!-- GAMBAR -->
                    <td class="px-6 py-4">
                        <img
                            src="{{ $produk->gambar_url }}"
                            alt="{{ $produk->nama_produk }}"
                            class="w-16 h-16 object-cover rounded-lg border"
                        >
                    </td>

                    <!-- NAMA -->
                    <td class="px-6 py-4 font-semibold">
                        {{ $produk->nama_produk }}
                    </td>

                    <!-- HARGA -->
                    <td class="px-6 py-4 text-green-600 font-bold">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </td>

                    <!-- STOK -->
                    <td class="px-6 py-4">
                        {{ $produk->stok }}
                    </td>

                    <!-- AKSI -->
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('produk.edit', $produk->id) }}"
                           class="text-blue-600 hover:underline text-sm">
                            Edit
                        </a>

                        <form action="{{ route('produk.destroy', $produk->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="text-red-600 hover:underline text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-500">
                        Belum ada produk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $produks->links() }}
</div>

@endsection
