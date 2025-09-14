<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('canchas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo');
            $table->boolean('disponible')->default(true);
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('fk_escuela_id');
            $table->unsignedBigInteger('fk_admin_id');
            $table->unsignedBigInteger('fk_ubicacion_id');
            $table->timestamps();

            $table->foreign('fk_escuela_id')->references('id')->on('escuelas')->onDelete('cascade');
            $table->foreign('fk_admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fk_ubicacion_id')->references('id')->on('ubicacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canchas');
    }
};
