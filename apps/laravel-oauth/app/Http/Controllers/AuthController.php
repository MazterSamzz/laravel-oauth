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
        $credentials = $request->validate([
            'email' => 'required|email|min:5|max:50',
            'password' => 'required|max:50',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $url = Auth::user()->role == 'customer'
                ? route('customer')
                : route('dashboard');

            return redirect()->intended($url);
        }
        return back()->with('failed', 'login failed');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }
}
