@push('styles')
<style>
    @keyframes modalShow {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .animate-modal-show {
        animation: modalShow 0.3s ease-out;
    }
</style>
@endpush
<div class="flex items-center justify-between mb-6">
    <div x-data="{
        showDownloadModal: false,
        downloadPDF() {
            window.location.href = '/transaksi/download/pdf';
            this.showDownloadModal = false;
        },
        downloadExcel() {
            window.location.href = '/transaksi/download/excel';
            this.showDownloadModal = false;
        }
    }" class="flex items-center gap-4 flex-1">
        <!-- Search Bar -->
        <form action="{{ route('transaksi.index') }}" method="GET">
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       class="w-full pl-10 pr-4 py-2 border rounded-lg focus:border-blue-300 focus:ring focus:ring-blue-200" 
                       placeholder="Cari transaksi...">
                <button type="submit" class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <i class="fas fa-search text-gray-400"></i>
                </button>
            </div>
        </form>

        <!-- Filter Dropdown -->
        <div class="relative">
            <button class="px-4 py-2 border border-gray-300 rounded-lg flex items-center gap-2 hover:bg-gray-50">
                <i class="fas fa-filter text-gray-400"></i>
                <span class="text-gray-700">Filters</span>
            </button>
        </div>

        <!-- Download Button -->
        <div class="" >
            <button type="button" @click="showDownloadModal = true" 
                class="flex items-center gap-2 bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-lg hover:from-blue-800 hover:to-blue-950">
                <i class="fas fa-download"></i>
                <span>Download</span>
            </button>
            @include('transaksi.components.modal-download')
        </div>
    </div>
 
    <!-- Tombol Tambah -->
    <div>
        <button 
            type="button"
            data-modal-target="tambahTransaksiModal" 
            data-modal-toggle="tambahTransaksiModal"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg flex items-center gap-2 hover:bg-blue-700"
        >
            <i class="fas fa-plus"></i>
            <span>Tambah Transaksi</span>
        </button>
    </div>
</div>

<!-- Modal Tambah Transaksi -->
<div id="tambahTransaksiModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-2xl" data-modal-backdrop="static">
    <div class="relative w-full max-w-5xl max-h-full animate-modal-show">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">
                    Tambah Transaksi
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="tambahTransaksiModal">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <!-- Modal body -->
            <form action="{{ route('transaksi.store') }}" method="POST" id="formTambahTransaksi">
                @csrf
                <div class="p-6">
                    <div class="flex gap-8">
                        <!-- Kolom Kiri - Gambar -->
                        <div class="w-1/3 flex items-center justify-center">
                            <img src="{{ asset('images/bgTambah2.png') }}" alt="Transaction Illustration" class="w-full max-w-md">
                        </div>

                        <!-- Kolom Kanan - Form -->
                        <div class="w-2/3">
                            <div class="grid grid-cols-2 gap-6">
                                <!-- Produk -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Produk</label>
                                    <select name="id_produk" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->id_produk }}">{{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tanggal Jual -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Jual</label>
                                    <input type="date" name="tgl_jual" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                </div>

                                <!-- Jumlah -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                    <input type="number" name="jumlah" min="1" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                </div>

                                <!-- Total Harga -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Harga</label>
                                    <input type="number" name="total_harga" min="0" required readonly
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-blue-500">
                                </div>

                                <!-- Status Bayar -->
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Bayar</label>
                                    <select name="status_bayar" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Sukses">Sukses</option>
                                        <option value="Gagal">Gagal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 border-t gap-4">
                    <button type="button" class="px-4 py-2 text-gray-500 hover:text-gray-700" data-modal-hide="tambahTransaksiModal">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg ml-2 hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Alert untuk success
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    @endif

    // Alert untuk error
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}"
        });
    @endif

    // Form submission dengan SweetAlert2
    document.getElementById('formTambahTransaksi').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah anda yakin ingin menyimpan data ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    // Auto calculate total harga
    const produkSelect = document.querySelector('select[name="id_produk"]');
    const jumlahInput = document.querySelector('input[name="jumlah"]');
    const totalHargaInput = document.querySelector('input[name="total_harga"]');

    // Data harga produk
    const hargaProduk = {
        @foreach($produks as $produk)
            {{ $produk->id_produk }}: {{ $produk->harga }},
        @endforeach
    };

    // Fungsi untuk menghitung total
    function hitungTotal() {
        const idProduk = produkSelect.value;
        const jumlah = jumlahInput.value;
        
        if(idProduk && jumlah) {
            const harga = hargaProduk[idProduk];
            const total = harga * jumlah;
            totalHargaInput.value = total;
        } else {
            totalHargaInput.value = '';
        }
    }

    // Event listeners
    produkSelect.addEventListener('change', hitungTotal);
    jumlahInput.addEventListener('input', hitungTotal);
</script>
@endpush