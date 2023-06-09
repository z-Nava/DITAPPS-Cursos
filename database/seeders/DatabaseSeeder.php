<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use App\Models\Profesor;
use App\Models\Alumno;
use App\Models\Curso;
use App\Models\Semestre;
use App\Models\Tema;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
       # $this->call(CursosSeeder::class);
        #$this->call(SemestreSeeder::class);
        #$this->call(TemaSeeder::class);
        
        

        User::factory()->create([
            'name' => 'SuperAdministrador',
            'email' => 'superadministrador@material.com',
            'rol_id' => 1,
            'phone' => '8713457555',
            'status' => 'verified',
            'password' => ('secret')
        ]);

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'administrador@gmail.com',
            'rol_id' => 2,
            'status' => 'verified',
            'password' => ('secret')
        ]);

        User::factory()->create([
            'name' => 'Profesor',
            'email' => 'profesor1@gmail.com',
            'rol_id' => 3,
            'status' => 'verified',
            'password' => ('secret')
        ]);
        
        #ALUMNOS EJEMPLOS
        #Otro seeder con rol_id 4
        User::factory()->create([
            'name' => 'Alumno1',
            'email' => 'alumno1@gmail.com',
            'rol_id' => 4,
            'status' => 'verified',
            'password' => ('secret')
        ]);

        User::factory()->create([
            'name' => 'Alumno2',
            'email' => 'alumno2@gmail.com',
            'rol_id' => 4,
            'status' => 'verified',
            'password' => ('secret')
        ]);

        User::factory()->create([
            'name' => 'Alumno3',
            'email' => 'alumno3@gmail.com',
            'rol_id' => 4,
            'status' => 'verified',
            'password' => ('secret')
        ]);

        User::factory()->create([
            'name' => 'Alumno4',
            'email' => 'alumno4@gmail.com',
            'rol_id' => 4,
            'status' => 'verified',
            'password' => ('secret')
        ]);




        

        


    }
}
