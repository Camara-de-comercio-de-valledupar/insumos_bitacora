<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear las tablas del negocio

        // Tabla tipo de vehículos

        Schema::create('tipo_vehículo', function (Blueprint $table) {
            $table->id(); // Id del tipo de vehículo
            $table->string('nombre'); // Nombre del tipo de vehículo
        });

        // Tabla de estado de combustible

        Schema::create('estado_combustible', function (Blueprint $table) {
            $table->id(); // Id del estado de combustible
            $table->string('nombre')->unique(); // Nombre del estado de combustible
            $table->integer('porcentaje'); // Porcentaje del estado de combustible
        });



        // Tabla de vehículos
        Schema::create('vehículos', function (Blueprint $table) {
            $table->id(); // Id del vehículo
            // VARCHAR -> string(255)
            // INT -> integer
            $table->string('marca', 100); // Marca del vehículo
            $table->string('modelo', 20); // Modelo del vehículo. Ej: 2020, 2021 o 2021 beta alfa
            $table->string('placa', 6)->unique(); // Placa del vehículo
            $table->string('color', 20); // Color del vehículo
            $table->integer('kilometraje'); // Kilometraje del vehículo
            $table->foreignId('estado_combustible_id')
                ->nullable()
                ->constrained('estado_combustible')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Tipo de vehículo (Llave foránea)
            // Cada vez que actualiza la tabla tipo_vehículo, se actualiza la tabla vehículos
            // Cada vez que se elimina el registro se coloca la llave en valor nulo
            $table->foreignId('tipo_vehículo_id')
                ->nullable()
                ->constrained('tipo_vehículo')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });


        // Tabla de conductores

        Schema::create('conductores', function (Blueprint $table) {
            $table->id(); // Id del conductor
            $table->string('nombre', 100); // Nombre del conductor
            $table->string('apellido', 100); // Apellido del conductor
            $table->string('cédula', 15); // Cédula del conductor
            $table->string('teléfono', 10); // Teléfono del conductor
            $table->unsignedBigInteger('funcionario_id')
                ->nullable();
        });

        // Tabla de vehículos-conductores. Cuando un conductor maneja un vehículo
        // (Relación muchos a muchos)
        Schema::create('vehículo_conductor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehículo_id') // Llave foránea de vehículos
                ->constrained('vehículos')
                ->cascadeOnDelete();
            $table->foreignId('conductor_id') // Llave foránea de conductores
                ->constrained('conductores')
                ->cascadeOnDelete();
            $table->timestamp('fecha'); // Fecha en la que el conductor maneja el vehículo
        });

        // Tabla de ingreso de gasolina
        Schema::create('ingreso_combustible', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehículo_conductor_id') // Llave foránea de vehículos
                ->constrained('vehículo_conductor')
                ->cascadeOnDelete();
            $table->foreignId('estado_combustible_id') // Llave foránea de estado_combustible
                ->constrained('estado_combustible')
                ->cascadeOnDelete();
            $table->decimal('valor', 8, 0); // Precio del galón
            $table->timestamp('fecha'); // Fecha del ingreso de gasolina
        });

        // Disparador que actualiza el estado de combustible del vehículo
        DB::unprepared('
            CREATE TRIGGER actualizar_estado_combustible
            AFTER INSERT
            ON ingreso_combustible
            FOR EACH ROW
            BEGIN
                UPDATE vehículos
                SET estado_combustible_id = NEW.estado_combustible_id
                WHERE vehículos.id = (SELECT vehículo_id FROM vehículo_conductor WHERE vehículo_conductor.id = NEW.vehículo_conductor_id);
            END
        ');

        // Tabla de mantenimientos
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehículo_conductor_id') // Llave foránea de vehículo_conductor (Momento en el que el conductor maneja el vehículo)
                ->constrained('vehículo_conductor')
                ->cascadeOnDelete();
            $table->string('descripción', 255);  // Descripción del mantenimiento
            $table->timestamp('fecha'); // Fecha del mantenimiento
        });

        // Tabla de insumos
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('descripción', 255);  // Descripción del insumo
        });

        // Tabla de detalle_mantenimiento (Relación muchos a muchos)
        // Un mantenimiento puede tener varios insumos
        Schema::create('detalle_mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mantenimiento_id') // Llave foránea de mantenimientos
                ->constrained('mantenimientos')
                ->cascadeOnDelete();
            $table->foreignId('insumo_id') // Llave foránea de insumos
                ->constrained('insumos')
                ->cascadeOnDelete();
            $table->integer('cantidad'); // Cantidad de insumos
            $table->decimal('valor', 8, 0); // Precio del insumo
        });

        // Tabla de gasto variado
        Schema::create('gasto_variado', function (Blueprint $table) {
            $table->id();
            $table->string('descripción', 255);  // Descripción del gasto
        });

        // Tabla de detalle_gasto_variado (Relación muchos a muchos)
        // Un detalle de gasto variado solo puede tener un gasto variado, valor del gasto y fecha del gasto
        Schema::create('detalle_gasto_variado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gasto_variado_id') // Llave foránea de gasto_variado
                ->constrained('gasto_variado')
                ->cascadeOnDelete();
            $table->decimal('valor', 8, 0); // Precio del gasto
            $table->timestamp('fecha'); // Fecha del gasto
        });

        // Tabla de imprevistos
        Schema::create('imprevistos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehículo_conductor_id') // Llave foránea de vehículo_conductor (Momento en el que el conductor maneja el vehículo)
                ->constrained('vehículo_conductor')
                ->cascadeOnDelete();
            $table->string('descripción', 255);  // Descripción del imprevisto
            $table->timestamp('fecha'); // Fecha del imprevisto
        });

        // Tabla de detalle_imprevistos (Relación muchos a muchos)
        // Un detalle de imprevistos solo puede tener multiples detalles de gasto variado
        Schema::create('detalle_imprevisto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imprevisto_id') // Llave foránea de imprevistos
                ->constrained('imprevistos')
                ->cascadeOnDelete();
            $table->foreignId('detalle_gasto_variado_id') // Llave foránea de detalle_gasto_variado
                ->constrained('detalle_gasto_variado')
                ->cascadeOnDelete();
        });


        // Tabla de viajes
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehículo_conductor_id') // Llave foránea de vehículo_conductor (Momento en el que el conductor maneja el vehículo)
                ->constrained('vehículo_conductor')
                ->cascadeOnDelete();
            $table->string('origen', 255);  // Origen del viaje
            $table->string('destino', 255);  // Destino del viaje
            $table->decimal('kilometraje_inicial', 8, 0); // Kilometraje inicial del viaje
            $table->decimal('kilometraje_final', 8, 0); // Kilometraje final del viaje
            $table->timestamp('fecha_inicio'); // Fecha de inicio del viaje
            $table->timestamp('fecha_fin'); // Fecha de fin del viaje
        });


        // Disparador que actualiza el kilometraje del vehículo
        DB::unprepared('
            CREATE TRIGGER actualizar_kilometraje
            AFTER INSERT
            ON viajes
            FOR EACH ROW
            BEGIN
                UPDATE vehículos
                SET kilometraje = NEW.kilometraje_final
                WHERE vehículos.id = (SELECT vehículo_id FROM vehículo_conductor WHERE vehículo_conductor.id = NEW.vehículo_conductor_id);
            END
        ');



        // Tabla de detalle de viajes (Relación muchos a muchos)
        // Un detalle de viajes solo puede tener un viaje, un detalle de gasto variado 
        Schema::create('detalle_viaje', function (Blueprint $table) {
            $table->id();
            $table->foreignId('viaje_id') // Llave foránea de viajes
                ->constrained('viajes')
                ->cascadeOnDelete();
            $table->foreignId('detalle_gasto_variado_id') // Llave foránea de detalle_gasto_variado
                ->constrained('detalle_gasto_variado')
                ->cascadeOnDelete();
        });

        // Tabla de tipo de evidencias
        Schema::create('tipo_evidencia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del tipo de evidencia
            $table->string('extensiones_permitidas'); // Extensiones permitidas
        });


        // Tabla de evidencias (Fotos o Archivos) (Relación de uno a muchos polimorfa)
        Schema::create('evidencias', function (Blueprint $table) {
            $table->id();
            $table->string('ruta'); // Ruta de la evidencia
            $table->foreignId('tipo_evidencia_id') // Llave foránea de tipo_evidencia
                ->constrained('tipo_evidencia')
                ->cascadeOnDelete();
            $table->morphs('evidenciable'); // Polimorfismo
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        // Borrar tablas del negocio

        Schema::dropIfExists('evidencias');
        Schema::dropIfExists('tipo_evidencia');
        Schema::dropIfExists('detalle_viaje');
        Schema::dropIfExists('viajes');
        Schema::dropIfExists('detalle_imprevisto');
        Schema::dropIfExists('imprevistos');
        Schema::dropIfExists('detalle_gasto_variado');
        Schema::dropIfExists('gasto_variado');
        Schema::dropIfExists('detalle_mantenimiento');
        Schema::dropIfExists('insumos');
        Schema::dropIfExists('mantenimientos');
        DB::unprepared('DROP TRIGGER actualizar_cantidad_galones');
        Schema::dropIfExists('ingreso_gasolina');
        Schema::dropIfExists('vehículo_conductor');
        Schema::dropIfExists('conductores');
        Schema::dropIfExists('vehículos');
        Schema::dropIfExists('estado_combustible');
        Schema::dropIfExists('tipo_vehículo');
    }
};
