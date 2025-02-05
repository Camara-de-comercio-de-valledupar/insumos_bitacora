<?php

namespace App\Http\Resources;

use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BitacoraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'mes' => $this->getMes(),
            'anio' => $this->getAnio(),
            'vehiculo' => $this->vehiculo,
            'detalles' => $this->detalles,
        ];
    }
}
