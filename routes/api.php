<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Bitácora de vehículos de la Cámara de Comercio de Valledupar']);
});
