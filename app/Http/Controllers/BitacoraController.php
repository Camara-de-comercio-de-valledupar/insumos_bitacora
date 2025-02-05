<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarBitacoraRequest;
use App\Http\Requests\CrearBitacoraRequest;
use App\Http\Requests\CrearDetalleBitacoraRequest;
use App\Http\Resources\BitacoraCollection;
use App\Http\Resources\BitacoraResource;
use App\Http\Resources\DetalleBitacoraResource;
use App\Models\Bitacora;
use App\Models\DetalleBitacora;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{

    public function listarBitacoras(): BitacoraCollection
    {
        return new BitacoraCollection(Bitacora::all());
    }
    public function guardarBitacora(CrearBitacoraRequest $request): BitacoraResource
    {
        $bitacora = $request->crearBitacora();
        return new BitacoraResource($bitacora);
    }

    public function agregarDetalleBitacora(CrearDetalleBitacoraRequest $request): DetalleBitacoraResource
    {
        $detalleBitacora = $request->crearDetalleBitacora();
        return new DetalleBitacoraResource($detalleBitacora);
    }

    public function actualizarBitacora(ActualizarBitacoraRequest $request, Bitacora $bitacora): BitacoraResource
    {
        $bitacora = $request->actualizarBitacora($bitacora);
        return new BitacoraResource($bitacora);
    }

    public function eliminarBitacora(Request $request, Bitacora $bitacora): JsonResponse
    {
        $bitacora->delete();
        return response()->json(null, 204);
    }

    public function eliminarDetalleBitacora(Request $request, DetalleBitacora $detalleBitacora): JsonResponse
    {
        $detalleBitacora->delete();
        return response()->json(null, 204);
    }
}
