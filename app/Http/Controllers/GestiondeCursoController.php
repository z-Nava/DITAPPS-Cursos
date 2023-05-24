<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Semestre;

class GestiondeCursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::where('user_id', auth()->user()->id)->get();

        foreach ($cursos as $curso) {
            $curso->semestres = $curso->semestres()->get();
        }

        return view('pages.gestion-cursos', compact('cursos'));
    }

    public function store(Request $request, $cursoId)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Crear un nuevo semestre
        $semestre = new Semestre();
        $semestre->nombre = $request->nombre;
        $semestre->fecha_inicio = $request->fecha_inicio;
        $semestre->fecha_fin = $request->fecha_fin;
        $semestre->estado = 'activo';
        $curso = Curso::findOrFail($cursoId);
        $semestre->curso()->associate($curso);
        $semestre->save();
        // Redireccionar o realizar alguna acción adicional
        return redirect()->back()->with('success', 'El semestre se ha creado correctamente.');
    }

}
