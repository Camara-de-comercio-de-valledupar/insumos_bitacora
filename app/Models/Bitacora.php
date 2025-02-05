<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Bitacora extends Model
{

    use HasFactory;

    protected $table = 'bitacoras';
    public $timestamps = false;
    protected $fillable = [
        'mes',
        'anio',
        'vehiculo_id',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, "vehiculo_id", "id");
    }

    public function getMes(): int
    {
        return $this->mes;
    }

    public function getAnio(): int
    {
       return $this->anio;
    }

    public function getVehiculoId(): int
    {
        return $this->vehiculo_id;
    }

    public function setMes($mes): void
    {
       $this->mes = $mes;
    }

    public function setAnio($anio): void
    {
        $this->anio= $anio;
    }

    public function setVehiculoId($vehiculoId): void
    {
        $this->vehiculo_id = $vehiculoId;
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleBitacora::class);
    }
}

