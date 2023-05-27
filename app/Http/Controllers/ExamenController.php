<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Recurso;
use Illuminate\Support\Facades\Storage;

class ExamenController extends Controller
{

    public function index()
    {
        $cursos = Curso::all();
        return view('pages.tables', compact('cursos'));
    }
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
    ]);

    $user = auth()->user();

    // Crear un nuevo curso con los datos recibidos
    $curso = Curso::create([
        'nombre' => $request->input('nombre'),
        'descripcion' => $request->input('descripcion'),
        'fecha_inicio' => $request->input('fecha_inicio'),
        'fecha_fin' => $request->input('fecha_fin'),
        'user_id' => $user->id,
    ]);
        

    // Obtener y guardar la imagen asociada al curso
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $imagenPath = $imagen->storeAs('public/imagenes', $imagen->getClientOriginalName());
        if (!$imagenPath) {
            // Manejo del error de almacenamiento de la imagen
            return redirect()->back()->withInput()->withErrors(['imagen' => 'Error al guardar la imagen']);
        }
        $curso->imagen = $imagenPath;
    
        // Generar la URL para acceder a la imagen
        $imagenUrl = Storage::url($imagenPath);
        $curso->imagen_url = $imagenUrl;
    }
    
    $curso->save();
    return redirect()->route('tables')->with('success', 'Curso creado correctamente');
}

    public function show($id)
    {
	$recurso = Recurso::find($id);
	$recurso->preguntas;
	foreach($recurso->preguntas as $p){
	    $p->respuestas;
	}
        return view('pages.examen', ['recurso'=>$recurso]);
    }
}
