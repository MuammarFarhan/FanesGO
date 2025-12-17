@extends('layouts.dashboard')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="max-w-xl">

    <h1 class="text-2xl font-bold mb-6">Pengaturan Akun</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="text-sm font-semibold">Nama</label>
            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="text-sm font-semibold">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <button class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Simpan Perubahan
        </button>
    </form>

</div>
@endsection
