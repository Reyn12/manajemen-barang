<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
// database/seeders/DatabaseSeeder.php

    public function run()
    {
        // Data Supplier
        DB::table('suppliers')->insert([
            [
                'nama_supplier' => 'PT Elektronik Jaya',
                'alamat' => 'Jl. Raya Kedung No. 123, Jakarta',
                'no_telp' => '081234567890',
                'email' => 'elektronikjaya@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_supplier' => 'CV Digital Solution',
                'alamat' => 'Jl. Merdeka No. 45, Bandung',
                'no_telp' => '087654321098',
                'email' => 'digitalsolution@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Data Produk
        DB::table('produks')->insert([
            [
                'id_supplier' => 1,
                'nama_produk' => 'iPhone 13',
                'kategori' => 'HP',
                'harga' => 12000000,
                'stok' => 10,
                'spesifikasi' => 'RAM 4GB, Storage 128GB, Warna Midnight',
                'foto_produk' => 'iphone13.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 2,
                'nama_produk' => 'Laptop Asus ROG',
                'kategori' => 'Laptop',
                'harga' => 15000000,
                'stok' => 5,
                'spesifikasi' => 'RAM 16GB, SSD 512GB, RTX 3060',
                'foto_produk' => 'asus-rog.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Data Transaksi
        DB::table('transaksis')->insert([
            [
                'id_produk' => 1,
                'tgl_jual' => '2025-01-21',
                'jumlah' => 2,
                'total_harga' => 24000000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 2,
                'tgl_jual' => '2025-01-21',
                'jumlah' => 1,
                'total_harga' => 15000000,
                'status_bayar' => 'Pending',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
