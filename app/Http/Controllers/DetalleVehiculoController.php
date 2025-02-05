<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetalleVehiculoResource;
use App\Models\Vehiculo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetalleVehiculoController extends Controller
{
    /**
     * @param string $placa
     * @throws NotFoundHttpException
     * @return DetalleVehiculoResource
     */
    public function  __invoke(string $placa)
    {
        $vehiculo = Vehiculo::query()->firstWhere('placa', $placa);
        if (!$vehiculo) {
            throw new NotFoundHttpException();
        }
        return new DetalleVehiculoResource($vehiculo);
    }
}
