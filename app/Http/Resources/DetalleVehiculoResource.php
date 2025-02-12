<?php

namespace App\Http\Resources;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Vehiculo
 */
class DetalleVehiculoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'marca' => $this->getMarca(),
            'modelo' => $this->getModelo(),
            'color' => $this->getColor(),
            'placa' => $this->getPlaca(),
            'kilometraje' => $this->getKilometraje(),
            'estado_combustible' => $this->getEstadoCombustible(),
        ];
    }
}
