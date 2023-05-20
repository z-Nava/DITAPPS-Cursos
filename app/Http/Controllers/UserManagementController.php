<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('pages/laravel-examples/user-management', compact('usuarios'));
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        return redirect()->route('user-management');
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        return view('pages/laravel-examples/user-management-edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->save();
        return redirect()->route('user-management');
    }

    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->save();
        return redirect()->route('user-management');
    }
}
