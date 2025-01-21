<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 mt-4">
    <!-- Card Total Produk -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Total Produk</div>
                    <div class="text-2xl font-semibold">{{ $totalProduk }}</div>
                </div>
                <div class="rounded-lg bg-blue-50 p-3">
                    <i class="fas fa-box text-blue-500"></i>
                </div>
            </div>
            <div class="flex items-center gap-1 mt-3">
                @if($persentaseProduk > 0)
                    <i class="fas fa-arrow-up text-emerald-500 text-sm"></i>
                    <div class="text-emerald-500 text-sm">{{ number_format($persentaseProduk, 1) }}%</div>
                @elseif($persentaseProduk < 0)
                    <i class="fas fa-arrow-down text-red-500 text-sm"></i>
                    <div class="text-red-500 text-sm">{{ number_format(abs($persentaseProduk), 1) }}%</div>
                @else
                    <i class="fas fa-minus text-gray-500 text-sm"></i>
                    <div class="text-gray-500 text-sm">0%</div>
                @endif
                <div class="text-gray-500 text-sm">vs periode sebelumnya</div>
            </div>
        </div>
    </div>

        <!-- Card Total Penjualan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-sm text-gray-500 mb-1">Total Penjualan</div>
                        <div class="text-2xl font-semibold">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
                    </div>
                    <div class="rounded-lg bg-rose-50 p-3">
                        <i class="fas fa-chart-line text-rose-500"></i>
                    </div>
                </div>
                <div class="flex items-center gap-1 mt-3">
                    @if($persentasePenjualan > 0)
                        <i class="fas fa-arrow-up text-emerald-500 text-sm"></i>
                        <div class="text-emerald-500 text-sm">{{ number_format($persentasePenjualan, 1) }}%</div>
                    @elseif($persentasePenjualan < 0)
                        <i class="fas fa-arrow-down text-red-500 text-sm"></i>
                        <div class="text-red-500 text-sm">{{ number_format(abs($persentasePenjualan), 1) }}%</div>
                    @else
                        <i class="fas fa-minus text-gray-500 text-sm"></i>
                        <div class="text-gray-500 text-sm">0%</div>
                    @endif
                    <div class="text-gray-500 text-sm">vs periode sebelumnya</div>
                </div>
            </div>
        </div>

    <!-- Card Total Supplier -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Total Supplier</div>
                    <div class="text-2xl font-semibold">{{ $totalSupplier }}</div>
                </div>
                <div class="rounded-lg bg-indigo-50 p-3">
                    <i class="fas fa-building text-indigo-500"></i>
                </div>
            </div>
            <div class="flex items-center gap-1 mt-3">
                @if($persentaseSupplier > 0)
                    <i class="fas fa-arrow-up text-emerald-500 text-sm"></i>
                    <div class="text-emerald-500 text-sm">{{ number_format($persentaseSupplier, 1) }}%</div>
                @elseif($persentaseSupplier < 0)
                    <i class="fas fa-arrow-down text-red-500 text-sm"></i>
                    <div class="text-red-500 text-sm">{{ number_format(abs($persentaseSupplier), 1) }}%</div>
                @else
                    <i class="fas fa-minus text-gray-500 text-sm"></i>
                    <div class="text-gray-500 text-sm">0%</div>
                @endif
                <div class="text-gray-500 text-sm">vs periode sebelumnya</div>
            </div>
        </div>
    </div>
</div>