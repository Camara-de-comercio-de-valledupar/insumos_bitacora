<?php

use App\Models\DetalleBitácora;
use App\Models\Vehículo;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Comando para ver las tablas de la base de datos
Artisan::command('db:tables', function () {
    $tables = DB::select('SHOW TABLES');
    $this->info(json_encode($tables, JSON_PRETTY_PRINT));
})->purpose('Show the tables of the database')->hourly();


// Comando para ver los vehículos listados en una tabla
Artisan::command('vehículos', function () {
    $vehicles = Vehículo::all();
    $headers = ['id', 'placa', 'kilometraje', 'combustible'];
    $this->table($headers, $vehicles);
});

// Comando para ver el listado de items de la bitácora actual en una tabla
Artisan::command('bitácora:hoy', function (){
    $bitacoras = DB::table('detalles_bitácoras')
        ->join('bitácoras', 'detalles_bitácoras.bitácora_id', '=', 'bitácoras.id')
        ->join('vehículos', 'bitácoras.vehículo_id', '=', 'vehículos.id')
        ->where('bitácoras.mes', now()->month)
        ->where('bitácoras.anio', now()->year)
        ->select(
            "bitácoras.mes",
            "bitácoras.anio",
            "detalles_bitácoras.dia",
            "vehículos.placa",
            "detalles_bitácoras.hora_salida",
            "detalles_bitácoras.km_salida",
            "detalles_bitácoras.tanque_salida",
            "detalles_bitácoras.hora_llegada",
            "detalles_bitácoras.km_llegada",
            "detalles_bitácoras.tanque_llegada",
            "detalles_bitácoras.gasolina_galones_compradas",
            "detalles_bitácoras.gasolina_precio",
            "detalles_bitácoras.responsable",
        )
        ->get();
    dd($bitacoras);


} );
