<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $table = 'viajes';
    protected $fillable = [
        'vehículo_conductor_id',
        'origen',
        'destino',
    ];
    public $timestamps = false;

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function vehículoConductor()
    {
        return $this->belongsTo(VehículoConductor::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleViaje::class);
    }
}
