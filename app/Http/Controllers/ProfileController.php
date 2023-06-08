<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function create()
    {
        return view('pages.profile');
    }

    public function update()
    {
            
        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required|max:255|min:5',
            'phone' => 'required|max:10|min:10',
            'about' => 'required:max:150|min:10',
            'location' => 'required|max:255|min:5|string',
        ]);

        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    
    }
}
