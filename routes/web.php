<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(BarangController::class)->group(function () {
        Route::get('/barang', 'index')->name('barang');
        Route::get('/barang/tambah', 'create');
        Route::get('/barang/{id}', 'edit');
        Route::post('/barang', 'store')->name('barangSimpan');
        Route::patch('/barang/{id}', 'update')->name('barangUpdate');
        Route::delete('/barang/{id}', 'destroy');
    });
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier', 'index')->name('supplier');
        Route::get('/supplier/tambah', 'create');
        Route::get('/supplier/{id}', 'edit')->name('supplierEdit');
        Route::post('/supplier', 'store')->name('supplierSimpan');
        Route::patch('/supplier/{id}', 'update')->name('supplierUpdate');
        Route::delete('/supplier/{id}', 'destroy');
    });
    Route::controller(PembelianController::class)->group(function () {
        Route::get('/pembelian', 'index')->name('pembelian');
        Route::get('/cariBarang', 'cari');
        Route::get('/cariSupplier', 'cariSupplier');
        Route::get('/pembelianCetak', 'pembelianCetak')->name('pembelianCetak');
        Route::post('/pembelian', 'store')->name('pembelianSimpan');
        Route::delete('/pembelian/{id}', 'destroy');
    });
    Route::controller(PenjualanController::class)->group(function () {
        Route::get('/penjualan', 'index')->name('penjualan');
        // Route::get('/penjualanCetak', 'penjualanCetak')->name('penjualanCetak');
        Route::post('/detailSimpan', 'detailSimpan')->name('detailSimpan');
        Route::post('/selesai', 'selesaiTransaksi')->name('selesaiTransaksi');
        Route::delete('/keluarHapus/{id}','keluarHapus');
        
        // Route::patch('/penjualan/{id}', 'update')->name('penjualanUpdate');
        // Route::delete('/penjualan/{id}', 'destroy');
    });
});
