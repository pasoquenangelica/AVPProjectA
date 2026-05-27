<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('logged_id')) {
            return redirect()->route('login')->withErrors([
                'username' => 'Please log in to continue.',
            ]);
        }

        return $next($request);
    }
}
