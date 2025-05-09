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
use App\Models\Vehiculo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{

    public function index()
    {
        $vehiculo = Vehiculo::first();
        $bitacoras = $vehiculo->bitacoras;
        return view('bitacora.index', compact('bitacoras', 'vehiculo'));
    }

    public function create(Bitacora $bitacora)
    {
        return view('bitacora.create', compact('bitacora'));
    }

    public function store(Bitacora $bitacora, CrearBitacoraRequest $request)
    {
        $bitacora = $request->crearBitacora($bitacora);
        return redirect()->route('bitacora.show', $bitacora);
    }

    public function show(Bitacora $bitacora)
    {
        return view('bitacora.show', compact('bitacora'));
    }

    public function edit(Bitacora $bitacora, DetalleBitacora $detalleBitacora)
    {
        return view('bitacora.edit', compact('bitacora', 'detalleBitacora'));
    }

    public function update(Bitacora $bitacora, DetalleBitacora $detalleBitacora, ActualizarBitacoraRequest $request)
    {
        $bitacora = $request->actualizarBitacora($bitacora, $detalleBitacora);
        return redirect()->route('bitacora.show', $bitacora);
    }

    public function destroy(Bitacora $bitacora)
    {
        $bitacora->delete();
        return redirect()->route('bitacora.index');
    }
}
