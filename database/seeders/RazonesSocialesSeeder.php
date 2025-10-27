<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RazonesSocialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('razones_sociales')->insert([
            [
                'nombre' => 'Sociedad por Acciones Cerrada Simplificada',
                'acronimo' => 'S.A.C.S.'
            ],
            [
                'nombre' => 'Sociedad Anónima',
                'acronimo' => 'S.A.'
            ],
            [
                'nombre' => 'Sociedad Anónima Cerrada',
                'acronimo' => 'S.A.C.'
            ],
            [
                'nombre' => 'Sociedad Comercial de Responsabilidad Limitada',
                'acronimo' => 'S.R.L.'
            ],
            [
                'nombre' => 'Empresario Individual de Responsabilidad Limitada',
                'acronimo' => 'E.I.R.L.'
            ],
            [
                'nombre' => 'Sociedad Anónima Abierta',
                'acronimo' => 'S.A.A.'
            ],
        ]);

    }
}
