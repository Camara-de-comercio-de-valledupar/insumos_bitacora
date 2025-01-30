<?php

namespace App\Http\Requests;

use App\Models\Bitácora;
use App\Models\DetalleBitácora;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CrearBitácoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'vehículo_id' => 'required|integer|exists:App\Models\Vehículo',
            'dia' => 'required|integer',
            'usuario' => 'nullable|string|max:255',
            'observaciones'=> 'nullable|string|max:255',
            'hora_salida' => 'required|date_format:H:i',
            'km_salida' => 'required|integer',
            'tanque_salida' => 'required|integer',
            'hora_llegada' => 'required|date_format:H:i',
            'km_llegada' => 'required|integer',
            'tanque_llegada' => 'required|integer',
            'gasolina_galones_compradas' => 'required|integer',
            'gasolina_precio' => 'required|integer',
            'responsable' => 'required|string|max:255',
        ];
    }

    public function getVehículoId(): int
    {
        return $this->input('vehículo_id');
    }

    public function getDia(): int
    {
        return $this->input('dia');
    }

    public function getUsuario(): ?string
    {
        return $this->input('usuario');
    }

    public function getObservaciones(): ?string
    {
        return $this->input('observaciones');
    }

    public function getHoraSalida(): string
    {
        return $this->input('hora_salida');
    }

    public function getKmSalida(): int
    {
        return $this->input('km_salida');
    }

    public function getTanqueSalida(): int
    {
        return $this->input('tanque_salida');
    }

    public function getHoraLlegada(): string
    {
        return $this->input('hora_llegada');
    }

    public function getKmLlegada(): int
    {
        return $this->input('km_llegada');
    }

    public function getTanqueLlegada(): int
    {
        return $this->input('tanque_llegada');
    }

    public function getGasolinaGalonesCompradas(): int
    {
        return $this->input('gasolina_galones_compradas');
    }

    public function getGasolinaPrecio(): int
    {
        return $this->input('gasolina_precio');
    }

    public function getResponsable(): string
    {
        return $this->input('responsable');
    }

    public function crearBitácora(): Bitácora
    {
        $bitácora=$this->buscarBitácoraActual($this->getVehículoId());
        $detalle = $this->crearDetalleBitácora();
        $bitácora->detalles()->save($detalle);
        return $bitácora;
    }

    private function crearDetalleBitácora(): DetalleBitácora
    {
       $detalle = new DetalleBitácora();
       $detalle->setDia($this->getDia());
       $detalle->setUsuario($this->getUsuario());
       $detalle->setObservaciones($this->getObservaciones());
       $detalle->setHoraSalida($this->getHoraSalida());
       $detalle->setKmSalida($this->getKmSalida());
       $detalle->setTanqueSalida($this->getTanqueSalida());
       $detalle->setHoraLlegada($this->getHoraLlegada());
       $detalle->setKmLlegada($this->getKmLlegada());
       $detalle->setTanqueLlegada($this->getTanqueLlegada());
       $detalle->setGasolinaGalonesCompradas($this->getGasolinaGalonesCompradas());
       $detalle->setGasolinaPrecio($this->getGasolinaPrecio());
       $detalle->setResponsable($this->getResponsable());
       return $detalle;
    }


    private function buscarBitácoraActual($vehículoId): Bitácora
    {
        $bitácora = Bitácora::query()
            ->firstWhere([
                'vehículo_id',
                '=',
                $vehículoId
            ]);

        if(!$bitácora) $bitácora = new Bitácora();


            $mesActual = Carbon::now()->month;
            $anioActual = Carbon::now()->year;
            $bitácora->setMes($mesActual);
            $bitácora->setAnio($anioActual);
            $bitácora->setVehículoId($vehículoId);
            $bitácora->save();


            return $bitácora;

    }
}
