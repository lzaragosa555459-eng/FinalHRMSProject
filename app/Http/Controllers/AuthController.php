<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

   public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

        if (Auth::user()->role === 'hr') {
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->intended('/employee-dashboard');
        }
           
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
}