<?php

namespace App\Models;

use Database\Factories\DetalleBitácoraFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class DetalleBitácora extends Model
{
    use HasFactory;

    protected $table = 'detalles_bitácoras';
    protected $fillable = [
        'vehículo_id',
        'dia',
        'usuario',
        'observaciones',
        'hora_salida',
        'km_salida',
        'tanque_salida',
        'hora_llegada',
        'km_llegada',
        'tanque_llegada',
        'gasolina_galones_compradas',
        'gasolina_precio',
        'responsable',
        'bitácora_id',
    ];


    public function getVehículoId(): int
    {
        return $this->vehículo_id;
    }

    public function setVehículoId(int $vehículoId): void
    {
        $this->vehículo_id = $vehículoId;
    }

    public function getDia(): string
    {
        return $this->dia;
    }

    public function setDia(string $dia): void
    {
        $this->dia = $dia;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function getObservaciones(): string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): void
    {
        $this->observaciones = $observaciones;
    }

    public function getHoraSalida(): string
    {
        return $this->hora_salida;
    }

    public function setHoraSalida(string $horaSalida): void
    {
        $this->hora_salida = $horaSalida;
    }

    public function getKmSalida(): int
    {
        return $this->km_salida;
    }

    public function setKmSalida(int $kmSalida): void
    {
        $this->km_salida = $kmSalida;
    }

    public function getTanqueSalida(): float
    {
        return $this->tanque_salida;
    }

    public function setTanqueSalida(float $tanqueSalida): void
    {
        $this->tanque_salida = $tanqueSalida;
    }

    public function getHoraLlegada(): string
    {
        return $this->hora_llegada;
    }

    public function setHoraLlegada(string $horaLlegada): void
    {
        $this->hora_llegada = $horaLlegada;
    }

    public function getKmLlegada(): int
    {
        return $this->km_llegada;
    }

    public function setKmLlegada(int $kmLlegada): void
    {
        $this->km_llegada = $kmLlegada;
    }

    public function getTanqueLlegada(): float
    {
        return $this->tanque_llegada;
    }

    public function setTanqueLlegada(float $tanqueLlegada): void
    {
        $this->tanque_llegada = $tanqueLlegada;
    }

    public function getGasolinaGalonesCompradas(): float
    {
        return $this->gasolina_galones_compradas;
    }

    public function setGasolinaGalonesCompradas(float $gasolinaGalonesCompradas): void
    {
        $this->gasolina_galones_compradas = $gasolinaGalonesCompradas;
    }

    public function getGasolinaPrecio(): float
    {
        return $this->gasolina_precio;
    }

    public function setGasolinaPrecio(float $gasolinaPrecio): void
    {
        $this->gasolina_precio = $gasolinaPrecio;
    }

    public function getResponsable(): string
    {
        return $this->responsable;
    }

    public function setResponsable(string $responsable): void
    {
        $this->responsable = $responsable;
    }

    public function getBitácoraId(): int
    {
        return $this->bitácora_id;
    }

    public function setBitácoraId(int $bitácoraId): void
    {
        $this->bitácora_id = $bitácoraId;
    }

    public function bitácora(): BelongsTo
    {
       return $this->belongsTo(Bitácora::class);
    }

    public static function newFactory(): Factory
    {
        return DetalleBitácoraFactory::new();
    }
}
