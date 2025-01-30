<?php

namespace Database\Seeders;

use App\Models\Bitácora;
use App\Models\DetalleBitácora;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehículo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void {
        $vehículos = Vehículo::factory(2)->create();
        $vehículos->each(function ($item){
           $bitacora = Bitácora::factory()->create([
                'vehículo_id' => $item->id,
            ]);
           DetalleBitácora::factory(3)->create([
               'bitacora_id' => $bitacora->id,
           ]);
        });

    }
}
