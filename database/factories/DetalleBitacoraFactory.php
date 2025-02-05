<?php

namespace Database\Factories;

use App\Models\Bitacora;
use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

class DetalleBitacoraFactory extends Factory
{
    public function definition(): array
    {
        $estados = ['Full', '1/4', '1/2', '3/4', 'Vacío'];
        return [
            'dia' => Random::generate(2, '0-9'),
            'usuario'=>fake()->firstNameMale(),
            'observaciones'=>fake()->text(200),
            'hora_salida' => fake()->time('HH:mm'),
            'km_salida' => Random::generate(2, '0-9'),
            'tanque_salida' => $estados[array_rand($estados)],
            'hora_llegada' => fake()->time('HH:mm'),
            'km_llegada' => Random::generate(2, '0-9'),
            'tanque_llegada' => $estados[array_rand($estados)],
            'gasolina_galones_compradas' => Random::generate(5, '0-9'),
            'gasolina_precio' => Random::generate(5, '0-9'),
            'responsable' => fake()->name,
            'bitácora_id' => Bitacora::factory(),
        ];
    }
}
