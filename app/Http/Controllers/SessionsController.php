<?php

namespace App\Http\Controllers;

Use Str;
Use Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'login' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:40'
        ]);

        $loginType = filter_var($attributes['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
        $loginType => $attributes['login'],
        'password' => $attributes['password']
    ];

        if (!auth()->attempt($credentials)) {
        throw ValidationException::withMessages([
            'login' => 'Your provided credentials could not be verified.'
         ]);
        }

        if (auth()->user()->status !== 'verified') {
            auth()->logout();
            return redirect('/sign-in')->with('status', 'Necesitas verificar tu correo electronico, asi podras entrar al dashboard...');
        }

        session()->regenerate();

          // Redirige a los usuarios según su rol
        if (auth()->user()->rol_id == 1 || auth()->user()->rol_id == 2 || auth()->user()->rol_id == 3) {
        return redirect('gestioncursos');
        }

        return redirect('/dashboard');

    }

    public function show(){
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
        
    }

    public function update(){
        
        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ]); 
          
        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
