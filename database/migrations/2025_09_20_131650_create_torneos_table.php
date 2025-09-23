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
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->required();
            $table->string('descripcion')->nullable();
            $table->date('fecha_inicio')->required();
            $table->date('fecha_fin')->required();
            $table->unsignedBigInteger('fk_admin_id');
            $table->unsignedBigInteger('fk_categoria_id');
            $table->unsignedBigInteger('fk_ubicacion_id');
            $table->timestamps();

            $table->foreign('fk_admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fk_categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('fk_ubicacion_id')->references('id')->on('ubicacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
