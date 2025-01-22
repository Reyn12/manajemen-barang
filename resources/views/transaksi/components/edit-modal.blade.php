<div id="editModal{{ $transaksi->id_transaksi }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Edit Transaksi
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="editModal{{ $transaksi->id_transaksi }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6">
                <div class="flex gap-6">
                    <!-- Kolom Kiri - Gambar -->
                    <div class="w-1/3">
                        <img src="{{ asset('images/bgEdit.png') }}" alt="Product Image" class="w-full rounded-lg shadow-lg">
                    </div>
                    
                    <!-- Kolom Kanan - Form -->
                    <div class="w-2/3">
                        <form id="updateForm{{ $transaksi->id_transaksi }}" onsubmit="updateTransaksi(event, {{ $transaksi->id_transaksi }})">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Kolom Kanan Bagian 1 -->
                                <div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="id_produk">
                                            Produk
                                        </label>
                                        <select name="id_produk" id="id_produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            @foreach($produks as $produk)
                                                <option value="{{ $produk->id_produk }}" {{ $transaksi->id_produk == $produk->id_produk ? 'selected' : '' }}>
                                                    {{ $produk->nama_produk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="jumlah">
                                            Jumlah
                                        </label>
                                        <input type="number" name="jumlah" id="jumlah" value="{{ $transaksi->jumlah }}" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </div>
                                </div>

                                <!-- Kolom Kanan Bagian 2 -->
                                <div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="tgl_jual">
                                            Tanggal Jual
                                        </label>
                                        <input type="date" name="tgl_jual" id="tgl_jual" value="{{ $transaksi->tgl_jual }}" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="status_bayar">
                                            Status Bayar
                                        </label>
                                        <select name="status_bayar" id="status_bayar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="Sukses" {{ $transaksi->status_bayar == 'Sukses' ? 'selected' : '' }}>Sukses</option>
                                            <option value="Pending" {{ $transaksi->status_bayar == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="flex items-center justify-end pt-4 space-x-2 border-t mt-4">
                                <button data-modal-hide="editModal{{ $transaksi->id_transaksi }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateTransaksi(e, id) {
    e.preventDefault();
    
    const form = document.getElementById('updateForm' + id);
    const formData = new FormData(form);

    // Tambahkan header CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/transaksi/${id}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Hide modal
            const modal = document.getElementById('editModal' + id);
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');

            // Show success alert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.reload();
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan! Silakan coba lagi.'
        });
    });
}
</script>