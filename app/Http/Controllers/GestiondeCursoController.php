<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Semestre;
use App\Models\Tema;
use App\Models\Recurso;
use App\Models\Entrega;
use App\Models\Respuesta;
use App\Models\Pregunta;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


use Auth;
use Str;


class GestiondeCursoController extends Controller
{
    public function index(Request $request)
    {
        $cursoId = $request->query('curso');
        $cursos = [];

        $all = Curso::with(['usuarios'])->get();
        
        foreach($all as $curso) {
            foreach($curso->usuarios as $usuario) {
                if($usuario->id == auth()->user()->id) {
                    array_push($cursos, $curso);
                }
            }
        }
        // $cursos = Curso::where('user_id', auth()->user()->id)->with(['semestres.temas.recursos'])->get();
        
        $entregas = Entrega::all();
        $recursos = Recurso::whereIn('tipo', ['tarea', 'examen'])->get();
        //$alumnos = User::where('rol_id', 4)->get();

        return view('pages.gestion-cursos', compact('cursos', 'recursos', 'entregas'));
    }

    public function store(Request $request)
    {
    // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'curso_id' => 'required',  // Aquí estás validando que el ID del curso exista en la tabla de cursos
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

    public function showTema($id)
    {
        $temas = Tema::all();
        return view('pages.gestion-cursos', compact('temas'));
    }

    public function eliminarTema($id)
    {
        $tema = Tema::findOrFail($id);
        // Aquí realizas la lógica para eliminar el tema y sus recursos relacionados
        $tema->delete();

        return redirect()->back()->with('success', 'El tema ha sido eliminado correctamente.');
    }

    public function actualizarTema(Request $request, $id)
    {
        // Validar los datos del formulario
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

        // Redireccionar a la vista del modal de edición y pasar el tema actualizado como una variable
        return redirect()->back()->with(['success' => 'El tema se ha actualizado correctamente.', 'tema' => $tema]);
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

    public function subirArchivo(Request $request)
    {
      
        $request->validate([
            'titulo' => 'required|max:50',
            'archivo' => 'required|mimes:pdf,docx,jpg,png,pptx|max:10000', // Asegúrate de validar los tipos de archivos que quieres permitir
            'tema_id' => 'required|exists:temas,id',
        ]);
      
        // Crear un nuevo recurso de tipo 'archivo'
        $recurso = new Recurso();
        $recurso->titulo = $request->titulo;
        $recurso->tipo = 'archivo';
        $tema = Tema::findOrFail($request->tema_id);
        $recurso->tema()->associate($tema);
        

        // Comprobar si se subió un archivo y, si es así, guardarlo
        if ($request->hasFile('archivo')) {
            $nombreArchivo = hash('sha256', $request->file('archivo')->getContent()) . '.' . $request->file('archivo')->extension();
            $path = $request->file('archivo')->storeAs('public/recursos', $nombreArchivo);
            $recurso->archivo = Str::after($path, 'public/');  // Cambia esta línea
            $recurso->archivo_url = Storage::url($path);
        }
        
        $recurso->save();
        // Redireccionar o realizar alguna acción adicional
        return redirect()->back()->with('success', 'El archivo se ha subido correctamente.');
    }

    public function storeTarea(Request $request)
    {
        
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|max:50',
            'contenido' => 'required|max:255',
            'fecha_entrega' => 'required|date|after_or_equal:today|date_format:Y-m-d\TH:i',
            'tema_id' => 'required|exists:temas,id',
            'archivo' => 'nullable',
        ]);

        // Crear un nuevo recurso de tipo 'tarea'
        $recurso = new Recurso();
        $recurso->tipo = 'tarea';
        $recurso->titulo = $request->titulo;
        $recurso->contenido = $request->contenido;
        $recurso->fecha_entrega = \Carbon\Carbon::parse($request->fecha_entrega); // Parsea la fecha y hora correctamente
        $tema = Tema::findOrFail($request->tema_id);
        $recurso->tema()->associate($tema);

        // Comprobar si se subió un archivo y, si es así, guardarlo
        if ($request->hasFile('archivo')) {
            $nombreArchivo = hash('sha256', $request->file('archivo')->getContent()) . '.' . $request->file('archivo')->extension();
            $path = $request->file('archivo')->storeAs('public/recursos', $nombreArchivo);
            $recurso->archivo = Str::after($path, 'public/');
            $recurso->archivo_url = Storage::url($path);
        }

        $recurso->save();

        // Redireccionar o realizar alguna acción adicional
        return redirect()->back()->with('success', 'La tarea se ha creado correctamente.');
    }

