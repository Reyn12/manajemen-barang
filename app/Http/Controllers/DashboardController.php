<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Produk;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSupplier = Supplier::count();
        $totalProduk = Produk::count();
        $totalTransaksi = Transaksi::count();
        $recentTransaksi = Transaksi::with('produk')->latest()->take(5)->get();

        return view('dashboard.dashboard', compact(
            'totalSupplier',
            'totalProduk',
            'totalTransaksi',
            'recentTransaksi'
        ));
    }
}
