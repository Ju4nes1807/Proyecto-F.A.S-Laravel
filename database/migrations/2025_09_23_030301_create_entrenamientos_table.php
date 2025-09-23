<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrenamientos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // 👈 antes 'nombre', ahora 'titulo'
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->string('cancha')->nullable();

            // Relación con usuarios (entrenador que crea el entrenamiento)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Relación opcional con categorías
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrenamientos');
    }
};

