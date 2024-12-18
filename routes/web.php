<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NonTransaksi;
use App\Http\Controllers\Transaksi;

Route::get('/', function () {
    return view('layouts.dashboard');
});

Route::get('/login', function () {
    return view('layouts.login');
});
    // User routes
    Route::get('/user', [NonTransaksi::class, 'indexUser'])->name('user.index');
    Route::get('/user/create', [NonTransaksi::class, 'createUser'])->name('user.create');
    Route::post('/user', [NonTransaksi::class, 'storeUser'])->name('user.store');
    Route::get('/user/{id}/edit', [NonTransaksi::class, 'editUser'])->name('user.edit');
    Route::put('/user/{id}', [NonTransaksi::class, 'updateUser'])->name('user.update');
    Route::delete('/user/{id}', [NonTransaksi::class, 'deleteUser'])->name('user.delete');

    // Role routes
    Route::get('/role', [NonTransaksi::class, 'indexRole'])->name('role.index');
    Route::get('/role/create', [NonTransaksi::class, 'createRole'])->name('role.create');
    Route::post('/role', [NonTransaksi::class, 'storeRole'])->name('role.store');
    Route::get('/role/{id}/edit', [NonTransaksi::class, 'editRole'])->name('role.edit');
    Route::put('/role/{id}', [NonTransaksi::class, 'updateRole'])->name('role.update');
    Route::delete('/role/{id}', [NonTransaksi::class, 'deleteRole'])->name('role.delete');

    // Vendor routes
    Route::get('/vendor', [NonTransaksi::class, 'indexVendor'])->name('vendor.index');
    Route::get('/vendor/create', [NonTransaksi::class, 'createVendor'])->name('vendor.create');
    Route::post('/vendor', [NonTransaksi::class, 'storeVendor'])->name('vendor.store');
    Route::get('/vendor/{id}/edit', [NonTransaksi::class, 'editVendor'])->name('vendor.edit');
    Route::put('/vendor/{id}', [NonTransaksi::class, 'updateVendor'])->name('vendor.update');
    Route::delete('/vendor/{id}', [NonTransaksi::class, 'deleteVendor'])->name('vendor.delete');

    // Barang routes
    Route::get('/barang', [NonTransaksi::class, 'indexBarang'])->name('barang.index');
    Route::get('/barang/create', [NonTransaksi::class, 'createBarang'])->name('barang.create');
    Route::post('/barang', [NonTransaksi::class, 'storeBarang'])->name('barang.store');
    Route::get('/barang/{id}/edit', [NonTransaksi::class, 'editBarang'])->name('barang.edit');
    Route::put('/barang/{id}', [NonTransaksi::class, 'updateBarang'])->name('barang.update');
    Route::delete('/barang/{id}', [NonTransaksi::class, 'deleteBarang'])->name('barang.delete');

    // Satuan routes
    Route::get('/satuan', [NonTransaksi::class, 'indexSatuan'])->name('satuan.index');
    Route::get('/satuan/create', [NonTransaksi::class, 'createSatuan'])->name('satuan.create');
    Route::post('/satuan', [NonTransaksi::class, 'storeSatuan'])->name('satuan.store');
    Route::get('/satuan/{id}/edit', [NonTransaksi::class, 'editSatuan'])->name('satuan.edit');
    Route::put('/satuan/{id}', [NonTransaksi::class, 'updateSatuan'])->name('satuan.update');
    Route::delete('/satuan/{id}', [NonTransaksi::class, 'deleteSatuan'])->name('satuan.delete');

    // Kartu Stok routes
    Route::get('/kartu-stok', [Transaksi::class, 'indexKartuStock'])->name('kartu-stok.index');

    // Pengadaan routes
    Route::get('/pengadaan', [Transaksi::class, 'indexPengadaan'])->name('pengadaan.index');
    Route::get('/pengadaan/create', [Transaksi::class, 'createPengadaan'])->name('pengadaan.create');
    Route::post('/pengadaan', [Transaksi::class, 'storePengadaan'])->name('pengadaan.store');
    Route::get('/pengadaan/{id}', [Transaksi::class, 'showPengadaan'])->name('pengadaan.show');

    // Penerimaan routes
    Route::get('/penerimaan', [Transaksi::class, 'indexPenerimaan'])->name('penerimaan.index');
    Route::get('/penerimaan/select-pengadaan', [Transaksi::class, 'selectPengadaan'])->name('penerimaan.select-pengadaan');
    Route::get('/penerimaan/create', [Transaksi::class, 'createPenerimaan'])->name('penerimaan.create');
    Route::post('/penerimaan', [Transaksi::class, 'storePenerimaan'])->name('penerimaan.store');
    Route::get('/penerimaan/{id}', [Transaksi::class, 'showPenerimaan'])->name('penerimaan.show');

    // Retur routes
    Route::get('/retur', [Transaksi::class, 'indexRetur'])->name('retur.index');
    Route::get('/retur/select-penerimaan', [Transaksi::class, 'selectPenerimaan'])->name('retur.select-penerimaan');
    Route::get('/retur/create', [Transaksi::class, 'createRetur'])->name('retur.create');
    Route::post('/retur', [Transaksi::class, 'storeRetur'])->name('retur.store');
    Route::get('/retur/{id}', [Transaksi::class, 'showRetur'])->name('retur.show');

    // Penjualan routes
    Route::get('/penjualan', [Transaksi::class, 'indexPenjualan'])->name('penjualan.index');
    Route::get('/penjualan/create', [Transaksi::class, 'createPenjualan'])->name('penjualan.create');
    Route::post('/penjualan', [Transaksi::class, 'storePenjualan'])->name('penjualan.store');
    Route::get('/penjualan/{id}', [Transaksi::class, 'showPenjualan'])->name('penjualan.show');


// API route for getting barang by pengadaan
Route::get('/api/barang-by-pengadaan', [Transaksi::class, 'getBarangByPengadaan'])->name('api.barang-by-pengadaan');