<?php

namespace Database\Seeders;

use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void {
        Vehiculo::create([
            'placa' => 'JSH74E',
            'kilometraje' => '11000',
            'estado_combustible' => 'Full',
        ]);
        Vehiculo::create([
            'placa' => 'VAU577',
            'kilometraje' => '20000',
            'estado_combustible' => 'Full',
        ]);
        Vehiculo::create([
            'placa' => 'BAQ380',
            'kilometraje' => '31000',
            'estado_combustible' => 'Full',
        ]);
    }
}
