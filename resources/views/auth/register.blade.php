@extends('layouts.auth')

@section('content')
<div class="glass-card w-full max-w-lg rounded-3xl p-8 sm:p-12 relative overflow-hidden">
    
    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-lime-500 to-emerald-600"></div>

    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2 tracking-tight">Bergabung Bersama Kami</h1>
        <p class="text-gray-500 text-sm">Nikmati layanan terbaik dengan citarasa spesial</p>
    </div>

    <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2 ml-1">Nama Lengkap</label>
            <input type="text" name="name" placeholder="Nama Anda"
                class="modern-input w-full px-5 py-3.5 rounded-xl text-gray-700 placeholder-gray-400 focus:ring-4 focus:ring-emerald-500/20 @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2 ml-1">Alamat Email</label>
            <input type="email" name="email" placeholder="nama@email.com"
                class="modern-input w-full px-5 py-3.5 rounded-xl text-gray-700 placeholder-gray-400 focus:ring-4 focus:ring-emerald-500/20 @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2 ml-1">Password</label>
            <input type="password" name="password" placeholder="Min. 8 karakter"
                class="modern-input w-full px-5 py-3.5 rounded-xl text-gray-700 placeholder-gray-400 focus:ring-4 focus:ring-emerald-500/20 @error('password') border-red-500 @enderror" required>
            @error('password') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p> @enderror
        </div>
        
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2 ml-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Ketik ulang password"
                class="modern-input w-full px-5 py-3.5 rounded-xl text-gray-700 placeholder-gray-400 focus:ring-4 focus:ring-emerald-500/20" required>
        </div>

        <div class="pt-3">
            <button type="submit" class="w-full bg-gradient-to-r from-lime-600 to-emerald-600 hover:from-lime-700 hover:to-emerald-700 text-white font-bold text-lg py-3.5 rounded-xl shadow-lg shadow-emerald-500/30 transition-all duration-300 transform hover:-translate-y-1">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <div class="mt-8 text-center border-t border-gray-200 pt-6">
        <p class="text-gray-600 text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-emerald-600 font-bold hover:text-emerald-800 transition-colors ml-1 hover:underline">Login disini</a>
        </p>
    </div>
</div>
@endsection