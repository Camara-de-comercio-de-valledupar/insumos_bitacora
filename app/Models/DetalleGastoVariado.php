<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleGastoVariado extends Model
{
    protected $table = 'detalle_gasto_variado';
    protected $fillable = ['gasto_variado_id', 'valor'];
    public $timestamps = false;

    protected $casts = [
        'valor' => 'float',
    ];

    protected $dates = [
        'fecha',
    ];

    public function gastoVariado()
    {
        return $this->belongsTo(GastoVariado::class);
    }
}
