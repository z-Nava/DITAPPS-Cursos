<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(){

        $attributes = request()->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|min:5|max:10',
        ]);
        
        $user = User::create($attributes);
        $user->rol_id = 2;
        $user->save();

        URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(30), ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        $user->notify(new EmailVerificationNotification());
        
        //auth()->login($user);
        
        return redirect('/sign-in')->with('success', 'Your account has been created. Please check your email for verification.');
    } 

    public function verify(Request $request)
    {
     $user = User::findOrFail($request->id);

     if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
         return response(['message' => 'Invalid verification link']);
     }

     if ($user->hasVerifiedEmail()) {
         return response(['message' => 'Email already verified']);
     }

     $user->markEmailAsVerified();
     $user->status = 'verified';
        $user->save();
     event(new Verified($user));
     return redirect('/sign-in')->with('success', 'Tu cuenta ha sido confirmada. Por favor, inicia sesión.');
    }
}
