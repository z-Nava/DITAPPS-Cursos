<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Rol;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Superadministrador'],
            ['name' => 'Administrador'],
            ['name' => 'Profesor'],
            ['name' => 'Alumno'],
        ];
        
        foreach ($roles as $role) {
            Rol::create($role);
        }
    }
}
