<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-4 flex-1">
        <!-- Search Bar -->
        <div class="relative flex-1 max-w-md">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input 
                type="text" 
                name="search" 
                placeholder="Cari nama produk..."
                x-model="search"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
            >
        </div> 

        <!-- Filter Kategori -->
        <div class="relative" x-data="{ open: false }">
            <button 
                @click="open = !open"
                class="px-4 py-2 border border-gray-300 rounded-lg flex items-center gap-2 hover:bg-gray-50"
            >
                <i class="fas fa-tag text-gray-400"></i>
                <span class="text-gray-700">Kategori</span>
                <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
            </button>
            <div 
                x-show="open" 
                @click.away="open = false"
                class="absolute z-10 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200"
            >
                <div class="p-2">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">HP</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">Laptop</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">Tablet</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">Aksesoris</a>
                </div>
            </div>
        </div>

        <!-- Filter Supplier -->
        <div class="relative" x-data="{ open: false }">
            <button 
                @click="open = !open"
                class="px-4 py-2 border border-gray-300 rounded-lg flex items-center gap-2 hover:bg-gray-50"
            >
                <i class="fas fa-building text-gray-400"></i>
                <span class="text-gray-700">Supplier</span>
                <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
            </button>
            <div 
                x-show="open" 
                @click.away="open = false"
                class="absolute z-10 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200"
            >
                <div class="p-2">
                    <template x-for="supplier in suppliers" :key="supplier.id_supplier">
                        <a 
                            href="#" 
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"
                            x-text="supplier.nama_supplier"
                        ></a>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <div>
        <button 
            @click="showAddModal = true"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg flex items-center gap-2 hover:bg-blue-700"
        >
            <i class="fas fa-plus"></i>
            <span>Tambah Produk</span>
        </button>
    </div>
</div>