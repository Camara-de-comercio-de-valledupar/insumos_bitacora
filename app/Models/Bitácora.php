<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Bitácora extends Model
{
    protected $table = 'bitácoras';
    public $timestamps = false;
    protected $fillable = [
        'mes',
        'anio',
        'vehículo_id',
    ];

    public function vehículo()
    {
        return $this->belongsTo(Vehículo::class);
    }
}
