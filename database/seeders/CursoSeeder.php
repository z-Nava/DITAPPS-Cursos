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
        $cursos = [
            [
                'nombre' => 'Curso 1',
                'descripcion' => 'Descripción del curso 1',
                'fecha_inicio' => '2023-01-01',
                'fecha_fin' => '2023-12-31',
                'estado' => 'activo',
                'imagen' => 'imagen_curso1.jpg',
                'imagen_url' => 'https://example.com/imagen_curso1.jpg',
                'user_id' => 1, // Reemplaza con el ID del usuario asociado al curso
            ],
            // Puedes agregar más cursos aquí si lo deseas
        ];
        
        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}
