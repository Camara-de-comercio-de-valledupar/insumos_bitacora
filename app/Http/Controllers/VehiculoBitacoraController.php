<?php

namespace App\Http\Controllers;

use App\Http\Resources\BitacoraCollection;
use App\Models\Bitacora;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VehiculoBitacoraController extends Controller
{
    public function __invoke(string $placa): BitacoraCollection
    {
        $vehiculo = Vehiculo::query()->firstWhere('placa', $placa);
        if (!$vehiculo) {
            throw new NotFoundHttpException();
        }
        $bitacora = Bitacora::query()
            ->where('vehiculo_id', $vehiculo->id)
            ->orderBy("mes", "DESC")
            ->orderBy("anio", "DESC")
            ->get();

        return new BitacoraCollection($bitacora);
    }
}
