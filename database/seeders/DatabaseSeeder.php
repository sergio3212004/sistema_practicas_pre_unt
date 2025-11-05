<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RazonesSocialesSeeder::class]);
        $this->call([RolesSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([AlumnoSeeder::class]);
        $this->call([ProfesorSeeder::class]);
        $this->call([ProfesorAsignadoSeeder::class]);
        $this->call([EmpresaSeeder::class]);
    }
}
