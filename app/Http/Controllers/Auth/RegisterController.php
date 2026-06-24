<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Models\User;
use App\Models\File;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

        public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
            'team' => $request->team,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $file = new File();
        $file->name = $user->email;
        $file->is_folder = 1;
        $file->makeRoot()->save();


    }
}