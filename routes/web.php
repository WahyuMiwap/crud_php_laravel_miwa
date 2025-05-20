<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return redirect()->route('barangs.index');  // Redirect ke halaman daftar barang
});

// Resource route untuk CRUD barang
Route::resource('barangs', BarangController::class);