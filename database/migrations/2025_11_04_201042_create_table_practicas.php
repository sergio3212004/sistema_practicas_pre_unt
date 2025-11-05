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
        Schema::create('table_practicas', function (Blueprint $table) {
            $table->id();

            // Relaciones principales
            $table->string('alumno_id', 10);
            $table->foreign('alumno_id')
                ->references('codigo_matricula')
                ->on('alumnos')
                ->onDelete('cascade');

            $table->string('empresa_id', 11);
            $table->foreign('empresa_id')
                ->references('ruc')
                ->on('empresas')
                ->onDelete('cascade');

            $table->string('profesor_id', 10);
            $table->foreign('profesor_id')
                ->references('codigo_profesor')
                ->on('profesores')
                ->onDelete('cascade');

            // Campos adicionales
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('estado')->default('pendiente'); // pendiente, aprobada, finalizada
            $table->string('documento_cronograma')->nullable(); // ruta al archivo PDF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_practicas');
    }
};
