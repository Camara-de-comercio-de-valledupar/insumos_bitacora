<?php

use App\Http\Controllers\{
    BitacoraController,
    DetalleVehiculoController,
    UltimoConductorController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Bitacora de vehiculos de la Camara de Comercio de Valledupar']);
});


Route::prefix(
    'bitacoras',
)->group(function () {
    Route::get('/', [BitacoraController::class, 'listarBitacoras']);
    Route::post('/', [BitacoraController::class, 'guardarBitacora'])->name('bitacora-guardar');
    Route::put('/{bitacora}', [BitacoraController::class, 'actualizarBitacora'])->name('actualizar-bitacora');
    Route::delete('/{bitacora}', [BitacoraController::class, 'eliminarBitacora'])->name('eliminar-bitacora');
    Route::post('/agregar-detalle-bitacora', [BitacoraController::class, 'agregarDetalleBitacora'])->name('agregar-detalle-bitacora');
    Route::delete('eliminar-detalle-bitacora/{detalleBitacora}', [BitacoraController::class, 'eliminarDetalleBitacora'])->name('eliminar-detalle-bitacora');
});

Route::get('/vehiculo/{placa:string}', DetalleVehiculoController::class);
Route::get('/vehiculo/{placa:string}/ultimo-conductor', UltimoConductorController::class);
