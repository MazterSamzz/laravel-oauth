<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function create()
    {
        return view('auth.verification.create');
    }

    public function store(Request $request)
    {
        $user = false;

        if ($request->type == 'register') {
            $user = User::find($request->user()->id);
        } else {
            // reset password
        }

        if (!$user) return back()->with('failed', 'User not found');

        $otp = rand(100000, 999999);
        $verify = Verification::create([
            'user_id' => $user->id,
            'unique_id' => uniqid(),
            'otp' => Hash::make($otp),
            'type' => $request->type,
            'send_via' => 'email'
        ]);

        Mail::to($user->email)->queue(new \App\Mail\OtpEmail($otp));

        if ($request->type == 'register') {
            return to_route('verification.edit', ['unique_id' => $verify->unique_id]);
        }

        return back()->with('failed', 'OTP failed to send');
    }

    public function edit(Verification $unique_id)
    {
        $verification = $unique_id;
        if ($verification->user_id !== Auth::id() || $verification->status !== 'active')
            abort(404);

        return view('auth.verification.edit', ['unique_id' => $unique_id])->with('success', 'Verification sent to your email');
    }

    public function update(Request $request, Verification $unique_id)
    {
        $verification = $unique_id;
        if ($verification->user_id !== Auth::id() || $verification->status !== 'active')
            abort(404);

        if (!Hash::check($request->otp, $verification->otp)) {
            $verification->update(['status' => 'invalid']);
            return back()->with('failed', 'Invalid OTP');
        }

        $user = $verification->user;
        DB::transaction(function () use ($verification, $user) {
            $verification->update(['status' => 'valid']);
            $user->update(['status' => 'active']);
        });

        $redirectUrl = match ($user->role) {
            'customer' => to_route('customer'),
            'admin', 'staff' => to_route('dashboard'),
            default => to_route('login'),
        };

        return $redirectUrl->with('success', 'Verified!');
    }
}
