<?php

namespace App\Models;

use Database\Factories\VehículoFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Vehículo extends Model
{
    use HasFactory;

    public $table = "vehículos";
    public $timestamps = false;

    protected $fillable = [
        'placa',
        'kilometraje',
        'estado_combustible',
    ];


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
        return VehículoFactory::new();
    }
}
