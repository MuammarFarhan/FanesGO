@extends('layouts.app')
@section('title', 'Analytics Dashboard')
@section('page-title', 'Dashboard Analytics')

@section('content')
<!-- Header -->
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Analytics</h1>
            <p class="text-gray-600">Pantau performa toko Anda secara real-time</p>
        </div>
        <div class="flex items-center gap-3">
            <form method="GET" action="{{ route('analytics.index') }}">
                <select name="range" onchange="this.form.submit()" class="px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-green-500 focus:outline-none font-semibold">
                    <option value="7days" {{ $dateRange === '7days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="30days" {{ $dateRange === '30days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                    <option value="90days" {{ $dateRange === '90days' ? 'selected' : '' }}>90 Hari Terakhir</option>
                    <option value="1year" {{ $dateRange === '1year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                </select>
            </form>
            <a href="{{ route('analytics.export', ['range' => $dateRange]) }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2 transition-colors shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export
            </a>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    {{-- Revenue --}}
    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-green-500 to-green-600">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="flex items-center gap-1 text-sm font-semibold px-3 py-1 rounded-full {{ $stats['revenue']['trend'] === 'up' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                @if($stats['revenue']['trend'] === 'up')
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                @else
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                @endif
                {{ number_format($stats['revenue']['change'], 1) }}%
            </div>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Pendapatan</h3>
        <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($stats['revenue']['current'], 0, ',', '.') }}</p>
        <p class="text-xs text-gray-500 mt-2">vs periode sebelumnya</p>
    </div>

    {{-- Orders --}}
    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-600">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div class="flex items-center gap-1 text-sm font-semibold px-3 py-1 rounded-full {{ $stats['orders']['trend'] === 'up' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $stats['orders']['trend'] === 'up' ? '↑' : '↓' }} {{ number_format($stats['orders']['change'], 1) }}%
            </div>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Pesanan</h3>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['orders']['current']) }}</p>
        <p class="text-xs text-gray-500 mt-2">vs periode sebelumnya</p>
    </div>

    {{-- Products --}}
    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-purple-500 to-purple-600">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="flex items-center gap-1 text-sm font-semibold px-3 py-1 rounded-full {{ $stats['products']['trend'] === 'up' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $stats['products']['trend'] === 'up' ? '↑' : '↓' }} {{ number_format($stats['products']['change'], 1) }}%
            </div>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Produk Aktif</h3>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['products']['current']) }}</p>
        <p class="text-xs text-gray-500 mt-2">vs periode sebelumnya</p>
    </div>

    {{-- Customers --}}
    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-orange-500 to-orange-600">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div class="flex items-center gap-1 text-sm font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">
                ↑ {{ number_format($stats['customers']['change'], 1) }}%
            </div>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Pelanggan</h3>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['customers']['current']) }}</p>
        <p class="text-xs text-gray-500 mt-2">vs periode sebelumnya</p>
    </div>

    {{-- Rating --}}
    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-yellow-500 to-yellow-600">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
            <div class="flex items-center gap-1 text-sm font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">
                ↑ {{ number_format($stats['rating']['change'], 1) }}%
            </div>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Rating Toko</h3>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['rating']['current'], 1) }} / 5.0</p>
        <p class="text-xs text-gray-500 mt-2">vs periode sebelumnya</p>
    </div>

    {{-- Views --}}
    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-pink-500 to-pink-600">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
            <div class="flex items-center gap-1 text-sm font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">
                ↑ {{ number_format($stats['views']['change'], 1) }}%
            </div>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Views</h3>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['views']['current']) }}</p>
        <p class="text-xs text-gray-500 mt-2">vs periode sebelumnya</p>
    </div>
</div>

<!-- Sales Chart (Simplified - use Chart.js for production) -->
<div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Grafik Penjualan</h2>
    <p class="text-gray-600 text-sm mb-4">Penjualan {{ $salesData->count() }} hari terakhir</p>
    
    <div class="h-64 flex items-end justify-between gap-2">
        @php $maxSales = $salesData->max('sales') ?: 1; @endphp
        @foreach($salesData as $data)
        <div class="flex-1 flex flex-col items-center group">
            <div class="relative w-full">
                <div class="w-full bg-gradient-to-t from-green-600 to-green-400 rounded-t-lg transition-all hover:from-green-500 hover:to-green-300 cursor-pointer"
                     style="height: {{ ($data['sales'] / $maxSales) * 200 }}px">
                </div>
            </div>
            <span class="text-xs text-gray-600 font-medium mt-2">{{ $data['date'] }}</span>
        </div>
        @endforeach
    </div>
</div>

<!-- Top Products -->
<div class="bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Produk Terlaris</h2>
    <div class="space-y-4">
        @forelse($topProducts as $index => $product)
        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
            <div class="flex-shrink-0 w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">
                {{ $index + 1 }}
            </div>
            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-16 h-16 object-cover rounded-lg">
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-gray-800 truncate">{{ $product['name'] }}</h3>
                <p class="text-sm text-gray-600">Terjual: {{ $product['sold'] }}</p>
            </div>
            <div class="text-right">
                <p class="font-bold text-green-600">Rp {{ number_format($product['revenue'], 0, ',', '.') }}</p>
                <p class="text-xs text-gray-500">Stok: {{ $product['stock'] }}</p>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 py-8">Belum ada data penjualan</p>
        @endforelse
    </div>
</div>
@endsection