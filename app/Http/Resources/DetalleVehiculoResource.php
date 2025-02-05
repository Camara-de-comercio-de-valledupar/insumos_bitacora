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
            'placa' => $this->getPlaca(),
            'kilometraje' => $this->getKilometraje(),
            'estado_combustible' => $this->getEstadoCombustible(),
        ];
    }
}
