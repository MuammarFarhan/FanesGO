@extends('layouts.store')
@section('title', 'Profil Saya')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6 sm:p-8">
        
        <div class="mb-6 border-b border-gray-200 pb-4">
            <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi akun dan foto profil Anda.</p>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100"
                       readonly />
                <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
                <div class="flex items-center space-x-6 mt-2">
                    @if ($user->file)
                        <img src="{{ $user->file->file_stream }}"
                             alt="Foto Profil"
                             class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                           <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                             <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                           </svg>
                        </div>
                    @endif

                    <div class="flex-1">
                        <input type="file" name="profile"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG. Max 2MB</p>
                        @error('profile')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        
                        @if ($user->file)
                            <a href="{{ $user->file->file_download }}"
                               class="inline-block mt-2 text-sm text-green-600 hover:underline">
                                Unduh Foto Saat Ini
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-200">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection