<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard UMKM
    Route::get('/dashboard', [UmkmController::class, 'dashboard'])->name('dashboard');
    
    // Produk & Stok
    Route::get('/products', [UmkmController::class, 'indexProduct'])->name('products.index');
    Route::post('/products', [UmkmController::class, 'storeProduct'])->name('products.store');

    // Transaksi
    Route::get('/transactions', [UmkmController::class, 'indexTransaction'])->name('transactions.index');
    Route::post('/transactions/sale', [UmkmController::class, 'storeSale'])->name('transactions.sale');
    Route::post('/transactions/expense', [UmkmController::class, 'storeExpense'])->name('transactions.expense');

    // Laporan & BEP
    Route::get('/reports', [UmkmController::class, 'report'])->name('reports.index');
    Route::get('/bep', [UmkmController::class, 'bep'])->name('bep.index');

    // Profile Routes (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';