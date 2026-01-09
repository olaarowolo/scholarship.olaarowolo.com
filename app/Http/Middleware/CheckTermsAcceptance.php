<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTermsAcceptance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user has accepted terms and cookies
        $user = Auth::user();
        $hasConsent = session('terms_accepted') ||
                     ($user && $user->consent && $user->consent->terms_accepted) ||
                     ($user && $user->terms_accepted); // Fallback for legacy users

        if (!$hasConsent) {
            return redirect()->route('terms.acceptance');
        }

        return $next($request);
    }
}
