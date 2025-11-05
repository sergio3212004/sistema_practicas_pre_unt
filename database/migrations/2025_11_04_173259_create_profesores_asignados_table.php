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
        Schema::create('profesores_asignados', function (Blueprint $table) {
            $table->id();
            $table->string('alumno_id', 10);
            $table->foreign('alumno_id')
                ->references('codigo_matricula')
                ->on('alumnos')
                ->onDelete('cascade');
            $table->string('profesor_id', 10);
            $table->foreign('profesor_id')
                ->references('codigo_profesor')
                ->on('profesores');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores_asignados');
    }
};
