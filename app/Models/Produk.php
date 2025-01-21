<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'id_supplier',
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'spesifikasi',
        'foto_produk'
    ];

    // Relasi ke Supplier (many-to-one)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    // Relasi ke Transaksi (one-to-many)
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_produk');
    }
}