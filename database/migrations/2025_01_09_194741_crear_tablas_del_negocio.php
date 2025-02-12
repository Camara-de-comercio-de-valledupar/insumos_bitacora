<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Crear las tablas del negocio

        // Tabla tipo de vehiculos

        // Tabla de vehiculos
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id(); // Id del vehiculo
            $table->string('marca', 100); // Marca del vehiculo
            $table->string('modelo', 100); // Modelo del vehiculo
            $table->string('color', 100); // Color del vehiculo
            $table->string('placa', 6)->unique(); // Placa del vehiculo
            $table->integer('kilometraje'); // Kilometraje del vehiculo
            $table->enum('estado_combustible', ["Full", "1/4", "1/2", "3/4", "Vacio"]);
        });


        // Tabla de bitacoras
        Schema::create(
            'bitacoras',
            function (Blueprint $table) {
                $table->id(); // Id de la bitacora
                $table->foreignId('vehiculo_id')
                    ->constrained('vehiculos')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->integer('mes', false);
                $table->integer('anio', false);


                $table->unique(['mes', 'anio', 'vehiculo_id']);
            }
        );

        // Tabla de detalles de bitacoras
        Schema::create(
            'detalles_bitacoras',
            function (Blueprint $table) {
                $table->id(); // Id del detalle de la bitacora
                $table->integer('dia', false);

                $table->string('usuario', 100)->nullable();
                $table->string('observaciones', 255)->nullable();
                $table->string('hora_salida', 5)->nullable(); // Hora de salida del vehiculo -> hh:mm
                $table->integer('km_salida', false);
                $table->enum('tanque_salida', ["Full", "1/4", "1/2", "3/4", "Vacio"]);
                $table->string('hora_llegada', 5)->nullable(); // Hora de llegada del vehiculo -> hh:mm
                $table->integer('km_llegada', false);
                $table->enum('tanque_llegada', ["Full", "1/4", "1/2", "3/4", "Vacio"]);
                $table->integer('gasolina_galones_compradas', false);
                $table->integer('gasolina_precio', false);
                $table->string('responsable', 100);
                $table->foreignId('bitacora_id')
                    ->constrained('bitacoras')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->timestamps();
            }
        );
        // Disparador para actualizar el kilometraje del vehiculo
        DB::unprepared('
            CREATE TRIGGER actualizar_kilometraje
            AFTER INSERT ON detalles_bitacoras
            FOR EACH ROW
            BEGIN
                UPDATE vehiculos
                SET kilometraje =  NEW.km_llegada
                WHERE id IN (
                    SELECT vehiculo_id
                    FROM bitacoras
                    WHERE id = NEW.bitacora_id
                );
            END
        ');

        // Disparador para actualizar el estado de combustible del vehiculo
        DB::unprepared('
            CREATE TRIGGER actualizar_estado_combustible
            AFTER INSERT ON detalles_bitacoras
            FOR EACH ROW
            BEGIN
                UPDATE vehiculos
                SET estado_combustible = NEW.tanque_llegada
                WHERE id IN (
                    SELECT vehiculo_id
                    FROM bitacoras
                    WHERE id = NEW.bitacora_id
                );
            END
        ');
    }

    public function down(): void
    {
        // Borrar tablas del negocio

        Schema::dropIfExists('detalles_bitacoras');
        Schema::dropIfExists('bitacoras');
        Schema::dropIfExists('vehiculos');
    }
};
