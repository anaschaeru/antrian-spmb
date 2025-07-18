<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AntrianController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/cetak-antrian', [HomeController::class, 'checkAndDownloadPdf']);

Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian');
// Route::get('/antrian', [AntrianController::class, 'showAntrian'])->name('antrian');
Route::post('/validasi-token', [AntrianController::class, 'validasiToken'])->name('validasi.token');
Route::put('/update-biodata/{id}', [AntrianController::class, 'updateBiodata'])->name('update.biodata');
Route::post('/logout', [AntrianController::class, 'logout'])->name('logout');

Route::post('/antrian', [AntrianController::class, 'store'])->name('antrian.store');
Route::post('/antrian/import', [AntrianController::class, 'import'])->name('antrian.import');
Route::post('/update-status/{id}', [AntrianController::class, 'updateStatus'])->name('update.status');;

Route::get('/get-biodata-form/{id}', [AntrianController::class, 'getBiodataForm']);
Route::get('/get-status-form/{id}', [AntrianController::class, 'getStatusForm']);

Route::resource('bank-soal', \App\Http\Controllers\BankSoalController::class);

Route::get('/tes-minat-bakat', [HomeController::class, 'tesMinatBakat'])->name('tes.minat.bakat');
Route::get('/tes-minat-bakat-form', [HomeController::class, 'form'])->name('tes-minat.form');
Route::post('/tes-minat-bakat-form', [HomeController::class, 'cek'])->name('tes-minat.cek');
