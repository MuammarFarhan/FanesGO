@extends('layouts.app')
@section('title', 'Tambah Produk Baru')
@section('page-title', 'Tambah Produk')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('produk.index') }}" class="inline-flex items-center text-gray-600 hover:text-green-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Produk
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Produk</h2>
                    <p class="text-sm text-gray-500">Lengkapi detail produk yang ingin Anda jual</p>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700 font-medium">Terdapat kesalahan pada input Anda:</p>
                                <ul class="mt-1 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" id="produkForm">
                        @csrf

                        <div class="mb-6">
                            <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                placeholder="Contoh: Kripik Pisang Coklat Lumer" required>
                        </div>

                        <div class="mb-6">
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="kategori_id" id="kategori_id" 
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 appearance-none bg-white transition-colors" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" step="1000"
                                        class="w-full pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                        placeholder="0" required>
                                </div>
                            </div>

                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">Stok Awal <span class="text-red-500">*</span></label>
                                <input type="number" name="stok" id="stok" value="{{ old('stok') }}" min="0"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                    placeholder="0" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                placeholder="Jelaskan keunggulan, bahan, dan detail produk Anda...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-500 transition-colors cursor-pointer bg-gray-50" id="drop-zone">
                                <div class="space-y-1 text-center" id="upload-placeholder">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                            <span>Upload file</span>
                                            <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF max 2MB</p>
                                </div>

                                <div id="preview-container" class="hidden text-center">
                                    <img id="preview" src="#" alt="Preview" class="mx-auto h-48 object-cover rounded-lg shadow-sm">
                                    <button type="button" onclick="removeImage()" class="mt-3 text-sm text-red-600 hover:text-red-800 font-medium inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('produk.index') }}" class="px-6 py-2.5 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                                Simpan Produk
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 sticky top-24">
                <div class="flex items-center mb-4">
                    <span class="bg-blue-100 p-2 rounded-lg text-blue-600 mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                    <h3 class="text-lg font-semibold text-blue-900">Tips Penjualan</h3>
                </div>
                <ul class="space-y-3 text-sm text-blue-800">
                    <li class="flex items-start">
                        <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        Gunakan nama produk yang singkat tapi jelas (Formula: Merk + Jenis + Varian).
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        Foto yang terang dan bersih meningkatkan peluang terjual hingga 3x lipat.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        Pastikan stok selalu update agar pembeli tidak kecewa.
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const placeholder = document.getElementById('upload-placeholder');
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        const input = document.getElementById('gambar');
        const placeholder = document.getElementById('upload-placeholder');
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('preview');

        input.value = '';
        preview.src = '#';
        placeholder.classList.remove('hidden');
        previewContainer.classList.add('hidden');
    }
</script>
@endsection