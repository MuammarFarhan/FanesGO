@extends('layouts.dashboard')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="max-w-3xl space-y-10">

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- PROFIL --}}
    <div class="bg-white rounded-xl p-6 shadow">
        <h2 class="font-bold text-lg mb-4">Profil Admin</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="flex items-center gap-4">
                <img
                    src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.$user->name }}"
                    class="w-20 h-20 rounded-full object-cover"
                >
                <input type="file" name="avatar">
            </div>

            <input name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2">
            <input name="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2">

            <button class="bg-green-600 text-white px-5 py-2 rounded">
                Simpan Profil
            </button>
        </form>
    </div>

    {{-- PASSWORD --}}
    <div class="bg-white rounded-xl p-6 shadow">
        <h2 class="font-bold text-lg mb-4">Ganti Password</h2>

        <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
            @csrf

            <input type="password" name="current_password" placeholder="Password Saat Ini"
                   class="w-full border rounded px-3 py-2">

            <input type="password" name="password" placeholder="Password Baru"
                   class="w-full border rounded px-3 py-2">

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                   class="w-full border rounded px-3 py-2">

            <button class="bg-blue-600 text-white px-5 py-2 rounded">
                Ganti Password
            </button>
        </form>
    </div>

</div>
@endsection
