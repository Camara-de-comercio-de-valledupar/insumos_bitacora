<x-layouts.app>
    {{-- Formato de tabla --}}
    <div class="d-none d-md-block card card-body my-md-5">
        <table class="table table-hover">
            <thead>
                <tr colspan="6">
                    <th scope="col" colspan="6">
                        <span class="d-flex justify-content-between">
                            <a href="{{ route('bitacora.index') }}" class="btn btn-secondary btn-sm">
                                <span class="material-icons">keyboard_backspace</span>

                            </a>
                            <span class="fs-4">Bitácora de {{ $bitacora->anio }} -
                                {{ \Carbon\Carbon::create($bitacora->anio, $bitacora->mes)->format('F', 'ES') }}</span>
                        </span>
                    </th>
                </tr>
                <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Criterios de salida</th>
                    <th scope="col">Criterios de llegada</th>
                    <th scope="col">Compras</th>
                    <th scope="col">Responsable</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bitacora->detalles as $detalleBitacora)
                    <tr>
                        <td>{{ $detalleBitacora->usuario }}</td>
                        <td>{{ $detalleBitacora->dia }}</td>
                        <td>
                            <span>Hora: {{ $detalleBitacora->hora_salida }}</span>
                            <br>
                            <span>Kilometraje: {{ $detalleBitacora->km_salida }}</span>
                            <br>
                            <span>Tanque: {{ $detalleBitacora->tanque_salida }}</span>
                        </td>
                        <td>
                            <span>Hora: {{ $detalleBitacora->hora_llegada }}</span>
                            <br>
                            <span>Kilometraje: {{ $detalleBitacora->km_llegada }}</span>
                            <br>
                            <span>Tanque: {{ $detalleBitacora->tanque_llegada }}</span>
                        </td>
                        <td>
                            @if ($detalleBitacora->gasolina_galones_compradas == 0)
                                <span>Sin compras</span>
                            @else
                                <span>({{ $detalleBitacora->gasolina_galones_compradas }}) galones a
                                    {{ number_format($detalleBitacora->gasolina_precio, 2) }}</span>
                            @endif
                        </td>
                        <td>
                            <span>{{ $detalleBitacora->responsable }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-row justify-content-end align-items-center gap-2">
                                <a href="{{ route('bitacora.edit', ['bitacora' => $bitacora, 'detalleBitacora' => $detalleBitacora]) }}"
                                    class="btn btn-primary btn-sm d-flex justify-content-center align-items-center">
                                    <span class="material-icons">edit</span>
                                </a>
                                <form
                                    action="{{ route('bitacora.destroy', ['bitacora' => $bitacora, 'detalleBitacora' => $detalleBitacora]) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm d-flex justify-content-center align-items-center">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6">
                        <span class="d-flex justify-content-between">
                            <a class="text-decoration-none d-flex flex-row gap-1 justify-content-center align-items-center cursor-pointer"
                                href="{{ route('bitacora.create', ['bitacora' => $bitacora->id]) }}">
                                <div class="bg-primary text-white rounded d-flex justify-content-center align-items-center"
                                    style="width: 35px; height: 35px;">

                                    <span class="material-icons" style="font-size: 20px;">edit</span>
                                </div>
                                <span class="text-primary fw-bold">Anotar una novedad</span>
                            </a>
                            <span class="fs-5 fw-bold">Total de registros: {{ $bitacora->detalles->count() }}</span>
                        </span>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    {{-- Formato de lista de tarjetas --}}
    <div class="d-md-none d-flex flex-column justify-content-center p-2 gap-2">
        <span class="fs-4 fw-bold text-center text-md-start text-uppercase">Bitácora de {{ $bitacora->anio }} -
            {{ \Carbon\Carbon::create($bitacora->anio, $bitacora->mes)->format('F', 'ES') }}</span>
        <div class="my-2"></div>
        @foreach ($bitacora->detalles as $detalleBitacora)
            <a href="{{ route('bitacora.edit', ['bitacora' => $bitacora, 'detalleBitacora' => $detalleBitacora]) }}"
                class="card card-body text-decoration-none">
                <span class="fs-4">{{ $detalleBitacora->usuario }} - {{ $detalleBitacora->dia }}</span>
                <span class="fs-6">Hora de salida: {{ $detalleBitacora->hora_salida }}</span>
                <span class="fs-6">Kilometraje de salida: {{ $detalleBitacora->km_salida }}</span>
                <span class="fs-6">Tanque de salida: {{ $detalleBitacora->tanque_salida }}</span>
                <span class="fs-6">Hora de llegada: {{ $detalleBitacora->hora_llegada }}</span>
                <span class="fs-6">Kilometraje de llegada: {{ $detalleBitacora->km_llegada }}</span>
                <span class="fs-6">Tanque de llegada: {{ $detalleBitacora->tanque_llegada }}</span>
                <span class="fs-6">Compras: {{ $detalleBitacora->gasolina_galones_compradas }} galones a
                    {{ number_format($detalleBitacora->gasolina_precio, 2) }}</span>
                <span class="fs-6">Responsable: {{ $detalleBitacora->responsable }}</span>
                <div class="d-flex flex-row justify-content-end align-items-center gap-2">

                    <form
                        action="{{ route('bitacora.destroy', ['bitacora' => $bitacora, 'detalleBitacora' => $detalleBitacora]) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-danger btn-sm d-flex justify-content-center align-items-center">
                            <span class="material-icons">delete</span>
                        </button>
                    </form>
                </div>
            </a>
        @endforeach
        <a href="{{ route('bitacora.create', ['bitacora' => $bitacora->id]) }}"
            class="card card-body bg-primary text-white text-decoration-none">
            <span class="fs-4">Anotar una novedad</span>
            <span class="fs-6">Total de registros: {{ $bitacora->detalles->count() }}</span>
        </a>
    </div>

</x-layouts.app>
