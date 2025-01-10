<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleViaje extends Model
{
    protected $table = 'detalle_viaje';
    protected $fillable = [
        'viaje_id',
        'detalle_gasto_variado_id',
        'cantidad',
        'valor',
    ];
    public $timestamps = false;

    protected $casts = [
        'valor' => 'float',
        'cantidad' => 'integer',
    ];

    public function viaje()
    {
        return $this->belongsTo(Viaje::class);
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}
