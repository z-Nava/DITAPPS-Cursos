<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestionActividadesController extends Controller
{
    public function index()
    {
        return view('pages/gestion-actividades');
    }
}
