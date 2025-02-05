<?php

namespace App\Http\Controllers;

use App\Models\DetalleBitacora;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UltimoConductorController extends Controller
{
    public function __invoke(String $placa) {

       $detalleBitacora = DetalleBitacora::query()
           ->whereHas('bitacora', function($query) use ($placa) {
               $query->whereHas('vehiculo', function($query) use ($placa) {
                   $query->where('placa', $placa);
               });
           })
           ->latest()
           ->first();
       if (!$detalleBitacora) throw new NotFoundHttpException();
       return response()->json([
           'conductor' => $detalleBitacora->getResponsable(),
           'dia' => $detalleBitacora->getDia(),
           'mes' => $detalleBitacora->bitacora->getMes(),
           'anio' => $detalleBitacora->bitacora->getAnio(),
       ], 200);

    }
}
