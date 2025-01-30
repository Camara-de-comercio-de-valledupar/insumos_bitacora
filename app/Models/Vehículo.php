<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Vehículo extends Model
{
    public $table = "vehículos";
    public $timestamps = false;

    protected $fillable = [
        'placa',
        'kilometraje',
        'estado_combustible',
    ];
}
