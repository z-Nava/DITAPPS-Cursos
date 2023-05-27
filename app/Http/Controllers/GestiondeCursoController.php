<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Semestre;
use App\Models\Tema;
use App\Models\Recurso;
use App\Models\Entrega;
use Auth;


class GestiondeCursoController extends Controller
{
    public function index(Request $request)
{
    $cursoId = $request->query('curso');
    
    $cursos = Curso::where('user_id', auth()->user()->id)->with(['semestres.temas.recursos'])->get();
    
    $entregas = Entrega::all();
    $recursos = Recurso::where('tipo', 'tarea')->get();

    
    

    return view('pages.gestion-cursos', compact('cursos', 'recursos', 'entregas'));
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
            'enlace' => 'nullable',
            'semestre_id' => 'required|exists:semestres,id',  // Aquí estás validando que el ID del semestre exista en la tabla de semestres
        ]);

        // Crear un nuevo tema
        $tema = new Tema();
        $tema->nombre = $request->nombre;
        $tema->contenido = $request->contenido;
        $tema->enlace = $request->enlace;
        $semestre = Semestre::findOrFail($request->semestre_id);  // Aquí estás obteniendo el ID del semestre desde los datos de la solicitud
        $tema->semestre()->associate($semestre);
        $tema->save();

        // Redireccionar o realizar alguna acción adicional
        return redirect()->back()->with('success', 'El tema se ha creado correctamente.');
    }

    public function eliminarTema($id)
    {
        $tema = Tema::findOrFail($id);
        // Aquí realizas la lógica para eliminar el tema y sus recursos relacionados
        $tema->delete();

        return redirect()->back()->with('success', 'El tema ha sido eliminado correctamente.');
    }

    public function editarTema(Request $request, $id)
    {   
        $request->validate([
            'nombre' => 'required',
            'contenido' => 'required',
            'enlace' => 'nullable',
            // Agrega aquí las validaciones para otros campos si es necesario
        ]);
    
        // Encontrar el tema por su ID
        $tema = Tema::findOrFail($id);
    
        // Actualizar los campos del tema con los nuevos datos
        $tema->nombre = $request->nombre;
        $tema->contenido = $request->contenido;
        $tema->enlace = $request->enlace;
        // Actualiza otros campos si es necesario
    
        // Guardar los cambios en la base de datos
        $tema->save();

        $temaActualizado = Tema::findOrFail($tema->id);

// Redireccionar a la vista del modal de edición y pasar el tema actualizado como una variable
return redirect()->back()->with(['success' => 'El tema se ha actualizado correctamente.', 'tema' => $temaActualizado]);
    

    }



    public function storeRecurso(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:actividad,tarea,examen,enlace,video,archivo',
            'titulo' => 'required',
            'contenido' => 'nullable',
            'url' => 'nullable',
            'tema_id' => 'required|exists:temas,id',
        ]);

        $recurso = new Recurso($request->all());
        $recurso->save();

        return redirect()->back()->with('success', 'Recurso creado con éxito');
    }

    public function updateRecurso(Request $request, Recurso $recurso)
    {
        $request->validate([
            'tipo' => 'required|in:actividad,tarea,examen,enlace,video,archivo',
            'titulo' => 'required',
            'contenido' => 'nullable',
            'url' => 'nullable',
            'tema_id' => 'required|exists:temas,id',
        ]);

        $recurso->update($request->all());

        return redirect()->back()->with('success', 'Recurso actualizado con éxito');
    }

    public function storeTarea(Request $request)
    {
        
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'fecha_entrega' => 'required|date|after_or_equal:today', // Asegura que la fecha de entrega no sea anterior a la fecha actual
            'tema_id' => 'required|exists:temas,id',
        ]);

        // Crear un nuevo recurso de tipo 'actividad'
        $recurso = new Recurso();
        $recurso->tipo = 'tarea';
        $recurso->titulo = $request->titulo;
        $recurso->contenido = $request->contenido;
        $recurso->fecha_entrega = $request->fecha_entrega;
        $tema = Tema::findOrFail($request->tema_id);
        $recurso->tema()->associate($tema);
        
        $recurso->save();
        

        // Redireccionar o realizar alguna acción adicional
        return redirect()->back()->with('success', 'La tarea se ha creado correctamente.');
    }

    public function calificarEntrega(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:100'
        ]);

        $entrega = Entrega::find($id);
        $entrega->calificacion = $request->calificacion;
        $entrega->save();

        return redirect()->back()->with('success', 'La entrega ha sido calificada correctamente.');
    }

        public function getCalificaciones()
    {
        $userId = Auth::user()->id;
        $userRole = Auth::user()->rol_id;

        if ($userRole === 3) { // ID del rol de profesor
            $calificaciones = Entrega::join('recursos', 'entregas.recurso_id', '=', 'recursos.id')
                ->join('temas', 'recursos.tema_id', '=', 'temas.id')
                ->join('semestres', 'temas.semestre_id', '=', 'semestres.id')
                ->join('cursos', 'semestres.curso_id', '=', 'cursos.id')
                ->select('cursos.nombre as curso', 'temas.nombre as tema', 'recursos.titulo as tarea', 'entregas.calificacion')
                ->get();
        } else {
            $calificaciones = Entrega::join('recursos', 'entregas.recurso_id', '=', 'recursos.id')
                ->join('temas', 'recursos.tema_id', '=', 'temas.id')
                ->join('semestres', 'temas.semestre_id', '=', 'semestres.id')
                ->join('cursos', 'semestres.curso_id', '=', 'cursos.id')
                ->where('entregas.user_id', $userId)
                ->select('cursos.nombre as curso', 'temas.nombre as tema', 'recursos.titulo as tarea', 'entregas.calificacion')
                ->get();
        }
        
        return view('pages.billing')->with('calificaciones', $calificaciones);
    }

    public function editarCalificacion(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:100'
        ]);
    
        $entrega = Entrega::findOrFail($id);
        $entrega->calificacion = $request->calificacion;
        $entrega->save();
    
        return redirect()->back()->with('success', 'La calificación ha sido actualizada correctamente.');
    }
}
