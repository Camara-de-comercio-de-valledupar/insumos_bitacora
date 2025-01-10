<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehículo extends Model
{
    use HasFactory;
    protected $table = 'vehículos';
    protected $fillable = ['marca', 'modelo', 'placa', 'color', 'tipo_vehículo_id', 'estado_combustible_id', 'kilometraje'];
    public $timestamps = false;

    public function tipoVehículo()
    {
        return $this->belongsTo(TipoVehículo::class);
    }

    public function conductores()
    {
        return $this->belongsToMany(Conductor::class, 'vehículo_conductor');
    }
}
