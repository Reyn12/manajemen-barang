<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get period from request, default to 6m
        $period = $request->get('period', '6m');
        
        // Set date ranges based on period
        switch($period) {
            case '7d':
                $startDate = now()->subDays(7);
                $previousStartDate = now()->subDays(14);
                break;
            case '30d':
                $startDate = now()->subDays(30);
                $previousStartDate = now()->subDays(60);
                break;
            case '3m':
                $startDate = now()->subMonths(3);
                $previousStartDate = now()->subMonths(6);
                break;
            case '1y':
                $startDate = now()->subYear();
                $previousStartDate = now()->subYears(2);
                break;
            default: // 6m
                $startDate = now()->subMonths(6);
                $previousStartDate = now()->subMonths(12);
        }
        
        $endDate = now();
        $previousEndDate = $startDate;

        // Total Penjualan + Persentase
        $totalPenjualan = Transaksi::where('tgl_jual', '>=', $startDate)
                            ->sum('total_harga');
        $penjualanSebelumnya = Transaksi::whereBetween('tgl_jual', [
            $previousStartDate,
            $previousEndDate
        ])->sum('total_harga');

        $persentasePenjualan = 0;
        if ($penjualanSebelumnya > 0) {
            $persentasePenjualan = (($totalPenjualan - $penjualanSebelumnya) / $penjualanSebelumnya) * 100;
        }

        // Total Produk + Persentase
        $totalProduk = Produk::where('created_at', '>=', $startDate)->count();
        $produkSebelumnya = Produk::whereBetween('created_at', [
            $previousStartDate,
            $previousEndDate
        ])->count();

        $persentaseProduk = 0;
        if ($produkSebelumnya > 0) {
            $persentaseProduk = (($totalProduk - $produkSebelumnya) / $produkSebelumnya) * 100;
        }

        // Total Supplier + Persentase
        $totalSupplier = Supplier::where('created_at', '>=', $startDate)->count();
        $supplierSebelumnya = Supplier::whereBetween('created_at', [
            $previousStartDate,
            $previousEndDate
        ])->count();

        $persentaseSupplier = 0;
        if ($supplierSebelumnya > 0) {
            $persentaseSupplier = (($totalSupplier - $supplierSebelumnya) / $supplierSebelumnya) * 100;
        }

        return view('dashboard.dashboard', compact(
            'totalProduk',
            'persentaseProduk',
            'totalSupplier',
            'persentaseSupplier',
            'totalPenjualan',
            'persentasePenjualan'
        ));
    }
}