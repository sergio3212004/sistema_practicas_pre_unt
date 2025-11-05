<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesorAsignadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('profesores_asignados')->insert([
            [
                'alumno_id' => '2024100001',
                'profesor_id' => '0000001001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'alumno_id' => '2024100002',
                'profesor_id' => '0000001002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
