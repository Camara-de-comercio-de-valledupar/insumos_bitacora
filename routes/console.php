<?php

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
