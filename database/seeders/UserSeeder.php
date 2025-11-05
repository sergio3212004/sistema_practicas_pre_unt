<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                'email' => 'alumno1@unitru.edu.pe',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'alumno2@unitru.edu.pe',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'profesor1@unitru.edu.pe',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'profesor2@unitru.edu.pe',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'empresa@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
