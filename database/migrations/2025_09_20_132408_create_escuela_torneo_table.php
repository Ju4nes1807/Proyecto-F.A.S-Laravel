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
        Schema::create('escuela_torneo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_torneo_id');
            $table->unsignedBigInteger('fk_escuela_id');
            $table->timestamps();

            $table->foreign('fk_torneo_id')->references('id')->on('torneos')->onDelete('cascade');
            $table->foreign('fk_escuela_id')->references('id')->on('escuelas')->onDelete('cascade');

            $table->unique(['fk_torneo_id', 'fk_escuela_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuela_torneo');
    }
};
