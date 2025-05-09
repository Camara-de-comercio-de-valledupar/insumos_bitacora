<x-layouts.app>

    <div style="min-height: 100vh" class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-row justify-content-between align-items-center w-100 my-5">

            <div class="d-flex flex-row gap-1 justify-content-center align-items-center cursor-pointer">
                <a href="{{ route('bitacora.show', $bitacora) }}"
                    class="text-decoration-none d-flex flex-row gap-1 justify-content-center align-items-center cursor-pointer">
                    <div class="bg-primary text-white rounded d-flex justify-content-center align-items-center"
                        style="width: 35px; height: 35px;">
                        <span class="material-icons" style="font-size: 20px;">arrow_back</span>
                    </div>
                    <span class="text-primary fw-bold d-none d-md-block">Volver a la bitácora</span>
                </a>
            </div>
            <div class="flex flex-column justify-content-center align-items-start">
                <h1 class="text-end">Registrar una novedad</h1>
                <p class="d-none d-md-block text-end text-muted">Por favor, complete el siguiente formulario para
                    registrar una novedad en
                    la
                    bitácora.
                </p>
            </div>
        </div>
        <form class="my-auto mx-auto" method="POST" action="{{ route('bitacora.store', $bitacora) }}">
            <div class="card card-body">
                <div class="d-flex flex-row flex-wrap justify-content-stretch align-items-start">
                    @csrf
                    <input type="hidden" name="bitacora_id" value="{{ $bitacora->id }}">
                    <div class="col-12 col-md-6 p-1">
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input value="{{ old('usuario') }}" type="text"
                                class="form-control {{ $errors->has('usuario') ? 'is-invalid' : '' }}" name="usuario"
                                id="usuario">
                            @error('usuario')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-1">
                        <div class="form-group">
                            <label for="responsable">Responsable</label>
                            <input x-data="{ responsable: '' }" x-effect="responsable = localStorage.getItem('conductor')"
                                x-model="responsable" x-bind:value="responsable" type="text"
                                class="form-control {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                                name="responsable" id="responsable">
                            @error('responsable')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-1">
                        <div class="form-group">
                            <label for="dia">Dia</label>
                            <input value="{{ old('dia') }}" type="date"
                                class="form-control {{ $errors->has('dia') ? 'is-invalid' : '' }}" name="dia"
                                id="dia">
                            @error('dia')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2 p-1">

                        <div class="form-group">
                            <label for="hora_salida">Hora de salida</label>
                            <input value="{{ old('hora_salida') }}" type="time"
                                class="form-control {{ $errors->has('hora_salida') ? 'is-invalid' : '' }}"
                                name="hora_salida" id="hora_salida">
                            @error('hora_salida')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2 p-1">

                        <div class="form-group">
                            <label for="km_salida">Kilometraje de salida</label>
                            <input value="{{ old('km_salida') }}" min="0" step="0.01" type="number"
                                class="form-control {{ $errors->has('km_salida') ? 'is-invalid' : '' }}"
                                name="km_salida" id="km_salida">
                            @error('km_salida')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2 p-1">

                        <div class="form-group">
                            <label for="tanque_salida">Tanque de salida</label>
                            <select value="{{ old('tanque_salida') }}" name="tanque_salida" id="tanque_salida"
                                class="form-select {{ $errors->has('tanque_salida') ? 'is-invalid' : '' }}">
                                <option value="" {{ old('tanque_salida') == '' ? 'selected' : '' }} disabled>
                                    Seleccione una opción</option>
                                <option value="Full" {{ old('tanque_salida') == 'Full' ? 'selected' : '' }}>Lleno
                                </option>
                                <option value="3/4" {{ old('tanque_salida') == '3/4' ? 'selected' : '' }}>3/4
                                <option value="1/2" {{ old('tanque_salida') == '1/2' ? 'selected' : '' }}>1/2
                                </option>
                                <option value="1/4" {{ old('tanque_salida') == '1/4' ? 'selected' : '' }}>1/4
                                </option>
                                <option value="Vacio" {{ old('tanque_salida') == 'Vacio' ? 'selected' : '' }}>Vacio
                                </option>
                                >
                            </select>
                            @error('tanque_salida')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 row-2 col-md-6 p-1">
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea rows="4" type="text" class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}"
                                name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex flex-row flex-wrap justify-content-stretch align-items-start">

                        <div class="col-12 col-md-4 p-1">

                            <div class="form-group">
                                <label for="hora_llegada">Hora de llegada</label>
                                <input value="{{ old('hora_llegada') }}" type="time"
                                    class="form-control {{ $errors->has('hora_llegada') ? 'is-invalid' : '' }}"
                                    name="hora_llegada" id="hora_llegada">
                                @error('hora_llegada')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4 p-1">

                            <div class="form-group">
                                <label for="km_llegada">Kilometraje de llegada</label>
                                <input value="{{ old('km_llegada') }}" type="number"
                                    class="form-control {{ $errors->has('km_llegada') ? 'is-invalid' : '' }}"
                                    name="km_llegada" id="km_llegada">
                                @error('km_llegada')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4 p-1">

                            <div class="form-group">
                                <label for="tanque_llegada">Tanque de llegada</label>
                                <select value="{{ old('tanque_llegada') }}" name="tanque_llegada"
                                    id="tanque_llegada"
                                    class="form-select {{ $errors->has('tanque_llegada') ? 'is-invalid' : '' }}">
                                    <option value="" {{ old('tanque_llegada') == '' ? 'selected' : '' }}
                                        disabled>Seleccione una opción</option>
                                    <option value="Full" {{ old('tanque_llegada') == 'Full' ? 'selected' : '' }}>
                                        Lleno</option>
                                    <option value="1/2" {{ old('tanque_llegada') == '1/2' ? 'selected' : '' }}>1/2
                                    </option>
                                    <option value="1/4" {{ old('tanque_llegada') == '1/4' ? 'selected' : '' }}>1/4
                                    </option>
                                    <option value="Vacio" {{ old('tanque_llegada') == 'Vacio' ? 'selected' : '' }}>
                                        Vacio</option>
                                </select>
                                @error('tanque_llegada')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-1">

                            <div class="form-group">
                                <label for="gasolina_galones_compradas">Galones comprados</label>
                                <input value="{{ old('gasolina_galones_compradas') }}" type="number"
                                    class="form-control {{ $errors->has('gasolina_galones_compradas') ? 'is-invalid' : '' }}"
                                    name="gasolina_galones_compradas" id="gasolina_galones_compradas">
                                @error('gasolina_galones_compradas')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-1">

                            <div class="form-group">
                                <label for="gasolina_precio">Precio por galon</label>
                                <input value="{{ old('gasolina_precio') }}" min="0" step="0.01"
                                    type="number"
                                    class="form-control {{ $errors->has('gasolina_precio') ? 'is-invalid' : '' }}"
                                    name="gasolina_precio" id="gasolina_precio">
                                @error('gasolina_precio')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-12 p-1">
                        <button type="submit" class="btn btn-primary">
                            <div
                                class="d-flex flex-row gap-1 justify-content-center align-items-center cursor-pointer">
                                <span class="material-icons">save</span>
                                <span>
                                    Guardar
                                </span>
                            </div>
                        </button>
                    </div>

                </div>
            </div>

        </form>
    </div>

</x-layouts.app>
