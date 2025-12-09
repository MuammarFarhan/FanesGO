@extends('layouts.app')
@section('title', 'Pesanan Masuk')
@section('page-title', 'Pesanan Masuk')

@section('content')
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-green-50 text-green-800 font-semibold border-b border-green-100">
                <tr>
                    <th class="px-6 py-4">Produk</th>
                    <th class="px-6 py-4">Pembeli</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($transaksis as $trx)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900">{{ $trx->produk->nama_produk }}</div>
                        <div class="text-xs text-gray-500">Jumlah: {{ $trx->jumlah }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $trx->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $trx->user->no_hp ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 font-bold text-green-600">
                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $trx->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $trx->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $trx->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('pesanan.update', $trx->id) }}" method="POST" class="flex gap-2">
                            @csrf @method('PATCH')
                            @if($trx->status == 'pending')
                            <button name="status" value="diproses" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">Proses</button>
                            @elseif($trx->status == 'diproses')
                            <button name="status" value="selesai" class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">Selesai</button>
                            @else
                            <span class="text-gray-400 text-xs">Selesai</span>
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection