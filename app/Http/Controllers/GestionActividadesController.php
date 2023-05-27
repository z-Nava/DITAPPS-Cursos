<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Recurso;
use App\Models\Entrega;


class GestionActividadesController extends Controller
{
    public function index(Request $request)
    {
        $cursoId = $request->query('curso');
        
        $cursos = Curso::where('user_id', auth()->user()->id)->with(['semestres.temas.recursos'])->get();
        
        $entregas = Entrega::all();
        $recursos = Recurso::whereIn('tipo', ['tarea', 'examen'])->get();

        return view('pages.gestion-actividades', compact('cursos', 'recursos', 'entregas'));
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



}
