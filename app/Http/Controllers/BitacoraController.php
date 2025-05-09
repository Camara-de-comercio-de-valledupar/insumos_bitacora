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

    public function index(Request $request)
    {

        $vehiculoId = $request->get('vehiculo_id');
        if ($vehiculoId) {
            // Guardar variable en session
            session(['vehiculo_id' => $vehiculoId]);
        } else {
            $vehiculoId = session('vehiculo_id');
        }
        if ($vehiculoId) {
            $vehiculo = Vehiculo::find($vehiculoId);
            $bitacoras = $vehiculo->bitacoras()->get();
        } else {
            $vehiculo = null;
            $bitacoras = Bitacora::all();
        }
        $vehiculos = Vehiculo::all();
        return view('bitacora.index', compact('bitacoras', 'vehiculos', 'vehiculo'));
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

    public function destroy(Bitacora $bitacora, DetalleBitacora $detalleBitacora)
    {
        $detalleBitacora->delete();
        return redirect()->route('bitacora.index');
    }

    public function createBitacora()
    {
        if (!session('vehiculo_id')) {
            return redirect()->route('bitacora.index')->with('error', 'No se ha seleccionado un vehículo.');
        }
        $vehiculo = Vehiculo::find(session('vehiculo_id'));
        $bitacora = Bitacora::create([
            'vehiculo_id' => $vehiculo->id,
            'mes' => date('m'),
            'anio' => date('Y'),
        ]);
        return redirect()->route('bitacora.show', $bitacora);
    }
}
