@extends('layouts.store')
@section('title', 'Tentang Kami - FANES.GO')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-12 text-center text-white mb-16">
        <h1 class="text-4xl font-bold mb-4">Tentang FANES.GO</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto">
            Platform marketplace kebanggaan Bengkalis untuk mendukung UMKM Lokal Go Digital.
        </p>
    </div>

    {{-- MISI --}}
    <div class="text-center max-w-3xl mx-auto mb-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Misi Kami</h2>
        <p class="text-gray-600 leading-relaxed text-lg">
            Kami hadir untuk menjembatani kesenjangan antara produsen lokal berkualitas tinggi
            dengan pasar yang lebih luas. Melalui teknologi, kami memberdayakan UMKM di Bengkalis
            agar dapat bersaing di era digital.
        </p>
    </div>

    {{-- NILAI --}}
    <div class="grid md:grid-cols-3 gap-8 mb-24">
        <div class="text-center p-6 bg-green-50 rounded-xl hover:shadow-md transition">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow mx-auto mb-4">🚀</div>
            <h3 class="font-bold text-gray-800 text-lg">Inovasi</h3>
            <p class="text-sm text-gray-600 mt-2">
                Membawa solusi digital modern untuk perdagangan tradisional.
            </p>
        </div>

        <div class="text-center p-6 bg-green-50 rounded-xl hover:shadow-md transition">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow mx-auto mb-4">🤝</div>
            <h3 class="font-bold text-gray-800 text-lg">Komunitas</h3>
            <p class="text-sm text-gray-600 mt-2">
                Tumbuh bersama pedagang dan pembeli dalam satu ekosistem.
            </p>
        </div>

        <div class="text-center p-6 bg-green-50 rounded-xl hover:shadow-md transition">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow mx-auto mb-4">🛡️</div>
            <h3 class="font-bold text-gray-800 text-lg">Terpercaya</h3>
            <p class="text-sm text-gray-600 mt-2">
                Jaminan keamanan dan kualitas dalam setiap transaksi.
            </p>
        </div>
    </div>

    {{-- TIM PENGEMBANG --}}
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">
            Tim Pengembang
        </h2>
        <p class="text-gray-600">
            Di balik pengembangan FANES.GO
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-10">

        {{-- TIM 1 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6 text-center">
            <img src="{{ asset('images/tim/foto1.jpg') }}"
                 alt="Nama"
                 class="w-40 h-40 object-cover rounded-xl mx-auto mb-4">

            <h3 class="font-bold text-lg text-gray-800">
                Muammar Farhan
            </h3>
            <p class="text-sm text-green-600 font-medium">
                Fullstack Developer
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Backend, Frontend & Integrasi Sistem
            </p>
        </div>

        {{-- TIM 2 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6 text-center">
            <img src="{{ asset('images/tim/foto2.jpg') }}"
                 alt="Nama"
                 class="w-40 h-40 object-cover rounded-xl mx-auto mb-4">

            <h3 class="font-bold text-lg text-gray-800">
                Siti Aisyah
            </h3>
            <p class="text-sm text-green-600 font-medium">
                UI / UX Designer
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Desain Antarmuka & Pengalaman Pengguna
            </p>
        </div>

        {{-- TIM 3 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6 text-center">
            <img src="{{ asset('images/tim/foto3.jpg') }}"
                 alt="Nama"
                 class="w-40 h-40 object-cover rounded-xl mx-auto mb-4">

            <h3 class="font-bold text-lg text-gray-800">
                Putri Nabila
            </h3>
            <p class="text-sm text-green-600 font-medium">
                Dokumentasi & Konten
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Dokumentasi Sistem & Penulisan Laporan
            </p>
        </div>

    </div>

</div>
@endsection
