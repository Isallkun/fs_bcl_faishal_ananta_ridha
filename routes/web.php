<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ArmadaController,
    PengirimanController,
    PemesananController,
    CheckinController,
    ReportController
};

Route::get('/', [PengirimanController::class, 'track']);

// Armada CRUD + filter
Route::resource('armadas', ArmadaController::class)->except(['show']);

// Pengiriman list + create + tracking + update status (simple demo)
Route::get('/pengiriman', [PengirimanController::class, 'index'])->name('pengiriman.index');
Route::get('/pengiriman/create', [PengirimanController::class, 'create'])->name('pengiriman.create');
Route::post('/pengiriman', [PengirimanController::class, 'store'])->name('pengiriman.store');
Route::match(['get','post'], '/track', [PengirimanController::class, 'track'])->name('pengiriman.track');
Route::patch('/pengiriman/{pengiriman}/status', [PengirimanController::class, 'updateStatus'])->name('pengiriman.updateStatus');

// Pemesanan
Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');

// Checkin (index + API store)
Route::get('/checkins', [CheckinController::class, 'index'])->name('checkins.index');
Route::post('/checkins', [CheckinController::class, 'store'])->name('checkins.store');

// Report
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
