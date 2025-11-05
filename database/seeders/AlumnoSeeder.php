<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alumnos')->insert([
            [
                'codigo_matricula' => '2024100001',
                'user_id' => 1,
                'nombres' => 'Carlos Andrés',
                'apellido_paterno' => 'Gonzales',
                'apellido_materno' => 'Ramos',
                'telefono' => '987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo_matricula' => '2024100002',
                'user_id' => 2,
                'nombres' => 'Lucía Fernanda',
                'apellido_paterno' => 'Torres',
                'apellido_materno' => 'Mendoza',
                'telefono' => '912345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
