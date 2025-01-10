<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $table = 'mantenimientos';
    protected $fillable = ['fecha', 'costo', 'vehículo_conductor_id'];
    public $timestamps = false;

    protected $dates = ['fecha'];

    public function vehículoConductor()
    {
        return $this->belongsTo(VehículoConductor::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleMantenimiento::class);
    }
}
