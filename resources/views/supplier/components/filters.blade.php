<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-4 flex-1">
        <!-- Search Bar -->
        <div class="relative flex-1 max-w-md">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input type="text" 
                placeholder="Cari berdasar nama/email..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
            >
        </div>

        <!-- Filter Dropdown -->
        <div class="relative">
            <button class="px-4 py-2 border border-gray-300 rounded-lg flex items-center gap-2 hover:bg-gray-50">
                <i class="fas fa-filter text-gray-400"></i>
                <span class="text-gray-700">Filters</span>
            </button>
        </div>
    </div>
 
    <!-- Tombol Tambah -->
    <div x-data> <!-- Tambahkan x-data di parent -->
        <button 
            @click="$dispatch('open-modal')"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg flex items-center gap-2 hover:bg-blue-700"
        >
            <i class="fas fa-plus"></i>
            <span>Tambah Supplier</span>
        </button>
    </div>
</div>