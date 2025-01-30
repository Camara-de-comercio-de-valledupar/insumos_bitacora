<?php

namespace Database\Factories;

use App\Models\Vehículo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
class BitácoraFactory extends Factory
{
    public function definition(): array
    {
        $mes = Carbon::now()->month;
        $year = Carbon::now()->year;
        return [
            'mes' => $mes,
            'anio' => $year,
            'vehículo_id' => Vehículo::factory(),
        ];
    }
}
