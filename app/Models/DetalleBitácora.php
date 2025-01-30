<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class DetalleBitácora extends Model
{

    protected $table = 'detalles_bitácoras';


    protected $fillable = [
        'vehículo_id',
        'dia',
        'usuario',
        'observaciones',
        'hora_salida',
        'km_salida',
        'tanque_salida',
        'hora_llegada',
        'km_llegada',
        'tanque_llegada',
        'gasolina_galones_compradas',
        'gasolina_precio',
        'responsable',
        'bitácora_id',
    ];
}
