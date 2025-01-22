<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Transaksi::with(['produk', 'produk.supplier'])->get();
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Tanggal',
            'Produk',
            'Supplier',
            'Jumlah',
            'Total Harga',
            'Status',
            'Tanggal Dibuat'
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->id_transaksi,
            $transaksi->tgl_jual,
            $transaksi->produk->nama_produk,
            $transaksi->produk->supplier->nama_supplier,
            $transaksi->jumlah,
            'Rp ' . number_format($transaksi->total_harga, 0, ',', '.'),
            $transaksi->status_bayar,
            $transaksi->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:H1' => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4A90E2']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF']]
            ]
        ];
    }
}