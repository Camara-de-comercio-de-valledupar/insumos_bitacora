<?php

namespace App\Http\Requests;

use App\Models\Bitacora;
use App\Models\DetalleBitacora;
use App\Models\Vehiculo;
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
            'dia' => 'required|date_format:Y-m-d',
            'usuario' => 'string|string|max:255',
            'observaciones' => 'nullable|string|max:255',
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
            'dia.required' => 'El valor es requerido.',
            'dia.integer' => 'El valor debe ser un entero.',
            'usuario.string' => 'El usuario debe ser un texto.',
            'usuario.max' => 'El usuario debe tener como maximo 255 caracteres.',
            'observaciones.required' => 'La observaciones es requerido.',
            'observaciones.string' => 'La observaciones debe ser un texto.',
            'observaciones.max' => 'La observaciones debe tener como maximo 255 caracteres.',
            'hora_salida.required' => 'La hora de salida es requerido.',
            'hora_salida.date_format' => 'La hora de salida debe tener formato de fecha.',
            'km_salida.required' => 'Los kilometros de salida es requerido.',
            'km_salida.integer' => 'Los kilometros de salida debe ser un entero.',
            'tanque_salida.required' => 'El valor del tanque de salida es requerido.',
            'tanque_salida.string' => 'El valor del tanque de salida debe ser un texto.',
            'hora_llegada.required' => 'La hora de llegada es requerido.',
            'hora_llegada.date_format' => 'La hora de llegada debe tener formato de fecha.',
            'km_llegada.required' => 'Los kilometros de llegada es requerido.',
            'km_llegada.integer' => 'Los kilometros de llegada debe ser un entero.',
            'tanque_llegada.required' => 'El valor del tanque de llegada es requerido.',
            'tanque_llegada.string' => 'El valor del tanque de llegada debe ser un texto.',
            'gasolina_galones_compradas.required' => 'La gasolina comprada es requerida.',
            'gasolina_galones_compradas.integer' => 'La gasolina comprada debe ser un entero.',
            'gasolina_precio.required' => 'El precio de la gasolina es requerido.',
            'gasolina_precio.integer' => 'El precio de la gasolina debe ser un entero.',
            'responsable.required' => 'El responsable es requerido.',
            'responsable.string' => 'El responsable debe ser un texto.',
            'responsable.max' => 'El responsable debe tener como maximo 255 caracteres.',
        ];
    }

    public function getDia(): int
    {
        $dia = Carbon::parse($this->input('dia'));
        return $dia->day;
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

    public function crearBitacora(Bitacora $bitacora): Bitacora
    {
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
}
