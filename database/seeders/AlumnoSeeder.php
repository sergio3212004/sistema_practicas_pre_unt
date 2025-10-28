<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::where('role_id', 1)->first();
        if ($user) {
            Alumno::create([
                'user_id' => $user->id,
                'codigo_matricula' => '1234567899',
                'nombres' => 'Sergio David',
                'apellido_paterno' => 'Monge',
                'apellido_materno' => 'Muñoz',
                'telefono' => '912398777'
            ]);
        }

    }
}
