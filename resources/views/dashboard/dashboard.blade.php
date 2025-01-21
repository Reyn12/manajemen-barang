@extends('master')

@section('title', 'Dashboard')

@section('content')
    <!-- Isi konten disini -->
    <div class="flex">
        @include('dashboard.components.sidebar')
        
        <div class="ml-64 flex-1 p-8">
            <div class="grid grid-cols-3 gap-6 mb-8">
                <!-- Card Total Supplier -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-gray-500 text-sm">Total Supplier</h3>
                    <p class="text-2xl font-bold">{{ $totalSupplier }}</p>
                </div>
                
                <!-- Card Total Produk -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-gray-500 text-sm">Total Produk</h3>
                    <p class="text-2xl font-bold">{{ $totalProduk }}</p>
                </div>
                
                <!-- Card Total Transaksi -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-gray-500 text-sm">Total Transaksi</h3>
                    <p class="text-2xl font-bold">{{ $totalTransaksi }}</p>
                </div>
            </div>
    
            <!-- Tabel Transaksi Terbaru -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">Transaksi Terbaru</h2>
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-3">Produk</th>
                                <th class="pb-3">Jumlah</th>
                                <th class="pb-3">Total</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransaksi as $transaksi)
                            <tr class="border-b">
                                <td class="py-3">{{ $transaksi->produk->nama_produk }}</td>
                                <td class="py-3">{{ $transaksi->jumlah }}</td>
                                <td class="py-3">Rp {{ number_format($transaksi->total_harga) }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-sm 
                                        {{ $transaksi->status_bayar == 'Sukses' ? 'bg-green-100 text-green-800' : 
                                           ($transaksi->status_bayar == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $transaksi->status_bayar }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- CSS tambahan -->
@endpush

@push('scripts')
    <!-- JavaScript tambahan -->
@endpush