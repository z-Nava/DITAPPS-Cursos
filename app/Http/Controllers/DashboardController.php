<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    #public function index()
    #{
     #   $cursos = Curso::all(); // Obtén los cursos desde el modelo Curso

     #   return view('dashboard.index', compact('cursos'));
    #}
}
