<?php

namespace Database\Factories;

use App\Models\EstadoCombustible;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EstadoCombustible>
 */
class EstadoCombustibleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estados = $this->obtenerEstados();
        $estado = $this->definirEstado($estados);

        $nombre = array_search($estado, $estados);
        $porcentaje = $estado;
        return [
            'nombre' => $nombre,
            'porcentaje' => $porcentaje,
        ];
    }

    private function obtenerEstados(): array
    {
        return [
            'Vació' => 0,
            '1/4' => 25,
            '1/2' => 50,
            '3/4' => 75,
            'Lleno' => 100,
        ];
    }

    private function definirEstado(array $estados): int
    {
        $estado = $this->faker->randomElement($estados);
        // Validar si ya hay un registro con el mismo estado
        $estado = EstadoCombustible::where('porcentaje', $estado)->exists()
            ? $this->definirEstado($estados)
            : $estado;

        return $estado;
    }
}
