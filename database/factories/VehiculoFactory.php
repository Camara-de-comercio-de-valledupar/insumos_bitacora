<?php

namespace Database\Factories;

use App\Models\EstadoCombustible;
use App\Models\TipoVehículo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

class VehiculoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'placa' => Random::generate(6, '0-9A-Z'),
            'kilometraje' => 0,
            'estado_combustible' => 'Vacío',
        ];
    }
}
