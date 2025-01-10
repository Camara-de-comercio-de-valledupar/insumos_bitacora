<?php

namespace Database\Factories;

use App\Models\EstadoCombustible;
use App\Models\TipoVehículo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehículo>
 */
class VehículoFactory extends Factory
{
    protected $model = \App\Models\Vehículo::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marca' => $this->faker->word,
            'modelo' => $this->faker->word,
            'placa' => $this->faker->word,
            'color' => $this->faker->word,
            'tipo_vehículo_id' => TipoVehículo::factory(),
            'estado_combustible_id' => EstadoCombustible::factory(),
            'kilometraje' => $this->faker->randomNumber(),
        ];
    }
}
