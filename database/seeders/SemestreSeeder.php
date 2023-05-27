<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semestre;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Semestre::create([
            'nombre' => 'Semestre 1',
            'fecha_inicio' => '2023-01-01',
            'fecha_fin' => '2023-06-30',
            'estado' => 'activo',
            'curso_id' => 1, // Reemplaza con el ID del curso al que pertenece el semestre
        ]);
    }
}
