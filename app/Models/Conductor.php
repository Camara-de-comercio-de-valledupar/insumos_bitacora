<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;
    protected $table = 'conductores';
    protected $fillable = ['nombre', 'apellido', 'cédula', 'teléfono'];
    public $timestamps = false;

    public function vehículos()
    {
        return $this->belongsToMany(Vehículo::class, 'vehículo_conductor');
    }
}
