<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ArmadaController,
    PengirimanController,
    PemesananController,
    CheckinController,
    ReportController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes for Fleet Management System

// Armadas API
Route::prefix('armadas')->group(function () {
    Route::get('/', [ArmadaController::class, 'apiIndex']);
    Route::post('/', [ArmadaController::class, 'apiStore']);
    Route::get('/{armada}', [ArmadaController::class, 'apiShow']);
    Route::put('/{armada}', [ArmadaController::class, 'apiUpdate']);
    Route::patch('/{armada}', [ArmadaController::class, 'apiUpdate']);
    Route::delete('/{armada}', [ArmadaController::class, 'apiDestroy']);
    Route::get('/{armada}/pengirimans', [ArmadaController::class, 'apiPengirimans']);
    Route::get('/{armada}/pemesanans', [ArmadaController::class, 'apiPemesanans']);
    Route::get('/{armada}/checkins', [ArmadaController::class, 'apiCheckins']);
});

// Pengirimans API
Route::prefix('pengirimans')->group(function () {
    Route::get('/', [PengirimanController::class, 'apiIndex']);
    Route::post('/', [PengirimanController::class, 'apiStore']);
    Route::get('/{pengiriman}', [PengirimanController::class, 'apiShow']);
    Route::put('/{pengiriman}', [PengirimanController::class, 'apiUpdate']);
    Route::patch('/{pengiriman}', [PengirimanController::class, 'apiUpdate']);
    Route::delete('/{pengiriman}', [PengirimanController::class, 'apiDestroy']);
    Route::patch('/{pengiriman}/status', [PengirimanController::class, 'apiUpdateStatus']);
    Route::get('/track/{nomor_pengiriman}', [PengirimanController::class, 'apiTrack']);
});

// Pemesanans API
Route::prefix('pemesanans')->group(function () {
    Route::get('/', [PemesananController::class, 'apiIndex']);
    Route::post('/', [PemesananController::class, 'apiStore']);
    Route::get('/{pemesanan}', [PemesananController::class, 'apiShow']);
    Route::put('/{pemesanan}', [PemesananController::class, 'apiUpdate']);
    Route::patch('/{pemesanan}', [PemesananController::class, 'apiUpdate']);
    Route::delete('/{pemesanan}', [PemesananController::class, 'apiDestroy']);
});

// Checkins API
Route::prefix('checkins')->group(function () {
    Route::get('/', [CheckinController::class, 'apiIndex']);
    Route::post('/', [CheckinController::class, 'apiStore']);
    Route::get('/{checkin}', [CheckinController::class, 'apiShow']);
    Route::get('/armada/{armada}', [CheckinController::class, 'apiByArmada']);
    Route::get('/latest', [CheckinController::class, 'apiLatest']);
});

// Reports API
Route::prefix('reports')->group(function () {
    Route::get('/shipments', [ReportController::class, 'apiShipments']);
    Route::get('/status-summary', [ReportController::class, 'apiStatusSummary']);
    Route::get('/armada-usage', [ReportController::class, 'apiArmadaUsage']);
    Route::get('/dashboard', [ReportController::class, 'apiDashboard']);
});

// Search API
Route::prefix('search')->group(function () {
    Route::get('/global', [ReportController::class, 'apiGlobalSearch']);
    Route::get('/armadas', [ArmadaController::class, 'apiSearch']);
    Route::get('/pengirimans', [PengirimanController::class, 'apiSearch']);
});

// Health Check API
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'version' => '1.0.0',
        'service' => 'Fleet Management System API'
    ]);
});

// System Status API
Route::get('/status', function () {
    try {
        $armadas = \App\Models\Armada::count();
        $pengirimans = \App\Models\Pengiriman::count();
        $checkins = \App\Models\Checkin::count();

        return response()->json([
            'status' => 'ok',
            'database' => 'connected',
            'statistics' => [
                'armadas' => $armadas,
                'pengirimans' => $pengirimans,
                'checkins' => $checkins
            ],
            'timestamp' => now()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'database' => 'disconnected',
            'error' => $e->getMessage(),
            'timestamp' => now()
        ], 500);
    }
});
