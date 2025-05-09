<x-layouts.app>

    <div class="d-flex flex-row flex-wrap">

        <div x-data="{
            open: false,

        }" @click="open = !open" class="col-12 col-md-4 p-2">
            @if ($vehiculo)
                <div class="card card-body" style="height: 15rem;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <span class="material-icons text-primary" style="font-size: 4rem;">
                            directions_car
                        </span>
                        <span class="fs-4">Vehiculo</span>
                    </div>
                    <div class="d-flex flex-column gap-2 justify-content-end align-items-start h-100">
                        <span class="fw-bold fs-5">{{ $vehiculo->marca }} - {{ $vehiculo->modelo }}</span>
                        <span class="badge bg-primary fw-bold" style="font-size: 2rem;">
                            {{ $vehiculo->placa }}
                        </span>

                    </div>

                </div>
            @else
                <div class="card card-body" style="height: 15rem; background-color: #adb5bd;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <span class="material-icons text-primary" style="font-size: 4rem;">
                            directions_car
                        </span>
                        <span class="fs-4">Vehiculo</span>
                    </div>
                    <div class="d-flex flex-column gap-2 justify-content-end align-items-start h-100">
                        <span class="fw-bold fs-5">No hay vehiculo seleccionado</span>
                    </div>
                </div>
            @endif

            <div x-show="open"
                class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50">
                <div class="bg-white p-8 rounded shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Seleccionar vehiculo</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($vehiculos as $item)
                            <a href="{{ route('bitacora.index', ['vehiculo_id' => $item->id]) }}"
                                class="card card-body bg-secondary text-white text-decoration-none cursor-pointer m-3">
                                <span class="fs-4">{{ $item->marca }} - {{ $item->modelo }}</span>
                                <span class="badge bg-primary fw-bold" style="font-size: 2rem;">
                                    {{ $item->placa }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        @if ($vehiculo)
            <div class="col-12 col-md-4 p-2">
                <div class="card card-body" style="height: 15rem;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <span class="material-icons" style="font-size: 4rem;">
                            speed
                        </span>
                        <span class="fs-4">Kilometraje</span>
                    </div>
                    <div class="d-flex flex-column gap-2 justify-content-end align-items-start h-100">

                        <span style="font-size: 4rem;">
                            {{ $vehiculo->kilometraje }}
                        </span>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12 col-md-4 p-2">
                <div class="card card-body" style="height: 15rem;">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <span class="material-icons" style="font-size: 4rem;">
                            speed
                        </span>
                        <span class="fs-4">Kilometraje</span>
                    </div>
                    <div class="d-flex flex-column gap-2 justify-content-end align-items-start h-100">
                        <span style="font-size: 4rem;">
                            0
                        </span>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12 col-md-4 p-2">
            <div class="card card-body d-flex flex-column justify-content-between" style="height: 15rem;">
                <div class="d-flex flex-row gap-2 align-items-center">
                    <span class="material-icons" style="font-size: 4rem;">
                        person
                    </span>
                    <span class="fs-4">Conductor</span>
                </div>
                <div x-data="{ editable: false, conductor: '' }" x-effect="conductor = localStorage.getItem('conductor')"
                    class="d-flex flex-row gap-2 justify-content-center align-items-start">

                    <input type="text" id="conductor" name="conductor" :disable="!editable" :readonly="!editable"
                        :style="!editable ? 'background-color: #adb5bd ;' : 'background-color: white ;'"
                        class="form-control" x-model="conductor" placeholder="Nombre del conductor" />

                    <button x-show="!editable" @click="editable = !editable" type="button"
                        class="btn btn-primary btn-sm">
                        <span class="material-icons">edit</span>
                    </button>


                    <button x-show="editable"
                        @click="localStorage.setItem('conductor', conductor); editable = !editable" type="button"
                        class="btn btn-primary btn-sm ">
                        <span class="material-icons">save</span>
                    </button>

                </div>


            </div>

        </div>
    </div>
    <div class="my-5"></div>

    <div class="d-flex flex-column justify-content-center p-2">

        <span class="fs-4 fw-bold text-center text-md-start text-uppercase">Bitacoras del vehiculo</span>

        <div class="my-2"></div>


        <div class="d-flex flex-row flex-wrap">
            @foreach ($bitacoras as $bitacora)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-2">
                    <a class="card card-body bg-secondary text-white text-decoration-none"
                        href="{{ route('bitacora.show', $bitacora) }}">
                        <span class="fs-4">{{ $bitacora->anio }} -
                            {{ \Carbon\Carbon::create($bitacora->anio, $bitacora->mes)->format('F', 'ES') }}</span>
                    </a>
                </div>
            @endforeach

            @if (
                !$bitacoras->contains(function ($bitacora) {
                    return $bitacora->anio == Carbon\Carbon::now()->year && $bitacora->mes == Carbon\Carbon::now()->month;
                }))
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-2">
                    <form action="{{ route('bitacora.createBitacora') }}" method="POST">
                        @csrf
                        <button type="submit" class="card card-body bg-secondary text-white text-decoration-none">
                            <span class="fs-4">Crear Bitácora ({{ Carbon\Carbon::now()->format('Y - F') }})</span>
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </div>

</x-layouts.app>
