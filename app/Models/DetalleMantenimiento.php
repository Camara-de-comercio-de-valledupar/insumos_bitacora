<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleMantenimiento extends Model
{
    protected $table = 'detalle_mantenimiento';
    protected $fillable = [
        'mantenimiento_id',
        'insumo_id',
        'cantidad',
        'valor',
    ];
    public $timestamps = false;

    protected $casts = [
        'valor' => 'float',
        'cantidad' => 'integer',
    ];

    public function mantenimiento()
    {
        return $this->belongsTo(Mantenimiento::class);
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}
