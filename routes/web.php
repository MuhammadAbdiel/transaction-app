<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
})
    ->name('home');

Route::resource('barang', BarangController::class)
    ->names([
        'index' => 'barang.index',
        'create' => 'barang.create',
        'store' => 'barang.store',
        'show' => 'barang.show',
        'edit' => 'barang.edit',
    ]);
Route::put('/barang', [BarangController::class, 'update'])
    ->name('barang.update');
Route::delete('/barang', [BarangController::class, 'destroy'])
    ->name('barang.destroy');

Route::resource('customer', CustomerController::class)
    ->names([
        'index' => 'customer.index',
        'create' => 'customer.create',
        'store' => 'customer.store',
        'show' => 'customer.show',
        'edit' => 'customer.edit',
    ]);
Route::put('/customer', [CustomerController::class, 'update'])
    ->name('customer.update');
Route::delete('/customer', [CustomerController::class, 'destroy'])
    ->name('customer.destroy');

Route::get('/transaction', [TransactionController::class, 'index'])
    ->name('transaction.index');
Route::get('/transaction/create', [TransactionController::class, 'create'])
    ->name('transaction.create');
Route::post('/transaction/store', [TransactionController::class, 'store'])
    ->name('transaction.store');
