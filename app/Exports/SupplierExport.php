<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SupplierExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Supplier::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Supplier',
            'No Telp',
            'Alamat'
        ];
    }

    public function map($supplier): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $supplier->nama_supplier,
            $supplier->no_telp,
            $supplier->alamat
        ];
    }
}