    public function getCalificaciones()
    {
            $userId = Auth::user()->id;
            $userRole = Auth::user()->rol_id;

            if ($userRole === 3 || $userRole === 2 || $userRole === 1) { // ID del rol de profesor
                $calificaciones = Entrega::join('recursos', 'entregas.recurso_id', '=', 'recursos.id')
                    ->join('temas', 'recursos.tema_id', '=', 'temas.id')
                    ->join('semestres', 'temas.semestre_id', '=', 'semestres.id')
                    ->join('cursos', 'semestres.curso_id', '=', 'cursos.id')
                    ->join('users', 'entregas.user_id', '=', 'users.id')
                    ->select('entregas.id', 'cursos.nombre as curso', 'temas.nombre as tema', 'recursos.titulo as tarea', 'entregas.calificacion', 'users.name as alumno')
                    ->get();
            } else {
                $calificaciones = Entrega::join('recursos', 'entregas.recurso_id', '=', 'recursos.id')
                    ->join('temas', 'recursos.tema_id', '=', 'temas.id')
                    ->join('semestres', 'temas.semestre_id', '=', 'semestres.id')
                    ->join('cursos', 'semestres.curso_id', '=', 'cursos.id')
                    ->join('users', 'entregas.user_id', '=', 'users.id')
                    ->where('entregas.user_id', $userId)
                    ->select('entregas.id', 'cursos.nombre as curso', 'temas.nombre as tema', 'recursos.titulo as tarea', 'entregas.calificacion', 'users.name as alumno')
                    ->get();
            }   

            $alumnos = User::where('rol_id', 4)->whereHas('cursos', function ($query) use ($userId) {
                $query->whereHas('usuarios', function ($query) use ($userId) {
                    $query->where('users.id', $userId);
                });
            })->get();

            $recursos = Recurso::whereIn('tipo', ['tarea', 'examen'])->get();

            $cursos = Curso::whereHas('usuarios', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })->get();

            $temas = Tema::whereIn('semestre_id', function ($query) use ($cursos) {
                $query->select('id')
                    ->from('semestres')
                    ->whereIn('curso_id', $cursos->pluck('id')->toArray());
            })->get();

            return view('pages.billing')->with([
                'calificaciones' => $calificaciones,
                'alumnos' => $alumnos,
                'recursos' => $recursos,
                'cursos' => $cursos,
                'temas' => $temas
            ]);
    }


    public function storeCalificacion(Request $request)
    {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'alumno_id' => 'required',
                'recurso_id' => 'required',
                'calificacion' => 'required|numeric|min:0|max:100',
            ]);

            // Crear una nueva instancia de Entrega con los datos del formulario
            $entrega = new Entrega();
            $entrega->user_id = $request->alumno_id;
            $entrega->recurso_id = $request->recurso_id;
            $entrega->calificacion = $request->calificacion;
            
            // Guardar la calificación en la base de datos
            $entrega->save();

            // Redireccionar a la página de calificaciones o a donde sea necesario
            return redirect()->back()->with('success', 'La calificación se ha agregado correctamente.');
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

    public function crearExamen(Request $request)
    {
        // Crear el nuevo examen
        $recurso = new Recurso;
        $recurso->tipo = 'examen';
        $recurso->titulo = $request->input('titulo');
        $recurso->fecha_entrega = $request->input('fecha_entrega');
        $recurso->tema_id = 1; // Aquí deberías obtener el id del tema real
        $recurso->save();

        // Obtener las preguntas y respuestas del formulario
        $preguntas = $request->input('preguntas');
        $respuestas = $request->input('respuestas');

        // Asegurarte de que hay la misma cantidad de preguntas y respuestas
        if (count($preguntas) !== count($respuestas)) {
            // Deberías manejar este error de alguna manera
            return;
        }

        // Crear las preguntas y respuestas
        for ($i = 0; $i < count($preguntas); $i++) {
            $pregunta = new Pregunta;
            $pregunta->pregunta = $preguntas[$i];
            $pregunta->tipo = 'opcion_multiple'; // Deberías obtener el tipo real del formulario
            $pregunta->recurso_id = $recurso->id;
            $pregunta->save();

            $respuesta = new Respuesta;
            $respuesta->respuesta = $respuestas[$i];
            $respuesta->correcta = false; // Deberías obtener el valor real del formulario
            $respuesta->pregunta_id = $pregunta->id;
            $respuesta->save();
        }

        return redirect()->route('gestion-cursos');  // Deberías redirigir a la página que prefieras
    }

    public function mostrarCrearExamen($id)
    {
        return view('pages.crear-examen', ['tema'=>Tema::find($id)]);
    }
}
