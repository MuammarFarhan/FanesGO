@extends('layouts.app')
@section('title', 'Pengaturan Toko')
@section('page-title', 'Pengaturan Toko')

@section('content')
<div class="max-w-4xl">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')

            <!-- Foto Profil -->
            <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 pb-8 border-b border-gray-100">
                <div class="relative group">
                    <img src="{{ $user->file ? route('files.action', ['id' => $user->file->id, 'action' => 'stream']) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                         class="w-24 h-24 rounded-full border-4 border-green-100 object-cover shadow-sm">
                </div>
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil / Logo Toko</label>
                    <input type="file" name="profile" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-colors">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Toko -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Toko / Pengguna</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                </div>

                <!-- Nomor HP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" placeholder="08123456789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                </div>

                <!-- Email (Read Only) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" value="{{ $user->email }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap Toko</label>
                    <textarea name="alamat_toko" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all" placeholder="Jalan, Kecamatan, Kota...">{{ old('alamat_toko', $user->alamat_toko) }}</textarea>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat Toko</label>
                    <textarea name="deskripsi_toko" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all" placeholder="Toko oleh-oleh khas...">{{ old('deskripsi_toko', $user->deskripsi_toko) }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end pt-6 border-top border-gray-100">
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection