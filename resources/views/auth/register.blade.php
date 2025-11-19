@extends('layouts.auth')
@section('content')
<div class="bg-white shadow-lg rounded-xl p-6 space-y-4">
    <h1 class="text-2xl font-bold text-center">Register Akun</h1>

    <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
        @csrf
        <div>
            <input type="text" name="name" placeholder="Nama"
                class="border p-2 w-full rounded @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <input type="email" name="email" placeholder="Email"
                class="border p-2 w-full rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <input type="password" name="password" placeholder="Password (min. 8 karakter)"
                class="border p-2 w-full rounded @error('password') border-red-500 @enderror" required>
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="border p-2 w-full rounded" required>
        </div>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full">
            Daftar
        </button>
    </form>
    <p class="text-center text-sm">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
    </p>
</div>
@endsection