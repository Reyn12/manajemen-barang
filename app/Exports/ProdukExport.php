<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ProdukExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Produk::with('supplier');
        
        // Apply filters
        if ($this->request->has('search')) {
            $search = $this->request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('kode_produk', 'like', "%{$search}%");
            });
        }
        
        if ($this->request->has('supplier')) {
            $query->where('id_supplier', $this->request->supplier);
        }
        
        if ($this->request->has('min_stok')) {
            $query->where('stok', '>=', $this->request->min_stok);
        }
        
        if ($this->request->has('max_stok')) {
            $query->where('stok', '<=', $this->request->max_stok);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Kategori',
            'Harga',
            'Stok',
            'Spesifikasi',
            'Supplier',
            'Foto Produk'
        ];
    }

    public function map($produk): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $produk->nama_produk,
            $produk->kategori,
            'Rp ' . number_format($produk->harga, 0, ',', '.'),
            $produk->stok . ' unit',
            $produk->spesifikasi,
            $produk->supplier->nama_supplier,
            $produk->foto_produk
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            // Style untuk header
            1 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
            // Style untuk header background
            'A1:H1' => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4A90E2']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF']]
            ],
            // Style untuk seluruh data
            'A2:H'.$sheet->getHighestRow() => [
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
            // Style khusus untuk kolom nomor
            'A2:A'.$sheet->getHighestRow() => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
            // Style khusus untuk kolom harga
            'D2:D'.$sheet->getHighestRow() => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
            ],
            // Style khusus untuk kolom stok
            'E2:E'.$sheet->getHighestRow() => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
}