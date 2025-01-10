<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imprevisto extends Model
{
    protected $table = 'imprevistos';
    protected $fillable = ['descripción', 'vehículo_conductor_id'];
    public $timestamps = false;



    public function vehículoConductor()
    {
        return $this->belongsTo(VehículoConductor::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleImprevisto::class);
    }
}
