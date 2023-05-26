<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Recurso;
use App\Models\Entrega;
use Illuminate\Support\Facades\Auth;


class GestionCursosAlumnoController extends Controller
{
    public function index()
    {
            // Obtener el usuario autenticado
        $alumno = Auth::user();

        // Obtener los cursos inscritos del alumno
        $cursos = $alumno->cursos;

        // Retornar la vista del dashboard con los cursos inscritos
        return view('dashboard.index', compact('cursos'));
    }

    public function inscribirCurso(Curso $curso)
    {
        $user = Auth::user();

        // Verificar si el alumno ya está inscrito en el curso
        if ($user->cursos->contains($curso)) {
            return redirect()->route('dashboard')->with('error', 'Ya estás inscrito en este curso');
        }

        // Adjuntar la relación alumno-curso
        $user->cursos()->attach($curso);

        return redirect()->route('dashboard')->with('success', 'Te has inscrito al curso exitosamente');
    }

    public function dashboard()
    {
        // Obtener el usuario autenticado
        if (auth()->check()) {
            $alumno = auth()->user();
        

        // Obtener los cursos inscritos del alumno
        $cursos = $alumno->cursos;

        // Cargar los datos necesarios para cada curso
        foreach ($cursos as $curso) {
            $curso->load('semestres.temas');
        }
        
        // Retornar la vista del dashboard con los datos cargados
        return view('dashboard', compact('cursos'));

        }
    }

    public function entregarTarea(Request $request)
{
    $request->validate([
        'recurso_id' => 'required|exists:recursos,id',
        'descripcion' => 'required',
        'archivo' => 'required|mimes:pdf,docx'
    ]);

    $path = $request->file('archivo')->storeAs('public/entregas', $request->file('archivo')->getClientOriginalName());

    $entrega = new Entrega();
    $entrega->recurso_id = $request->recurso_id;
    $entrega->user_id = Auth::id();
    $entrega->archivo = $path;
    $entrega->descripcion = $request->descripcion;
    $entrega->save();

    return redirect()->back()->with('success', 'La tarea se ha entregado correctamente.');
}

}
