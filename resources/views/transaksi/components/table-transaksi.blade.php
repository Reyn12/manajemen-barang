<div class="bg-white rounded-lg shadow-md">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class=" bg-blue-100 text-gray-600">
                <tr>
                    <th class="px-4 py-3">Kode Transaksi</th>
                    <th class="px-4 py-3">Tanggal Jual</th>
                    <th class="px-4 py-3">Produk</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Total Harga</th>
                    <th class="px-4 py-3">Status Bayar</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($transaksis as $transaksi)
                    <tr class="hover:bg-gray-50 even:bg-gray-50">
                        <td class="px-4 py-3">{{ $transaksi->kode_transaksi }}</td>
                        <td class="px-4 py-3">{{ date('d/m/Y', strtotime($transaksi->tgl_jual)) }}</td>
                        <td class="px-4 py-3">{{ $transaksi->produk->nama_produk }}</td>
                        <td class="px-4 py-3">{{ $transaksi->jumlah }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs {{ $transaksi->status_bayar === 'Lunas' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                {{ $transaksi->status_bayar }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                            {{-- Edit Button --}}
                            <button data-modal-target="editModal{{ $transaksi->id_transaksi }}" 
                                    data-modal-toggle="editModal{{ $transaksi->id_transaksi }}"
                                    class="p-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                                <i class="fas fa-edit text-lg"></i>
                            </button>
                        
                            {{-- Delete Button --}}
                            <button onclick="confirmDelete({{ $transaksi->id_transaksi }})" 
                                    type="button" 
                                    class=" p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200 mr-6">
                                <i class="fas fa-trash text-lg"></i>
                            </button>
                        
                            {{-- Include Modal --}}
                            @include('transaksi.components.edit-modal', ['transaksi' => $transaksi, 'produks' => $produks])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-center">Belum ada data transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3">
        @if ($transaksis->hasPages())
            <nav class="flex items-center justify-between">
                {{-- Previous Page Link --}}
                <div class="flex-1 flex justify-start">
                    @if ($transaksis->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                            Previous
                        </span>
                    @else
                        <a href="{{ $transaksis->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500">
                            Previous
                        </a>
                    @endif
                </div>
    
                {{-- Pagination Elements --}}
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
                    <div>
                        <span class="relative z-0 inline-flex shadow-sm rounded-md gap-4">
                            {{-- Array Of Links --}}
                            @foreach ($transaksis->getUrlRange(1, $transaksis->lastPage()) as $page => $url)
                                @if ($page == $transaksis->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-600 bg-blue-50 border border-blue-500 rounded-md">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-md">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        </span>
                    </div>
                </div>
    
                {{-- Next Page Link --}}
                <div class="flex-1 flex justify-end">
                    @if ($transaksis->hasMorePages())
                        <a href="{{ $transaksis->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500">
                            Next
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                            Next
                        </span>
                    @endif
                </div>
            </nav>
        @endif
    </div>
</div>
@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data transaksi akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim request delete
                fetch(`/transaksi/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        Swal.fire(
                            'Terhapus!',
                            'Data transaksi berhasil dihapus.',
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan pada server.',
                        'error'
                    );
                });
            }
        });
    }
</script>
@endpush