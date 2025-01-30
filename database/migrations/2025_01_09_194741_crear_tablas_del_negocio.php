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

        // Tabla de vehículos
        Schema::create('vehículos', function (Blueprint $table) {
            $table->id(); // Id del vehículo
            $table->string('placa', 6)->unique(); // Placa del vehículo
            $table->integer('kilometraje'); // Kilometraje del vehículo
            $table->enum('estado_combustible', ["Full", "1/4", "1/2", "3/4", "Vació"]);
        });


        // Tabla de bitácoras
        Schema::create(
            'bitácoras',
            function (Blueprint $table) {
                $table->id(); // Id de la bitácora
                $table->foreignId('vehículo_id')
                    ->constrained('vehículos')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->integer('mes', false);
                $table->integer('anio', false);


                $table->unique(['mes', 'anio', 'vehículo_id']);
            }
        );

        // Tabla de detalles de bitácoras
        Schema::create(
            'detalles_bitácoras',
            function (Blueprint $table) {
                $table->id(); // Id del detalle de la bitácora
                $table->integer('dia', false);

                $table->string('usuario', 100)->nullable();
                $table->string('observaciones', 255)->nullable();
                $table->string('hora_salida', 5)->nullable(); // Hora de salida del vehículo -> hh:mm
                $table->integer('km_salida', false);
                $table->enum('tanque_salida', ["Full", "1/4", "1/2", "3/4", "Vació"]);
                $table->string('hora_llegada', 5)->nullable(); // Hora de llegada del vehículo -> hh:mm
                $table->integer('km_llegada', false);
                $table->enum('tanque_llegada', ["Full", "1/4", "1/2", "3/4", "Vació"]);
                $table->integer('gasolina_galones_compradas', false);
                $table->integer('gasolina_precio', false);
                $table->string('responsable', 100);
                $table->foreignId('bitácora_id')
                    ->constrained('bitácoras')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            }
        );
        // Disparador para actualizar el kilometraje del vehículo
        DB::unprepared('
            CREATE TRIGGER actualizar_kilometraje
            AFTER INSERT ON detalles_bitácoras
            FOR EACH ROW
            BEGIN
                UPDATE vehículos
                SET kilometraje = kilometraje + NEW.km_llegada - NEW.km_salida
                WHERE id IN (
                    SELECT vehículo_id
                    FROM bitácoras
                    WHERE id = NEW.bitácora_id
                );
            END
        ');

        // Disparador para actualizar el estado de combustible del vehículo
        DB::unprepared('
            CREATE TRIGGER actualizar_estado_combustible
            AFTER INSERT ON detalles_bitácoras
            FOR EACH ROW
            BEGIN
                UPDATE vehículos
                SET estado_combustible = NEW.tanque_llegada
                WHERE id IN (
                    SELECT vehículo_id 
                    FROM bitácoras 
                    WHERE id = NEW.bitácora_id
                );
            END
        ');
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        // Borrar tablas del negocio

        Schema::dropIfExists('detalles_bitácoras');
        Schema::dropIfExists('bitácoras');
        Schema::dropIfExists('vehículos');
    }
};
