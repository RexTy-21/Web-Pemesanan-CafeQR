<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CashierController;

// Route Pelanggan
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

// Route Dashboard Kasir
Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
Route::post('/cashier/pay/{id}', [CashierController::class, 'payCash'])->name('cashier.pay');
Route::get('/cashier/print-kitchen/{id}', [CashierController::class, 'printKitchen'])->name('cashier.print_kitchen');