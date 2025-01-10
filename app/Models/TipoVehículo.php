<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehículo extends Model
{
    use HasFactory;

    protected $table = 'tipo_vehículo';
    protected $fillable = ['nombre'];
    public $timestamps = false;


    public function vehículos()
    {
        return $this->hasMany(Vehículo::class);
    }
}
