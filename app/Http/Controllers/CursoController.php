<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Semestre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $cursosInscritos = $user->cursos;
        $semestres = Semestre::all();
        $cursosNoInscritos = Curso::whereNotIn('id', $cursosInscritos->pluck('id'))->get();
        return view('pages.tables', compact('cursosNoInscritos', 'semestres'));
    }
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|max:100',
        'descripcion' => 'required|max:255|min:5|string',
        'fecha_inicio' => 'required|date|',
        'fecha_fin' => 'required|date|',
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

    public function destroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();
        return redirect()->route('tables');
    }
}
