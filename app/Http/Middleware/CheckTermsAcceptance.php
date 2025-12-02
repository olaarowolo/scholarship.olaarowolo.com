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
        if (!session('terms_accepted') && !Auth::user()?->terms_accepted) {
            return redirect()->route('terms.acceptance');
        }

        return $next($request);
    }
}
