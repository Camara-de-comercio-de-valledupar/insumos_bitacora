<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetalleVehiculoResource;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultarVehiculosController extends Controller
{
    public function __invoke(): JsonResource
    {
        $vehiculos = Vehiculo::all();
        return DetalleVehiculoResource::collection($vehiculos);
    }
}
