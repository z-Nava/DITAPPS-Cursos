<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;


class LibroController extends Controller
{
    public function obtenerDatosLibros()
    {
        $datosLibros=[];

        return $datosLibros;
    }

    public function show()
    {
        $rolAlumno = Rol::find(4);
        $usuarios = $rolAlumno->users;
        $libros = Libro::all();

        return view('pages.rtl', compact('usuarios', 'libros'));
    }

    public function store(Request $request)
    {
        $libro = new Libro();
        $libro->titulo = $request->input('titulo');
        $libro->autor = $request->input('autor');
        $libro->descripcion = $request->input('descripcion');
        $libro->archivo = $request->input('archivo');
        $libro->user_id = $request->input('user_id');

        $username = $request->input('username');
        $user = User::where('name', $username)->first();
        if ($user) {
            $libro->user_id = $user->id;
        } 
        else {
            #return redirect()->route('rtl')->with('message', 'No se encontró el usuario.');
        }   

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $rutaArchivo = $archivo->store('libros', 'public');
            $libro->archivo = $rutaArchivo;

            // Generar la URL para acceder al archivo
            $archivoUrl = asset('storage/'.$rutaArchivo);
            $libro->archivo_url = $archivoUrl;

        }

        $libro->save();

        return redirect()->route('rtl')->with('success', 'Libro almacenado exitosamente.');
    }

    public function index()
    {
    $libros = Libro::all();
    return view('pages.rtl')->with('libros', $libros);
    }

    public function verArchivo($id)
    {   
        $libro = Libro::find($id);

    if (!$libro) {
        // Manejo del caso en que no se encuentre el libro
        return redirect()->back()->with('message', 'No se encontró el libro.');
    }

    // Obtén la ruta del archivo PDF
    $rutaArchivo = storage_path('app/public/' . $libro->archivo);

    // Comprueba si el archivo existe
    if (!file_exists($rutaArchivo)) {
        // Manejo del caso en que el archivo no exista
        return redirect()->back()->with('message', 'El archivo no existe.');
    }

    // Renderiza la vista app.blade.php y pasa la ruta del archivo
    return view('pages.vistapdf')->with('rutaArchivo', $libro->archivo);
    }

    public function destroy($id)
    {
    $libro = Libro::find($id);

    if (!$libro) {
        // Manejo del caso en que no se encuentre el libro
        return redirect()->back()->with('message', 'No se encontró el libro.');
    }

    // Eliminar el libro
    $libro->delete();

    return redirect()->back()->with('message', 'El libro se ha eliminado exitosamente.');
    }

    public function bibliotecaAlumnos()
    {
        $usuarioActual = auth()->user();
        $librosAlumno = $usuarioActual->libros;
    
        return view('tu-vista')->with('librosAlumno', $librosAlumno);
    }

}
