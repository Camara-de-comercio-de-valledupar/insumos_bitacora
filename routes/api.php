<?php

use App\Http\Controllers\BitácoraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Bitácora de vehículos de la Cámara de Comercio de Valledupar']);
});


Route::prefix(
    'bitácoras',
)->group(function () {
    Route::post('crear-bitácora', [BitácoraController::class, 'guardarBitácora']);
    Route::post('agregar-detalle-bitácora', [BitácoraController::class, 'agregarDetalleBitácora']);
    Route::put('actualizar-bitácora/{bitácora}', [BitácoraController::class, 'actualizarBitácora']);
    Route::delete('eliminar-bitácora/{bitácora}', [BitácoraController::class, 'eliminarBitácora']);
    Route::delete('eliminar-detalle-bitácora/{detalleBitácora}', [BitácoraController::class, 'eliminarDetalleBitácora']);
});
