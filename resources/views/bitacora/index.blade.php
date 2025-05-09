<x-layouts.app>

    <div class="d-flex flex-row flex-wrap">
        <div class="col-12 col-md-4 p-2">
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
        </div>
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

        <div class="d-flex flex-row flex-wrap gap-2">
            @foreach ($bitacoras as $bitacora)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-2">
                    <a class="card card-body bg-secondary text-white text-decoration-none"
                        href="{{ route('bitacora.show', $bitacora) }}">
                        <span class="fs-4">{{ $bitacora->anio }} -
                            {{ \Carbon\Carbon::create($bitacora->anio, $bitacora->mes)->format('F', 'ES') }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

</x-layouts.app>
