<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user doesn't have 2FA enabled, proceed normally
        if (!$user || !$user->two_factor_enabled) {
            return $next($request);
        }

        // If user has 2FA enabled but hasn't verified this session
        if (!$request->session()->has('two_factor_verified_' . $user->id)) {
            return redirect()->route('two-factor.verify');
        }

        return $next($request);
    }
}
