<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarBitácoraRequest;
use App\Http\Requests\CrearBitácoraRequest;
use App\Http\Requests\CrearDetalleBitácoraRequest;
use App\Http\Resources\BitácoraResource;
use App\Http\Resources\DetalleBitácoraResource;
use App\Models\Bitácora;
use App\Models\DetalleBitácora;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BitácoraController extends Controller
{
    public function guardarBitácora(CrearBitácoraRequest $request): BitácoraResource
    {
        $bitácora = $request->crearBitácora();
        return new BitácoraResource($bitácora);
    }

    public function agregarDetalleBitácora(CrearDetalleBitácoraRequest $request): DetalleBitácoraResource
    {
        $detalleBitácora = $request->crearDetalleBitácora();
        return new DetalleBitácoraResource($detalleBitácora);
    }

    public function actualizarBitácora(ActualizarBitácoraRequest $request, Bitácora $bitácora): BitácoraResource
    {
        $bitácora = $request->actualizarBitácora($bitácora);
        return new BitácoraResource($bitácora);
    }

    public function eliminarBitácora(Request $request, Bitácora $bitácora): JsonResponse
    {
        $bitácora->delete();
        return response()->json(null, 204);
    }

    public function eliminarDetalleBitácora(Request $request, DetalleBitácora $detalleBitácora): JsonResponse
    {
        $detalleBitácora->delete();
        return response()->json(null, 204);
    }
}
