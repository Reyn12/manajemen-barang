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
            ],
            [
                'nama_supplier' => 'PT Techno Pratama',
                'alamat' => 'Jl. Gatot Subroto No. 78, Surabaya',
                'no_telp' => '081122334455',
                'email' => 'technopratama@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_supplier' => 'CV Komputer Sejahtera',
                'alamat' => 'Jl. Ahmad Yani No. 234, Medan',
                'no_telp' => '082233445566',
                'email' => 'komputersejahtera@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_supplier' => 'PT Global Elektronika',
                'alamat' => 'Jl. Sudirman No. 56, Semarang',
                'no_telp' => '083344556677',
                'email' => 'globalelektronika@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_supplier' => 'CV Tech Solution Indonesia',
                'alamat' => 'Jl. Diponegoro No. 89, Yogyakarta',
                'no_telp' => '084455667788',
                'email' => 'techsolution@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_supplier' => 'PT Mitra Digital',
                'alamat' => 'Jl. Thamrin No. 167, Makassar',
                'no_telp' => '085566778899',
                'email' => 'mitradigital@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_supplier' => 'CV Sentosa Komputer',
                'alamat' => 'Jl. Pahlawan No. 321, Palembang',
                'no_telp' => '086677889900',
                'email' => 'sentosakomputer@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_supplier' => 'PT Indo Elektronik',
                'alamat' => 'Jl. Asia Afrika No. 90, Malang',
                'no_telp' => '087788990011',
                'email' => 'indoelektronik@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_supplier' => 'CV Master Technology',
                'alamat' => 'Jl. Veteran No. 432, Denpasar',
                'no_telp' => '088899001122',
                'email' => 'mastertech@mail.com',
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
                'foto_produk' => 'images/products/iphone13.jpg',
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
                'foto_produk' => 'images/products/asus-rog.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 3,
                'nama_produk' => 'Samsung Galaxy S22',
                'kategori' => 'HP',
                'harga' => 13500000,
                'stok' => 8,
                'spesifikasi' => 'RAM 8GB, Storage 256GB, Warna Phantom Black',
                'foto_produk' => 'images/products/samsung-s22.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 4,
                'nama_produk' => 'MacBook Pro M2',
                'kategori' => 'Laptop',
                'harga' => 18900000,
                'stok' => 3,
                'spesifikasi' => 'RAM 16GB, SSD 512GB, Apple M2 Chip',
                'foto_produk' => 'images/products/macbook-m2.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 5,
                'nama_produk' => 'Sony PlayStation 5',
                'kategori' => 'Konsol Game',
                'harga' => 8500000,
                'stok' => 6,
                'spesifikasi' => 'Storage 825GB SSD, Digital Edition, Warna Putih',
                'foto_produk' => 'images/products/ps5.jpg', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 8,
                'nama_produk' => 'iPad Pro 2023',
                'kategori' => 'Tablet',
                'harga' => 14500000,
                'stok' => 7,
                'spesifikasi' => '12.9 inch, RAM 8GB, Storage 256GB, M2 Chip',
                'foto_produk' => 'images/products/ipad-pro.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 8,
                'nama_produk' => 'Dell XPS 13',
                'kategori' => 'Laptop',
                'harga' => 16800000,
                'stok' => 4,
                'spesifikasi' => 'Intel i7 Gen 12, RAM 16GB, SSD 1TB',
                'foto_produk' => 'images/products/dell-xps.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 8,
                'nama_produk' => 'Nintendo Switch OLED',
                'kategori' => 'Konsol Game',
                'harga' => 4800000,
                'stok' => 12,
                'spesifikasi' => '7 inch OLED, Storage 64GB, Warna Putih',
                'foto_produk' => 'images/products/switch-oled.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 9,
                'nama_produk' => 'Xiaomi 13 Pro',
                'kategori' => 'HP',
                'harga' => 9900000,
                'stok' => 15,
                'spesifikasi' => 'RAM 12GB, Storage 256GB, Snapdragon 8 Gen 2',
                'foto_produk' => 'images/products/xiaomi-13pro.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 10,
                'nama_produk' => 'Microsoft Surface Pro 9 i7',
                'kategori' => 'Laptop',
                'harga' => 21500000,
                'stok' => 4,
                'spesifikasi' => '13 inch, Intel i7, RAM 32GB, SSD 512GB',
                'foto_produk' => 'images/products/surface-pro9-i7.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_supplier' => 10,
                'nama_produk' => 'Microsoft Surface Laptop 5',
                'kategori' => 'Laptop',
                'harga' => 15900000,
                'stok' => 8,
                'spesifikasi' => '15 inch, Intel i5, RAM 16GB, SSD 256GB',
                'foto_produk' => 'images/products/surface-laptop5.jpg',
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
            ],
            [
                'id_produk' => 3,
                'tgl_jual' => '2025-01-15',
                'jumlah' => 1,
                'total_harga' => 13500000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 4,
                'tgl_jual' => '2024-12-28',
                'jumlah' => 2,
                'total_harga' => 37800000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 5,
                'tgl_jual' => '2024-12-25',
                'jumlah' => 3,
                'total_harga' => 25500000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 6,
                'tgl_jual' => '2024-12-10',
                'jumlah' => 1,
                'total_harga' => 14500000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 7,
                'tgl_jual' => '2024-11-30',
                'jumlah' => 2,
                'total_harga' => 33600000,
                'status_bayar' => 'Pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 8,
                'tgl_jual' => '2024-11-15',
                'jumlah' => 4,
                'total_harga' => 19200000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 9,
                'tgl_jual' => '2024-10-28',
                'jumlah' => 2,
                'total_harga' => 19800000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 10,
                'tgl_jual' => '2024-10-15',
                'jumlah' => 1,
                'total_harga' => 17500000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 1,
                'tgl_jual' => '2024-09-30',
                'jumlah' => 3,
                'total_harga' => 36000000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 3,
                'tgl_jual' => '2024-09-15',
                'jumlah' => 2,
                'total_harga' => 27000000,
                'status_bayar' => 'Pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 5,
                'tgl_jual' => '2024-08-30',
                'jumlah' => 2,
                'total_harga' => 17000000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 7,
                'tgl_jual' => '2024-08-15',
                'jumlah' => 1,
                'total_harga' => 16800000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 9,
                'tgl_jual' => '2024-08-01',
                'jumlah' => 3,
                'total_harga' => 29700000,
                'status_bayar' => 'Sukses',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
