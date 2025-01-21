<div class="flex items-center justify-between">
    <div class="flex items-center gap-4">
        <div class="relative">
            <button onclick="toggleFilterDropdown('timeDropdown')" class="flex items-center gap-2 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50">
                <i class="far fa-calendar"></i>
                <span>
                    @switch(request('period', '6m'))
                        @case('7d')
                            Last 7 Days
                            @break
                        @case('30d')
                            Last 30 Days
                            @break
                        @case('3m')
                            Last 3 Month
                            @break
                        @case('1y')
                            Last 1 Year
                            @break
                        @default
                            Last 6 Month
                    @endswitch
                </span>
                <i class="fas fa-chevron-down text-sm"></i>
            </button>
            <div id="timeDropdown" class="hidden absolute z-10 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 transform origin-top transition-all duration-200 opacity-0 scale-95">
                <div class="">
                    <a href="{{ route('dashboard', ['period' => '7d']) }}" class="block px-4 py-2 hover:bg-gray-100 {{ request('period') === '7d' ? 'bg-blue-50 text-blue-600' : '' }}">Last 7 Days</a>
                    <a href="{{ route('dashboard', ['period' => '30d']) }}" class="block px-4 py-2 hover:bg-gray-100 {{ request('period') === '30d' ? 'bg-blue-50 text-blue-600' : '' }}">Last 30 Days</a>
                    <a href="{{ route('dashboard', ['period' => '3m']) }}" class="block px-4 py-2 hover:bg-gray-100 {{ request('period') === '3m' ? 'bg-blue-50 text-blue-600' : '' }}">Last 3 Month</a>
                    <a href="{{ route('dashboard', ['period' => '6m']) }}" class="block px-4 py-2 hover:bg-gray-100 {{ request('period', '6m') === '6m' ? 'bg-blue-50 text-blue-600' : '' }}">Last 6 Month</a>
                    <a href="{{ route('dashboard', ['period' => '1y']) }}" class="block px-4 py-2 hover:bg-gray-100 {{ request('period') === '1y' ? 'bg-blue-50 text-blue-600' : '' }}">Last 1 Year</a>
                </div>
            </div>
        </div>

        <div class="relative">
            <button onclick="toggleFilterDropdown('storeDropdown')" class="flex items-center gap-2 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50">
                <i class="fas fa-store"></i>
                <span>Select Store</span>
                <i class="fas fa-chevron-down text-sm"></i>
            </button>
            <div id="storeDropdown" class="hidden absolute z-10 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 transform origin-top transition-all duration-200 opacity-0 scale-95">
                <div class="">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 bg-blue-50 text-blue-600">All Data</a>
                    <div class="px-4 py-2 text-sm text-gray-500">Filter by:</div>
                    <div class="px-4 py-1 text-sm font-medium">Kategori Produk</div>
                    <a href="#" class="block px-6 py-2 hover:bg-gray-100">HP</a>
                    <a href="#" class="block px-6 py-2 hover:bg-gray-100">Laptop</a>
                    <a href="#" class="block px-6 py-2 hover:bg-gray-100">Tablet</a>
                    <a href="#" class="block px-6 py-2 hover:bg-gray-100">Aksesoris</a>
                    <div class="px-4 py-1 text-sm font-medium">Supplier</div>
                    <a href="#" class="block px-6 py-2 hover:bg-gray-100">List supplier...</a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <button class="flex items-center gap-2 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50">
            <i class="fas fa-sync-alt"></i>
            <span>Refresh</span>
        </button>
        <button class="flex items-center gap-2 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50">
            <i class="fas fa-sliders-h"></i>
            <span>Customize</span>
        </button>
        <button class="flex items-center gap-2 bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-lg hover:from-blue-800 hover:to-blue-950">
            <i class="fas fa-download"></i>
            <span>Download</span>
        </button>
    </div>
</div>

<script>
function toggleFilterDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    const allDropdowns = document.querySelectorAll('[id$="Dropdown"]');
    
    // Hide semua dropdown lain
    allDropdowns.forEach(d => {
        if (d.id !== dropdownId) {
            d.classList.add('hidden');
            d.classList.remove('opacity-100', 'scale-100');
            d.classList.add('opacity-0', 'scale-95');
        }
    });
    
    // Toggle dropdown yang diklik
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        setTimeout(() => {
            dropdown.classList.remove('opacity-0', 'scale-95');
            dropdown.classList.add('opacity-100', 'scale-100');
        }, 10);
    } else {
        dropdown.classList.remove('opacity-100', 'scale-100');
        dropdown.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            dropdown.classList.add('hidden');
        }, 200);
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.relative')) {
        const allDropdowns = document.querySelectorAll('[id$="Dropdown"]');
        allDropdowns.forEach(d => {
            d.classList.remove('opacity-100', 'scale-100');
            d.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                d.classList.add('hidden');
            }, 200);
        });
    }
});
</script>