<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Empresa::create([
            'ruc' => '12345678987',
            'user_id' => 3,
            'razon_social_id' => 3,
            'nombre' => 'Dildos a domicilio',
            'telefono' => '968856123',
            'departamento' => 'La libertad',
            'provincia' => 'Trujillo',
            'distrito' => 'Trujillo',
            'direccion' => 'Pene doblado 123'
        ]);
    }
}
