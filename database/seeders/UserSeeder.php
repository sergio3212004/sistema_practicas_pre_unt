<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'email' => 'almuno123@unitru.edu.pe',
                'password' => 'contraseña123',
                'role_id' => 1
            ],
            [
                'email' => 'profesor123@unitru.edu.pe',
                'password' => 'contraseña123',
                'role_id' => 2
            ],
            [
                'email' => 'empresa123@gmail.com',
                'password' => 'contraseña123',
                'role_id' => 3
            ],
            [
                'email' => 'director@unitru.edu.pe',
                'password' => 'contraseña123',
                'role_id' => 4
            ]
        ]);
    }
}
