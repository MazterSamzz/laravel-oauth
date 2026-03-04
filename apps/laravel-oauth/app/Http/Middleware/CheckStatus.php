<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->status == 'active') {
            return $next($request);
        } else if ($request->user()->status == 'verify') {
            return to_route('verification.create');
        }

        return to_route('login')->with('failed', 'Your account is ' . $request->user()->status);
    }
}
