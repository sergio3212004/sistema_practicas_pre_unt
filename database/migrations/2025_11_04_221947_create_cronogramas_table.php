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
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ficha_registro_id');
            $table->string('documento')->nullable(); // Ruta o nombre del archivo
            $table->enum('estado', ['pendiente', 'enviado', 'aceptado', 'rechazado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('ficha_registro_id')
                ->references('id')
                ->on('ficha_registros')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cronograma');
    }
};
