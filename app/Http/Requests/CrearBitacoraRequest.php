<?php

namespace App\Http\Requests;

use App\Models\Bitacora;
use App\Models\DetalleBitacora;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CrearBitacoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'vehiculo_id' => 'required|integer|exists:App\Models\Vehiculo,id',
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

    public function getVehiculoId(): int
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

    public function getTanqueSalida(): string
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

    public function getTanqueLlegada(): string
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

    public function crearBitacora(): Bitacora
    {
        $bitacora=$this->buscarBitacoraActual($this->getVehiculoId());
        $detalle = $this->crearDetalleBitacora();
        $bitacora->detalles()->save($detalle);
        return $bitacora;
    }

    private function crearDetalleBitacora(): DetalleBitacora
    {
       $detalle = new DetalleBitacora();
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


    private function buscarBitacoraActual($vehiculoId): Bitacora
    {
        $bitacora = Bitacora::query()
            ->firstWhere(
                'vehiculo_id',
                '=',
                $vehiculoId
            );

        if(!$bitacora) $bitacora = new Bitacora();


            $mesActual = Carbon::now()->month;
            $anioActual = Carbon::now()->year;
            $bitacora->setMes($mesActual);
            $bitacora->setAnio($anioActual);
            $bitacora->setVehiculoId($vehiculoId);
            $bitacora->save();


            return $bitacora;

    }
}
