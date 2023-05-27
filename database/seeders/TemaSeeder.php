<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tema;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $temas = [
            [
                'nombre' => 'Tema 1',
                'contenido' => 'Contenido del tema 1',
                'semestre_id' => 1, // Reemplaza con el ID del semestre al que pertenece el tema
            ],
            [
                'nombre' => 'Tema 2',
                'contenido' => 'Contenido del tema 2',
                'semestre_id' => 1, // Reemplaza con el ID del semestre al que pertenece el tema
            ],
            // Puedes agregar más temas aquí si lo deseas
        ];
        
        foreach ($temas as $tema) {
            Tema::create($tema);
        }
    }
}
