<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProdukController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route Supplier yang sudah ada
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
// Tambah route update
Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

// Route Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.produk');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
