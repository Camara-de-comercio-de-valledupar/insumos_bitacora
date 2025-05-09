<?php

use App\Http\Controllers\BitacoraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BitacoraController::class, 'index'])->name('bitacora.index');
Route::post('/crear-bitacora', [BitacoraController::class, 'createBitacora'])->name('bitacora.createBitacora');
Route::get("/{bitacora}", [BitacoraController::class, 'show'])->name('bitacora.show');
Route::get('/{bitacora}/crear', [BitacoraController::class, 'create'])->name('bitacora.create');
Route::post('/{bitacora}/crear', [BitacoraController::class, 'store'])->name('bitacora.store');
Route::get('/{bitacora}/editar/{detalleBitacora}', [BitacoraController::class, 'edit'])->name('bitacora.edit');
Route::put('/{bitacora}/editar/{detalleBitacora}', [BitacoraController::class, 'update'])->name('bitacora.update');
Route::delete('/{bitacora}', [BitacoraController::class, 'destroy'])->name('bitacora.destroy');
