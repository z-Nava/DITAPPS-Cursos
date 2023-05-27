<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::create([
            'nombre' => 'Curso de ejemplo',
            'descripcion' => 'Descripción del curso de ejemplo',
            'fecha_inicio' => '2023-01-01',
            'fecha_fin' => '2023-12-31',
            'estado' => 'activo',
            'imagen' => 'imagen_curso.jpg',
            'imagen_url' => 'https://example.com/imagen_curso.jpg',
            'user_id' => 3, // Reemplaza con el ID del usuario asociado al curso
        ]);
    }
}
