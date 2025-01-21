<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');

Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
