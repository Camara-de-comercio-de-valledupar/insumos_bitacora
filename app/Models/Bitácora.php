<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Bitácora extends Model
{

    use HasFactory;

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

    public function getMes(): int
    {
        return $this->mes;
    }

    public function getAnio(): int
    {
       return $this->anio;
    }

    public function getVehículoId(): int
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

    public function setVehículoId($vehículoId): void
    {
        $this->vehículo_id = $vehículoId;
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleBitácora::class);
    }
}

