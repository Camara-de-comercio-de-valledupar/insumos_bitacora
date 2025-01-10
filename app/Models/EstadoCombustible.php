<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCombustible extends Model
{
    use HasFactory;
    protected $table = 'estado_combustible';
    protected $fillable = [
        'nombre',
        'porcentaje',
    ];
    public $timestamps = false;
}
