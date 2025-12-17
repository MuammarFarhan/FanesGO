@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md">
    <div class="glass-card rounded-2xl p-8">

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Lupa Password
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Masukkan email admin untuk reset password
            </p>
        </div>

        {{-- STATUS --}}
        @if (session('status'))
            <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg p-3">
                {{ session('status') }}
            </div>
        @endif

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 rounded-lg modern-input"
                       placeholder="admin@email.com">
            </div>

            <button type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-lg transition">
                Kirim Link Reset
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <a href="{{ route('login') }}"
               class="text-emerald-600 hover:underline">
                ← Kembali ke Login
            </a>
        </div>

    </div>
</div>
@endsection
