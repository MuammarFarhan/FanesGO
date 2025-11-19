@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
    <div class="bg-white shadow-xl rounded-xl p-6 transform hover:scale-[1.02] transition duration-300 ease-in-out border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-500 uppercase tracking-wider">Total User</h2>
            <svg class="h-8 w-8 text-green-500 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </div>
        <p class="text-4xl font-extrabold mt-3 text-gray-800">2</p>
    </div>

    <div class="bg-white shadow-xl rounded-xl p-6 transform hover:scale-[1.02] transition duration-300 ease-in-out border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-500 uppercase tracking-wider">Guk</h2>
            <svg class="h-8 w-8 text-blue-500 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm-6-4a3 3 0 100-6 3 3 0 000 6zm6-8a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <p class="text-4xl font-extrabold mt-3 text-gray-800">Miaw</p>
    </div>

    <div class="bg-white shadow-xl rounded-xl p-6 transform hover:scale-[1.02] transition duration-300 ease-in-out border-l-4 border-orange-500">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-500 uppercase tracking-wider">Slurp</h2>
            <svg class="h-8 w-8 text-orange-500 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6m11 0V5a2 2 0 00-2-2h-2a2 2 0 00-2 2v14m8 0V11a2 2 0 00-2-2h-2a2 2 0 00-2 2v8" />
            </svg>
        </div>
        <p class="text-4xl font-extrabold mt-3 text-gray-800">Rawr</p>
    </div>
</div>

<div class="bg-white shadow-xl rounded-xl p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-700">Riwayat <span class="text-green-500">Login</span></h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Login</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-green-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nabila</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Pelanggan</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-09-08</td>
                </tr>
                <tr class="bg-gray-50 hover:bg-green-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Aisyah</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Pelanggan</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-09-07</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection