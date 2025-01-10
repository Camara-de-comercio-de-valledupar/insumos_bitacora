<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngresoCombustible extends Model
{
    protected $table = 'ingreso_combustible';
    protected $fillable = [
        'vehículo_conductor_id',
        'estado_combustible_id',
        'valor',
        'fecha',
    ];
    public $timestamps = false;

    protected $casts = [
        'valor' => 'float',
    ];

    protected $dates = ['fecha'];

    public function vehículoConductor()
    {
        return $this->belongsTo(VehículoConductor::class);
    }

    public function estadoCombustible()
    {
        return $this->belongsTo(EstadoCombustible::class);
    }
}
