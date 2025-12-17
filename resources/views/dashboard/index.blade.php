@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<!-- HEADER -->
<div class="bg-green-600 text-white rounded-xl p-6 mb-6 shadow
            flex flex-col md:flex-row md:items-center md:justify-between">

    <div>
        <h1 class="text-xl font-bold">
            Selamat Datang, Admin FANES.GO 👋
        </h1>
        <p class="text-sm opacity-90">
            Kelola produk dan akun admin FANES.GO dengan mudah.
        </p>
    </div>

    <!-- TANGGAL HARI INI -->
    <div class="mt-4 md:mt-0">
        <span class="inline-flex items-center gap-2 bg-white/20 px-4 py-2 rounded-lg text-sm">
            📅 {{ now()->translatedFormat('d F Y') }}
        </span>
    </div>

</div>


<!-- STAT CARDS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

    <div class="bg-white rounded-xl p-4 shadow hover:shadow-md transition">
        <p class="text-sm text-gray-500">Total Produk</p>
        <h2 class="text-2xl font-bold text-green-600">
            {{ \App\Models\Produk::count() }}
        </h2>
    </div>

</div>

<!-- QUICK ACTION -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">

    <a href="{{ route('produk.index') }}"
       class="bg-green-50 border border-green-200 rounded-xl p-5 hover:shadow transition">
        <h3 class="font-bold text-green-700">📦 Produk</h3>
        <p class="text-sm text-green-600">Kelola semua produk</p>
    </a>

    <a href="{{ route('produk.create') }}"
       class="bg-blue-50 border border-blue-200 rounded-xl p-5 hover:shadow transition">
        <h3 class="font-bold text-blue-700">➕ Tambah Produk</h3>
        <p class="text-sm text-blue-600">Masukkan produk baru</p>
    </a>

    <a href="{{ route('profile.show') }}"
       class="bg-gray-50 border border-gray-200 rounded-xl p-5 hover:shadow transition">
        <h3 class="font-bold text-gray-700">⚙️ Pengaturan Akun</h3>
        <p class="text-sm text-gray-600">Profil & keamanan</p>
    </a>

</div>

<!-- FOOTER -->
<footer class="mt-16 text-center text-sm text-gray-400">
    © {{ date('Y') }} <span class="font-semibold text-gray-500">FANES.GO</span>.
    All rights reserved.
</footer>

@endsection
