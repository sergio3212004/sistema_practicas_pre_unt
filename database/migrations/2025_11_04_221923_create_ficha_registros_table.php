<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ficha_registro', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profesor_asignado_id');
            $table->string('documento')->nullable(); // Ruta o nombre del archivo
            $table->enum('estado', ['pendiente', 'enviado', 'aceptado', 'rechazado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('profesor_asignado_id')
                ->references('id')
                ->on('profesores_asignados')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_registro');
    }
};
