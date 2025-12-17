@extends('layouts.dashboard')

@section('title', 'Tambah Produk')

@section('content')

<a href="{{ route('produk.index') }}"
    class="text-sm text-green-600 hover:underline mb-6 inline-block">
    ← Kembali ke Daftar Produk
</a>

<div class="flex justify-center">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 w-full max-w-5xl">

        <!-- FORM -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-4">Tambah Produk</h2>

            <form method="POST"
                action="{{ route('produk.store') }}"
                enctype="multipart/form-data">
                @csrf

                <!-- NAMA -->
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Produk</label>
                    <input type="text" name="nama_produk" required
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring focus:ring-green-200"
                        placeholder="Contoh: Keripik Pisang Original">
                </div>

                <!-- KATEGORI -->
                <div class="mb-4">
                    <label class="block text-sm font-medium">Kategori</label>
                    <select name="kategori_id"
                        class="w-full border rounded-lg px-3 py-2 mt-1">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">
                            {{ $kategori->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- HARGA & STOK -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium">Harga</label>
                        <input type="number" name="harga" required
                            class="w-full border rounded-lg px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Stok</label>
                        <input type="number" name="stok" required
                            class="w-full border rounded-lg px-3 py-2 mt-1">
                    </div>
                </div>

                <!-- WHATSAPP -->
                <div class="mb-4">
                    <label class="block text-sm font-medium">
                        Nomor WhatsApp Penjual
                    </label>
                    <input type="text" name="whatsapp" required
                        class="w-full border rounded-lg px-3 py-2 mt-1"
                        placeholder="Contoh: 08123456789">
                    <p class="text-xs text-gray-500 mt-1">
                        Nomor ini akan digunakan untuk pemesanan via WhatsApp
                    </p>
                </div>

                <!-- DESKRIPSI -->
                <div class="mb-4">
                    <label class="block text-sm font-medium">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full border rounded-lg px-3 py-2 mt-1"
                        placeholder="Jelaskan keunggulan produk Anda"></textarea>
                </div>

                <!-- GAMBAR -->
                <div class="mb-6">
                    <label class="block text-sm font-medium">Foto Produk</label>
                    <input type="file" name="gambar"
                        class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>

                <!-- ACTION -->
                <div class="flex justify-end gap-2">
                    <a href="{{ route('produk.index') }}"
                        class="px-4 py-2 border rounded-lg">
                        Batal
                    </a>
                    <button
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>

        <!-- TIPS -->
        <div class="bg-green-50 border border-green-200 rounded-xl p-5 h-fit">
            <h3 class="font-bold text-green-700 mb-3">💡 Tips Membuat Produk</h3>
            <ul class="text-sm text-green-700 space-y-2 list-disc pl-4">
                <li>Gunakan nama produk yang jelas</li>
                <li>Foto produk harus terang & fokus</li>
                <li>Isi deskripsi dengan manfaat</li>
                <li>Gunakan nomor WhatsApp aktif</li>
            </ul>
        </div>

    </div>
</div>

@endsection