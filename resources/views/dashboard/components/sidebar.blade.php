<div class="bg-[#f2f3f5] w-64 fixed left-5 top-5 shadow-xl rounded-xl bottom-5 ">
    <div class="relative">
        <div class="bg-white p-3 flex items-center gap-2 border-b m-2 rounded-xl mt-6 mx-4">
            <div class="bg-blue-500 w-8 h-8 rounded-lg flex items-center justify-center">
                <i class="fas fa-box text-white"></i>
            </div>
            <div>
                <h1 class="text-sm text-gray-800">Team</h1>
                <h2 class="text-base">Admin 1</h2>
            </div>
            <button class="ml-auto transition-transform duration-200" id="dropdownButton" onclick="toggleDropdown()">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
 
        <!-- Dropdown Menu -->
        <div id="adminDropdown" class="hidden opacity-0 transform -translate-y-2 absolute w-full px-2 transition-all duration-200">
            <div class="bg-white rounded-xl shadow-lg p-2 space-y-1">
                <a href="#" onclick="changeAdmin('Admin 1', 'blue-500')" class="flex items-center px-3 py-2 rounded-lg hover:bg-white transition-colors duration-150">
                    <div class="w-5 h-5 bg-blue-500 rounded mr-2"></div>
                    <span>Admin 1</span>
                </a>
                <a href="#" onclick="changeAdmin('Admin 2', 'indigo-500')" class="flex items-center px-3 py-2 rounded-lg hover:bg-white transition-colors duration-150">
                    <div class="w-5 h-5 bg-indigo-500 rounded mr-2"></div>
                    <span>Admin 2</span>
                </a>
                <a href="#" onclick="changeAdmin('Admin 3', 'orange-500')" class="flex items-center px-3 py-2 rounded-lg hover:bg-white transition-colors duration-150">
                    <div class="w-5 h-5 bg-orange-500 rounded mr-2"></div>
                    <span>Admin 3</span>
                </a>
                <a href="#" onclick="changeAdmin('Admin 4', 'purple-500')" class="flex items-center px-3 py-2 rounded-lg hover:bg-white transition-colors duration-150">
                    <div class="w-5 h-5 bg-purple-500 rounded mr-2"></div>
                    <span>Admin 4</span>
                </a>
                <div class="border-t my-1"></div>
                <a href="#" onclick="showAddNewTeam(event)" class="flex items-center px-3 py-2 rounded-lg hover:bg-white transition-colors duration-150 text-gray-600">
                    <div class="w-5 h-5 bg-gray-100 rounded mr-2 flex items-center justify-center">
                        <i class="fas fa-plus text-gray-400 text-xs"></i>
                    </div>
                    <span>Add New Team</span>
                </a>
            </div>
        </div>
    </div>
    
    <nav class="p-4">
        <span class="text-xs font-medium text-gray-400 block mb-3">MENU</span>
        <div class="space-y-3">
            <a href="{{ route('dashboard') }}" 
                class=" px-4 py-2 rounded-lg flex items-center justify-between {{ request()->routeIs('dashboard') ? 'bg-white text-blue-600' : 'text-gray-600 hover:bg-white' }}">
                <div class="flex items-center gap-2">
                    <i class="fas fa-asterisk w-5"></i>
                    <span>Dashboard</span>
                </div> 
                @if(request()->routeIs('dashboard'))
                    <i class="fas fa-chevron-right text-sm"></i>
                @endif
            </a> 
            <a href="{{ route('supplier') }}" 
                class=" px-4 py-2 rounded-lg flex items-center justify-between {{ request()->routeIs('supplier') ? 'bg-white text-blue-600' : 'text-gray-600 hover:bg-white' }}">
                <div class="flex items-center gap-2">
                    <i class="fas fa-user w-5"></i>
                    <span>Supplier</span>
                </div>
                @if(request()->routeIs('supplier'))
                    <i class="fas fa-chevron-right text-sm"></i>
                @endif
            </a> 
            <a href="{{ route('produk.produk') }}" 
                class=" px-4 py-2 rounded-lg flex items-center justify-between {{ request()->routeIs('produk.produk') ? 'bg-white text-blue-600' : 'text-gray-600 hover:bg-white' }}">
                <div class="flex items-center gap-2">
                    <i class="fas fa-box w-5"></i>
                    <span>Produk</span>
                </div>
                @if(request()->routeIs('produk.produk'))
                    <i class="fas fa-chevron-right text-sm"></i>
                @endif
            </a>
            <a href="{{ route('transaksi.index') }}" 
                class=" px-4 py-2 rounded-lg flex items-center justify-between {{ request()->routeIs('transaksi.index') ? 'bg-white text-blue-600' : 'text-gray-600 hover:bg-white' }}">
                <div class="flex items-center gap-2">
                    <i class="fas fa-exchange-alt w-5"></i>
                    <span>Transaksi</span>
                </div>
                @if(request()->routeIs('transaksi.index'))
                    <i class="fas fa-chevron-right text-sm"></i>
                @endif
            </a>
        </div>
    </nav>
</div>

@push('scripts')
<script>
function toggleDropdown() {
    const dropdown = document.getElementById('adminDropdown');
    const button = document.getElementById('dropdownButton');
    
    // Toggle rotate animation untuk arrow
    button.style.transform = button.style.transform === 'rotate(180deg)' ? 'rotate(0)' : 'rotate(180deg)';
    
    // Toggle dropdown dengan animasi
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        setTimeout(() => {
            dropdown.classList.remove('opacity-0', '-translate-y-2');
        }, 20);
    } else {
        dropdown.classList.add('opacity-0', '-translate-y-2');
        setTimeout(() => {
            dropdown.classList.add('hidden');
        }, 200);
    }
}

// Tutup dropdown ketika klik di luar
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('adminDropdown');
    const button = event.target.closest('button');
    const dropdownButton = document.getElementById('dropdownButton');
    
    if (!button && !dropdown.classList.contains('hidden')) {
        dropdown.classList.add('opacity-0', '-translate-y-2');
        dropdownButton.style.transform = 'rotate(0)';
        setTimeout(() => {
            dropdown.classList.add('hidden');
        }, 200);
    }
});

function changeAdmin(adminName, colorClass) {
    const adminTitle = document.querySelector('.text-base');
    const adminIcon = document.querySelector('.bg-blue-500');
    
    // Update text
    adminTitle.textContent = adminName;
    
    // Update warna
    adminIcon.classList.remove('bg-blue-500', 'bg-indigo-500', 'bg-orange-500', 'bg-purple-500');
    adminIcon.classList.add(`bg-${colorClass}`);
    
    // Tutup dropdown
    toggleDropdown();
}

function showAddNewTeam(event) {
    event.preventDefault();
    Swal.fire({
        icon: 'info',
        title: 'Informasi',
        text: 'Fitur Add New Team belum tersedia',
        confirmButtonColor: '#3085d6',
    });
    toggleDropdown();
}
</script>
@endpush