<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarBitacoraRequest;
use App\Http\Requests\CrearBitacoraRequest;
use App\Http\Requests\CrearDetalleBitacoraRequest;
use App\Http\Resources\BitácoraResource;
use App\Http\Resources\DetalleBitácoraResource;
use App\Models\Bitacora;
use App\Models\DetalleBitacora;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BitácoraController extends Controller
{
    public function guardarBitácora(CrearBitacoraRequest $request): BitácoraResource
    {
        $bitácora = $request->crearBitácora();
        return new BitácoraResource($bitácora);
    }

    public function agregarDetalleBitácora(CrearDetalleBitacoraRequest $request): DetalleBitácoraResource
    {
        $detalleBitácora = $request->crearDetalleBitácora();
        return new DetalleBitácoraResource($detalleBitácora);
    }

    public function actualizarBitácora(ActualizarBitacoraRequest $request, Bitacora $bitácora): BitácoraResource
    {
        $bitácora = $request->actualizarBitácora($bitácora);
        return new BitácoraResource($bitácora);
    }

    public function eliminarBitácora(Request $request, Bitacora $bitácora): JsonResponse
    {
        $bitácora->delete();
        return response()->json(null, 204);
    }

    public function eliminarDetalleBitácora(Request $request, DetalleBitacora $detalleBitácora): JsonResponse
    {
        $detalleBitácora->delete();
        return response()->json(null, 204);
    }
}
