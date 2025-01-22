<div class="bg-white rounded-lg shadow-md">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-gray-700 bg-gray-100">
                <tr>
                    <th class="px-4 py-3">No</th>
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
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ date('d/m/Y', strtotime($transaksi->tgl_jual)) }}</td>
                        <td class="px-4 py-3">{{ $transaksi->produk->nama_produk }}</td>
                        <td class="px-4 py-3">{{ $transaksi->jumlah }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs {{ $transaksi->status_bayar === 'Lunas' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                {{ $transaksi->status_bayar }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('transaksi.edit', $transaksi->id_transaksi) }}" 
                                   class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $transaksi->id_transaksi) }}" method="POST" 
                                      class="inline-block" onsubmit="return confirm('Yakin mau hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
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
        {{ $transaksis->links() }}
    </div>
</div>