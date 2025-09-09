<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();

            // Usuario asignado (jugador o entrenador)
            $table->unsignedBigInteger('user_id');

            // Escuela a la que se asigna
            $table->unsignedBigInteger('escuela_id');

            // Admin que hizo la asignación
            $table->unsignedBigInteger('assigned_by');

            // Tipo de asignación (opcional: jugador o entrenador)
            $table->enum('tipo', ['jugador', 'entrenador']);

            $table->timestamps();

            // Relaciones / llaves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('escuela_id')->references('id')->on('escuelas')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignaciones');
    }
};
