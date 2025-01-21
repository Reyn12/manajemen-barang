<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Dashboard;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

