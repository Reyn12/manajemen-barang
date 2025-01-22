<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProdukExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Produk::with('supplier')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode',
            'Nama Produk',
            'Supplier',
            'Harga',
            'Stok'
        ];
    }

    public function map($produk): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $produk->kode,
            $produk->nama_produk,
            $produk->supplier->nama_supplier,
            $produk->harga,
            $produk->stok
        ];
    }
}