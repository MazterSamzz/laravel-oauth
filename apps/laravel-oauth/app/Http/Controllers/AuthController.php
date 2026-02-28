<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|min:5|max:50',
            'password' => 'required|min:5|max:50',
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

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email|min:5|max:50',
            'password' => 'required|confirmed|min:5|max:50',
        ]);

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 'active';
        User::create($data);

        return to_route('login')->with('success', 'Registration successful, please login');
    }
}
