<?php

namespace Database\Seeders;

use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Vehiculo::create([
            "marca" => "Jeep",
            "modelo" => "Cherokee",
            'placa' => 'ZIF084',
            "color" => "negro",
            'kilometraje' => '322279',
            'estado_combustible' => 'Vacio',
        ]);
        Vehiculo::create([
            "marca" => "Ford",
            "modelo" => "F150",
            'placa' => 'VAU577',
            "color" => "negro",
            'kilometraje' => '327953',
            'estado_combustible' => 'Full',
        ]);
        Vehiculo::create([
            "marca" => "Toyota",
            "modelo" => "Fortuner",
            "color" => "blanco",
            'placa' => 'VAQ380',
            'kilometraje' => '240505',
            'estado_combustible' => 'Full',
        ]);
        Vehiculo::create([
            "placa" => "JSH74E",
            "marca" => "Yamaha",
            "modelo" => "FZ",
            "color" => "rojo vino tinto",
            "kilometraje" => "0",
            "estado_combustible" => "Vacio",
        ]);
    }
}
