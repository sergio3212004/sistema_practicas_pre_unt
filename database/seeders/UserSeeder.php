<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'alumno123@unitru.edu.pe'],
            [
                'password' => 'contraseña123',
                'role_id' => 1
            ]
        );

        User::updateOrCreate(
            ['email' => 'profesor123@unitru.edu.pe'],
            [
                'password' => 'contraseña123',
                'role_id' => 2
            ]
        );

        User::updateOrCreate(
            ['email' => 'empresa123@gmail.com'],
            [
                'password' => 'contraseña123',
                'role_id' => 3
            ]
        );

        User::updateOrCreate(
            ['email' => 'director@unitru.edu.pe'],
            [
                'password' => 'contraseña123',
                'role_id' => 4
            ]
        );

    }
}
