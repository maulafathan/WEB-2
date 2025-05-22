<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RuangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitKerjaController;
use App\Models\Pegawai;
use App\Models\Ruang;

Route::get('/', function () {
    return view('welcome');
});

 
Route::get('/unit-kerja', [UnitKerjaController::class, 'index']); 
Route::get('/ruang', [RuangController::class, 'index']); 
Route::get('/pegawai', [PegawaiController::class, 'index']); 
Route::get('/peminjaman', [PeminjamanController::class, 'index']); 