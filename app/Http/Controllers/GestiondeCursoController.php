<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class GestiondeCursoController extends Controller
{
    public function index()
    {
    $cursos = Curso::where('user_id', auth()->user()->id)->get();
    return view('pages.gestion-cursos', compact('cursos'));
    }

}
