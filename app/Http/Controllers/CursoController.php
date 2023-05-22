<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\Storage;

class CursoController extends Controller
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

    // Crear un nuevo curso con los datos recibidos
    $curso = Curso::create([
        'nombre' => $request->input('nombre'),
        'descripcion' => $request->input('descripcion'),
        'fecha_inicio' => $request->input('fecha_inicio'),
        'fecha_fin' => $request->input('fecha_fin'),
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
