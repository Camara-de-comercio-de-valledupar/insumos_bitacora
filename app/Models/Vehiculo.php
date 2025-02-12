<?php

namespace App\Models;

use Database\Factories\VehiculoFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Vehiculo extends Model
{
    use HasFactory;

    public $table = "vehiculos";
    public $timestamps = false;

    protected $fillable = [
        "marca",
        "modelo",
        "color",
        'placa',
        'kilometraje',
        'estado_combustible',
    ];

    public function getMarca(): string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): void
    {
        $this->marca = $marca;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): void
    {
        $this->modelo = $modelo;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }


    public function getPlaca(): string
    {
        return $this->placa;
    }

    public function setPlaca(string $placa): void
    {
        $this->placa = $placa;
    }

    public function getKilometraje(): int
    {
        return $this->kilometraje;
    }

    public function setKilometraje(int $kilometraje): void
    {
        $this->kilometraje = $kilometraje;
    }

    public function getEstadoCombustible(): string
    {
        return $this->estado_combustible;
    }

    public function setEstadoCombustible(string $estado_combustible): void
    {
        $this->estado_combustible = $estado_combustible;
    }

    public static function newFactory(): Factory
    {
        return VehiculoFactory::new();
    }
}
