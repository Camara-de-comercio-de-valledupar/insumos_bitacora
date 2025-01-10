<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehículoConductor extends Model
{
    protected $table = 'vehículo_conductor';
    protected $fillable = ['vehículo_id', 'conductor_id'];
    public $timestamps = false;

    protected $dates = ['fecha'];

    public function vehículo()
    {
        return $this->belongsTo(Vehículo::class);
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }
}
