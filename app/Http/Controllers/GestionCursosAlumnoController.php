<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Recurso;
use App\Models\Entrega;
use App\Models\Respuesta;
use App\Models\Pregunta;
use App\Models\RespuestaUsuario;
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

        // Obtener las entregas del alumno
        $entregas = $alumno->entregas->pluck('recurso_id')->toArray();
        

        // Obtener las respuestas del alumno
        $respuestasUsuarios = $alumno->respuestasUsuarios->pluck('recurso_id')->toArray();

        // Cargar los datos necesarios para cada curso
        foreach ($cursos as $curso) {
            $curso->load(['semestres.temas', 'semestres.temas.recursos' => function ($query) {
                $query->whereIn('tipo', ['examen', 'tarea']);
            }]);
        }
       
        // Retornar la vista del dashboard con los datos cargados
        return view('dashboard', compact('cursos', 'entregas', 'respuestasUsuarios'));
    }
    }

    public function entregarTarea(Request $request)
    {
        $request->validate([
            'recurso_id' => 'required|exists:recursos,id',
            'descripcion' => 'required|max:255|min:10|string',
            'archivo' => 'required|mimes:pdf,docx|'
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


    public function crearExamen(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'preguntas' => 'required',
            'tema_id' => 'required',
            'fecha_entrega' => 'required'
        ]);

        $recurso = new Recurso();
        $recurso->tipo = 'examen';
        $recurso->titulo = $request->titulo;
        $recurso->tema_id = $request->tema_id;
        $recurso->fehca_entrega = $request->fecha_entrega;
        $recurso->save();
        foreach (json_decode($request->preguntas) as $p) {
            //return $p['pregunta'];
            $pregunta = new Pregunta();
            $pregunta->pregunta = $p->pregunta;
            $pregunta->tipo = $p->tipo;
            $pregunta->recurso_id = $recurso->id;
            $pregunta->save();
            foreach ($p->opciones as $r) {
                $respuesta = new Respuesta();
                $respuesta->respuesta = $r->respuesta;
                $respuesta->correcta = $r->correcta;
                $respuesta->pregunta_id = $pregunta->id;
                $respuesta->save();
            }
        }
        return redirect('tables')->with('success', 'El examen se ha creado correctamente.');
    }

    public function entregarExamen(Request $request)
    {
        // Asegúrate de que el usuario ha respondido todas las preguntas
        $preguntas = Pregunta::where('recurso_id', $request->input('recurso_id'))->get();

        foreach ($preguntas as $pregunta) {
            // El nombre del campo de respuesta debe coincidir con lo que estableciste en la vista
            if (!$request->has('respuesta-' . $pregunta->id)) {
                // Maneja el error si no se ha proporcionado una respuesta

                return redirect()->back()->with('error', 'Debes responder a todas las preguntas.');
            }
        }

        // Guardar las respuestas del usuario
        foreach ($preguntas as $pregunta) {
            $respuestaUsuario = new RespuestaUsuario;
            $respuestaUsuario->pregunta_id = $pregunta->id;
            $respuestaUsuario->recurso_id = $request->input('recurso_id');
            $respuestaUsuario->user_id = auth()->user()->id;
            $respuestaUsuario->respuesta = $request->input('respuesta-' . $pregunta->id);
            $respuestaUsuario->save();
        }
        $entrega = new Entrega;
        $entrega->recurso_id = $request->input('recurso_id');
        $entrega->user_id = auth()->user()->id;
        $entrega->archivo = NULL;
        // Aquí puedes añadir cualquier otro campo necesario para la tabla de entregas

        $entrega->save();
        // Redirigir a donde prefieras después de que el usuario ha entregado el examen
        return redirect()->route('dashboard');
    }
}
