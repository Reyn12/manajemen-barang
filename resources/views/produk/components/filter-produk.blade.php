<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-4 flex-1">
        <!-- Search Bar -->
        <div class="relative flex-1 max-w-md">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input type="text" class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Cari produk...">
        </div>

        <!-- Filter Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="px-4 py-2 bg-white border border-gray-300 rounded-lg flex items-center gap-2">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
                <i class="fas fa-chevron-down text-sm"></i>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                <div class="p-2">
                    <label class="block text-sm text-gray-700 mb-2">Kategori</label>
                    <select class="w-full border border-gray-300 rounded-md p-1.5 text-sm">
                        <option value="">Semua</option>
                        <option value="hp">HP</option>
                        <option value="laptop">Laptop</option>
                        <option value="tablet">Tablet</option>
                        <option value="aksesoris">Aksesoris</option>
                    </select>
                </div>
                <div class="p-2 border-t">
                    <label class="block text-sm text-gray-700 mb-2">Supplier</label>
                    <select class="w-full border border-gray-300 rounded-md p-1.5 text-sm">
                        <option value="">Semua</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id_supplier }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <div x-data>
        <button 
            @click="$dispatch('open-modal')"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg flex items-center gap-2 hover:bg-blue-700"
        >
            <i class="fas fa-plus"></i>
            <span>Tambah Produk</span>
        </button>
    </div>
    @include('produk.components.tambah-produk')
</div>