<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Recurso;
use App\Models\Entrega;
use App\Models\Respuesta;
use App\Models\Pregunta;
use App\Models\RespuestaUsuario;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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
        if($user->rol_id == 1||$user->rol_id == 2 || $user->rol_id == 3){
            return redirect()->route('gestion-cursos')->with('success', 'Te has inscrito al curso exitosamente');
        }
        return redirect()->route('dashboard')->with('success', 'Te has inscrito al curso exitosamente');
    }

    public function salirCurso(Curso $curso)
    {
        $user = Auth::user();

        // Verificar si el alumno está inscrito en el curso
        if (!$user->cursos->contains($curso)) {
            return redirect()->route('dashboard')->with('error', 'No estás inscrito en este curso');
        }

        // Eliminar la relación alumno-curso
        $user->cursos()->detach($curso);

        return redirect()->route('dashboard')->with('success', 'Has salido del curso exitosamente');
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
            'archivo' => 'required|mimes:pdf,docx'
        ]);

        $nombreArchivo = hash('sha256', $request->file('archivo')->getContent()) . '.' . $request->file('archivo')->extension();
        $path = $request->file('archivo')->storeAs('entregas', $nombreArchivo, 'public');


        $entrega = new Entrega();
        $entrega->recurso_id = $request->recurso_id;
        $entrega->user_id = Auth::id();
        $entrega->archivo = $nombreArchivo;
        $entrega->descripcion = $request->descripcion;

        // Generar la URL para acceder al archivo
        $archivoUrl = asset('storage/'.$path);
        $entrega->archivo_url = $archivoUrl;

    
        $entrega->save();
        return redirect()->route('dashboard')->with('success', 'Has entregado la tarea!');
        
    }

    public function crearExamen(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'preguntas' => 'required',
            'tema_id' => 'required',
            'fecha_entrega' => 'required',
            'fecha_inicio' => 'required'
        ]);

        $recurso = new Recurso();
        $recurso->tipo = 'examen';
        $recurso->titulo = $request->titulo;
        $recurso->tema_id = $request->tema_id;
        $recurso->fecha_entrega = $request->fecha_entrega;
        $recurso->fecha_inicio = $request->fecha_inicio;
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
        $preguntasCorrectas = 0;

        foreach ($preguntas as $pregunta) {
            // El nombre del campo de respuesta debe coincidir con lo que estableciste en la vista
            if (!$request->has('respuesta-' . $pregunta->id)) {
                // Maneja el error si no se ha proporcionado una respuesta
                return redirect()->back()->with('error', 'Debes responder a todas las preguntas.');
            }

            $respuestaUsuario = new RespuestaUsuario;
            $respuestaUsuario->pregunta_id = $pregunta->id;
            $respuestaUsuario->recurso_id = $request->input('recurso_id');
            $respuestaUsuario->user_id = auth()->user()->id;
            $respuestaUsuario->respuesta = $request->input('respuesta-' . $pregunta->id);
            $respuestaUsuario->save();

            // Verificar si la respuesta es correcta
            $respuestaCorrecta = Respuesta::where('pregunta_id', $pregunta->id)
                                        ->where('correcta', 1)
                                        ->first();

                if ($respuestaCorrecta->id == $request->input('respuesta-' . $pregunta->id)) {
                    $preguntasCorrectas++;
                }
            }

        // Calcular la calificación
        $calificacion = ($preguntasCorrectas * 10) / $preguntas->count();

        $entrega = new Entrega;
        $entrega->recurso_id = $request->input('recurso_id');
        $entrega->user_id = auth()->user()->id;
        $entrega->archivo = 'asdasd';
        $entrega->calificacion = $calificacion;
        $entrega->save();

        // Redirigir a donde prefieras después de que el usuario ha entregado el examen
        return redirect()->route('dashboard');
    }

    public function verArchivo($id)
    {
        $recurso = Recurso::find($id);

        if (!$recurso) {
            return redirect()->back()->with('message', 'No se encontró la tarea.');
        }

        $rutaArchivo = $recurso->archivo;

        return view('pages.vistapdf')->with('rutaArchivo', $rutaArchivo);
    }

}
