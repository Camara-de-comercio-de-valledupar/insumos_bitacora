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
            'vehiculo_id' => 'required|integer|exists:App\Models\Vehículo,id',
            'dia' => 'required|integer',
            'usuario' => 'nullable|string|max:255',
            'observaciones'=> 'nullable|string|max:255',
            'hora_salida' => 'required|date_format:H:i',
            'km_salida' => 'required|integer',
            'tanque_salida' => 'required|string',
            'hora_llegada' => 'required|date_format:H:i',
            'km_llegada' => 'required|integer',
            'tanque_llegada' => 'required|string',
            'gasolina_galones_compradas' => 'required|integer',
            'gasolina_precio' => 'required|integer',
            'responsable' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
       return [
           'vehiculo_id.required' => 'El id del vehiculo es requerido.',
           'vehiculo_id.integer' => 'El id del vehiculo debe ser un entero.',
           'vehiculo_id.exists' => 'El id del vehiculo no existe.',
           'dia.required' => 'El valor es requerido.',
           'dia.integer' => 'El valor debe ser un entero.',
           'usuario.string' => 'El usuario debe ser un texto.',
           'usuario.max' => 'El usuario debe tener como maximo 255 caracteres.',
           'observaciones.required' => 'La observaciones es requerido.',
           'observaciones.string' => 'La observaciones debe ser un texto.',
           'observaciones.max' => 'La observaciones debe tener como maximo 255 caracteres.',
           'hora_salida.required' => 'La hora de salida es requerido.',
           'hora_salida.date_format' => 'La hora de salida debe tener formato de fecha.',
           'km_salida.required' => 'La km_salida es requerido.',
           'km_salida.integer' => 'La km_salida debe ser un entero.',
           'tanque_salida.required' => 'La tanque_salida es requerido.',
           'tanque_salida.'
       ];
    }

    public function getVehículoId(): int
    {
        return $this->input('vehiculo_id');
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


    private function buscarBitácoraActual($vehiculoId): Bitácora
    {
        $bitácora = Bitácora::query()
            ->firstWhere(
                'vehiculo_id',
                '=',
                $vehiculoId
            );

        if(!$bitácora) $bitácora = new Bitácora();


            $mesActual = Carbon::now()->month;
            $anioActual = Carbon::now()->year;
            $bitácora->setMes($mesActual);
            $bitácora->setAnio($anioActual);
            $bitácora->setVehículoId($vehiculoId);
            $bitácora->save();


            return $bitácora;

    }
}
