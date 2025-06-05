<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AntrianController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/cetak-antrian', [HomeController::class, 'checkAndDownloadPdf']);
Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian.index');
Route::post('/antrian', [AntrianController::class, 'store'])->name('antrian.store');
Route::post('/update-status/{id}', [AntrianController::class, 'updateStatus'])->name('update.status');;
Route::get('/tes-minat-bakat', [HomeController::class, 'tesMinatBakat'])->name('tes.minat.bakat');
