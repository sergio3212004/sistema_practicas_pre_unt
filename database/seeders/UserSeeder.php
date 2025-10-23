<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Director
        User::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',
            'email' => 'director@unitru.edu.pe',
            'phone' => '987654321',
            'direction' => 'Av. Universidad 123',
            'password' => 'password123', // se hash automáticamente
            'role' => 'director',
        ]);

        // Profesor
        User::create([
            'name' => 'María',
            'last_name' => 'González',
            'email' => 'docente@unitru.edu.pe',
            'phone' => '987654322',
            'direction' => 'Av. Docente 456',
            'password' => 'password123',
            'role' => 'profesor',
        ]);

        // Empresa
        User::create([
            'name' => 'Carlos',
            'last_name' => 'Ramírez',
            'email' => 'coordinador@unitru.edu.pe',
            'phone' => '987654323',
            'direction' => 'Av. Coordinador 789',
            'password' => 'password123',
            'role' => 'empresa',
        ]);

        // Alumno
        User::create([
            'name' => 'Sergio',
            'last_name' => 'Monge Muñoz',
            'email' => 'smonge@unitru.edu.pe',
            'phone' => '987654324',
            'direction' => 'Av. Estudiante 101',
            'password' => 'contraseña123',
            'role' => 'alumno',
        ]);
    }
}
