<?php

use App\Http\Controllers\BitácoraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Bitácora de vehículos de la Cámara de Comercio de Valledupar']);
});


Route::prefix(
    'bitácoras',
)->group(function () {
    Route::post('crear-bitácora', [BitácoraController::class, 'guardarBitácora'])->name('bitácora-guardar');
    Route::post('agregar-detalle-bitácora', [BitácoraController::class, 'agregarDetalleBitácora'])->name('agregar-detalle-bitácora');
    Route::put('actualizar-bitácora/{bitácora}', [BitácoraController::class, 'actualizarBitácora'])->name('actualizar-bitácora');
    Route::delete('eliminar-bitácora/{bitácora}', [BitácoraController::class, 'eliminarBitácora'])->name('eliminar-bitácora');
    Route::delete('eliminar-detalle-bitácora/{detalleBitácora}', [BitácoraController::class, 'eliminarDetalleBitácora'])->name('eliminar-detalle-bitácora');
});
