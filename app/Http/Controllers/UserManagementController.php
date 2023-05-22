<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Notifications\EmailVerificationNotification;

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
        $usuario->status = $request->status;
        $usuario->rol_id = $request->rol_id;
        $usuario->phone = $request->phone;
        $usuario->save();
        return redirect()->route('user-management');
    }

    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->password = Str::random(10);
        $usuario->rol_id = $request->rol_id;
        $usuario->phone = $request->phone;
        $usuario->status = 'unverified';
        $usuario->save();


        URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(30), ['id' => $usuario->id, 'hash' => sha1($usuario->email)]
        );
        $usuario->notify(new EmailVerificationNotification());

        
        return redirect()->route('user-management');
    }
}
