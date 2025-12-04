@extends('layouts.store')
@section('title', 'Tentang Kami - FANES.GO')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
    <div class="bg-gradient-to-r from-green-600 to-green-700 p-12 text-center text-white">
        <h1 class="text-4xl font-bold mb-4">Tentang FANES.GO</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto">Platform marketplace kebanggaan Bengkalis untuk mendukung UMKM Lokal Go Digital.</p>
    </div>

    <div class="p-10 space-y-10">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Misi Kami</h2>
            <p class="text-gray-600 leading-relaxed text-lg">
                Kami hadir untuk menjembatani kesenjangan antara produsen lokal berkualitas tinggi dengan pasar yang lebih luas. Melalui teknologi, kami memberdayakan UMKM di Bengkalis agar dapat bersaing di era digital.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-green-50 rounded-xl hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow-sm mx-auto mb-4">🚀</div>
                <h3 class="font-bold text-gray-800 text-lg">Inovasi</h3>
                <p class="text-sm text-gray-600 mt-2">Membawa solusi digital modern untuk perdagangan tradisional.</p>
            </div>
            <div class="text-center p-6 bg-green-50 rounded-xl hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow-sm mx-auto mb-4">🤝</div>
                <h3 class="font-bold text-gray-800 text-lg">Komunitas</h3>
                <p class="text-sm text-gray-600 mt-2">Tumbuh bersama pedagang dan pembeli dalam satu ekosistem.</p>
            </div>
            <div class="text-center p-6 bg-green-50 rounded-xl hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow-sm mx-auto mb-4">🛡️</div>
                <h3 class="font-bold text-gray-800 text-lg">Terpercaya</h3>
                <p class="text-sm text-gray-600 mt-2">Jaminan keamanan dan kualitas dalam setiap transaksi.</p>
            </div>
        </div>
    </div>
</div>
@endsection