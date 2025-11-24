@extends('layouts.auth')

@section('content')
<div class="glass-card w-full max-w-lg rounded-3xl p-8 sm:p-12 relative overflow-hidden">
    
    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500"></div>

    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2 tracking-tight">Selamat Datang</h1>
        <p class="text-gray-500 text-sm">Masuk untuk mengakses akun Anda</p>
    </div>

    @if (session('success'))
    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm flex items-center gap-3 shadow-sm">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2 ml-1">Email Address</label>
            <input type="email" name="email" placeholder="nama@email.com"
                class="modern-input w-full px-5 py-3.5 rounded-xl text-gray-700 placeholder-gray-400 focus:ring-4 focus:ring-emerald-500/20 @error('email') border-red-500 @enderror"
                value="{{ old('email') }}" required>
            @error('email')
            <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex justify-between items-center mb-2 ml-1">
                <label class="block text-gray-700 text-sm font-bold">Password</label>
                <a href="#" class="text-sm text-emerald-600 hover:text-emerald-800 font-semibold hover:underline transition-colors">Lupa Password?</a>
            </div>
            <input type="password" name="password" placeholder="••••••••"
                class="modern-input w-full px-5 py-3.5 rounded-xl text-gray-700 placeholder-gray-400 focus:ring-4 focus:ring-emerald-500/20 @error('password') border-red-500 @enderror" required>
            @error('password')
            <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-lg py-3.5 rounded-xl shadow-lg shadow-emerald-500/30 transition-all duration-300 transform hover:-translate-y-1">
                Masuk Sekarang
            </button>
        </div>
    </form>

    <div class="mt-8 text-center border-t border-gray-100 pt-6">
        <p class="text-gray-600 text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-emerald-600 font-bold hover:text-emerald-800 transition-colors ml-1 hover:underline decoration-2 underline-offset-2">Daftar disini</a>
        </p>
    </div>
</div>
@endsection