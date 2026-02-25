<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:5|max:50',
            'password' => 'required|max:50',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember))
            return redirect('/dashboard');
        return back()->with('failed', 'login failed');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
