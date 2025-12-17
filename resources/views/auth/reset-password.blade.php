@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="max-w-md mx-auto mt-20 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Reset Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $email ?? old('email') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <button class="w-full bg-green-600 text-white py-2 rounded">
            Reset Password
        </button>
    </form>
</div>
@endsection
