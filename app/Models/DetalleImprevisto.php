<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleImprevisto extends Model
{
    protected $table = 'detalle_imprevisto';
    protected $fillable = [
        'imprevisto_id',
        'detalle_gasto_variado_id',
    ];

    public $timestamps = false;

    public function imprevisto()
    {
        return $this->belongsTo(Imprevisto::class);
    }

    public function detalleGastoVariado()
    {
        return $this->belongsTo(DetalleGastoVariado::class);
    }
}
