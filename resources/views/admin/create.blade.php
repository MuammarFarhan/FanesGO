@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-xl font-bold mb-6">Buat Admin Baru</h1>

    <form method="POST" action="{{ route('admin.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input name="name" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input name="email" type="email" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input name="password" type="password" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-6">
            <label class="block mb-1">Konfirmasi Password</label>
            <input name="password_confirmation" type="password" required class="w-full border rounded px-3 py-2">
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700">
            Simpan Admin
        </button>

    </form>
</div>
@endsection
