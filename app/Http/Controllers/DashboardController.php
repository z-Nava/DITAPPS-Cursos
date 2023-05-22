<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener los cursos en los que el profesor está inscrito
        $cursos = Auth::user()->cursos;

        return view('dashboard', compact('cursos'));
    }

}
