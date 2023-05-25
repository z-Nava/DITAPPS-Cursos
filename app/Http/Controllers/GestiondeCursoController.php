<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Semestre;
use App\Models\Tema;

class GestiondeCursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::where('user_id', auth()->user()->id)->with(['semestres.temas.recursos'])->get();
        
        return view('pages.gestion-cursos', compact('cursos'));
    }

    public function store(Request $request)
    {
    // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'curso_id' => 'required|exists:cursos,id',  // Aquí estás validando que el ID del curso exista en la tabla de cursos
        ]);

        // Crear un nuevo semestre
        $semestre = new Semestre();
        $semestre->nombre = $request->nombre;
        $semestre->fecha_inicio = $request->fecha_inicio;
        $semestre->fecha_fin = $request->fecha_fin;
        $semestre->estado = 'activo';
        $curso = Curso::findOrFail($request->curso_id);  // Aquí estás obteniendo el ID del curso desde los datos de la solicitud
        $semestre->curso()->associate($curso);
        $semestre->save();

        // Redireccionar o realizar alguna acción adicional
        return redirect()->back()->with('success', 'El semestre se ha creado correctamente.');
    }

    public function storeTema(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'contenido' => 'required',
            'semestre_id' => 'required|exists:semestres,id',  // Aquí estás validando que el ID del semestre exista en la tabla de semestres
        ]);

        // Crear un nuevo tema
        $tema = new Tema();
        $tema->nombre = $request->nombre;
        $tema->contenido = $request->contenido;
        $semestre = Semestre::findOrFail($request->semestre_id);  // Aquí estás obteniendo el ID del semestre desde los datos de la solicitud
        $tema->semestre()->associate($semestre);
        $tema->save();

        // Redireccionar o realizar alguna acción adicional
        return redirect()->back()->with('success', 'El tema se ha creado correctamente.');
    }

}
