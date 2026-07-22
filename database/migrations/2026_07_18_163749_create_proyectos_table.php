<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

# Estructura que se encarga de crear y borrar la tabla de proyectos en la base de datos
return new class extends Migration {
    # Crea la tabla de proyectos con las columnas necesarias
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();                                            # Numero de identificacion unico del proyecto
            $table->string('nombre');                                # Nombre del proyecto
            $table->date('fecha_inicio');                            # Fecha de inicio del proyecto
            $table->string('estado');                                # Estado actual (Activo, Inactivo, etc.)
            $table->string('responsable');                           # Nombre del encargado
            $table->decimal('monto', 10, 2)->nullable()->default(0); # Presupuesto asignado al proyecto
            $table->timestamps();                                    # Fecha y hora de creacion y actualizacion de los datos
        });
    }

    # Borra la tabla de proyectos del sistema si es necesario
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
