<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email|min:5|max:50',
            'password' => 'required|confirmed|min:5|max:50',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['status'] = 'verify';
        User::create($data);

        return to_route('login')->with('success', 'Registration successful, please login');
    }

    public function googleRedirect()
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $provider */
        $provider = Socialite::driver('google');

        return $provider->with(['prompt' => 'select_account'])->redirect();
    }

    public function googleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return to_route('login')->with('failed', 'Failed to login with Google');
        }

        $user = User::firstOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'status' => 'active'
            ]
        );

        if ($user->status == 'banned') {
            return to_route('login')->with('failed', 'Your account has been banned');
        }
        if ($user->status == 'verify') {
            $user->update(['status' => 'active']);
        }

        Auth::login($user);
        $request->session()->regenerate();
        // After login, redirect to the intended page or dashboard based on role
        return redirect()->intended(
            $user->role == 'customer'
                ? route('customer')
                : route('dashboard')
        );
    } // 18:39
}
