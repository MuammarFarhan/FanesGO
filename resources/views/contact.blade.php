@extends('layouts.store')
@section('title', 'Hubungi Kami - FANES.GO')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800">Hubungi Kami</h1>
        <p class="text-gray-600 mt-2">Punya pertanyaan? Tim support kami siap membantu Anda 24/7.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 items-start">
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="w-1 h-6 bg-green-600 rounded-full mr-3"></span>
                Informasi Kontak
            </h3>

            <div class="space-y-6">
                <div class="flex items-start p-4 hover:bg-green-50 rounded-xl transition-colors">
                    <div class="bg-green-100 p-3 rounded-full text-green-600 mr-4 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Alamat Kantor</h4>
                        <p class="text-gray-600 text-sm mt-1">Bengkalis, Riau, Indonesia</p>
                    </div>
                </div>

                <div class="flex items-start p-4 hover:bg-green-50 rounded-xl transition-colors">
                    <div class="bg-green-100 p-3 rounded-full text-green-600 mr-4 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Telepon / WhatsApp</h4>
                        <p class="text-gray-600 text-sm mt-1">+62 895-3239-32558</p>
                    </div>
                </div>

                <div class="flex items-start p-4 hover:bg-green-50 rounded-xl transition-colors">
                    <div class="bg-green-100 p-3 rounded-full text-green-600 mr-4 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Email</h4>
                        <p class="text-gray-600 text-sm mt-1">support@fanes.go</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="w-1 h-6 bg-green-600 rounded-full mr-3"></span>
                Kirim Pesan
            </h3>
            <form action="#" method="POST" onsubmit="alert('Fitur ini hanya demo.'); return false;">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition-all" placeholder="Nama Anda">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition-all" placeholder="email@contoh.com">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Pesan</label>
                    <textarea class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition-all h-32 resize-none" placeholder="Tulis pesan Anda disini..."></textarea>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection