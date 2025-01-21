<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_produk',
        'tgl_jual',
        'jumlah',
        'total_harga',
        'status_bayar'
    ];

    // Relasi ke Produk (many-to-one)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
 