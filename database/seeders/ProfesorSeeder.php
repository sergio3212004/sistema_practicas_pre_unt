<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('profesores')->insert([
            [
                'codigo_profesor' => '0000001001',
                'user_id' => 3,
                'nombres' => 'Miguel Ángel',
                'apellido_paterno' => 'Salazar',
                'apellido_materno' => 'Huerta',
                'telefono' => '954321987',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo_profesor' => '0000001002',
                'user_id' => 4,
                'nombres' => 'Patricia Elena',
                'apellido_paterno' => 'Campos',
                'apellido_materno' => 'Rivas',
                'telefono' => '978456321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
