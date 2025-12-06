<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\FormSetting;
use Symfony\Component\HttpFoundation\Response;

class CheckFormOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $formName): Response
    {
        $formSetting = FormSetting::getByName($formName);

        if (!$formSetting->isCurrentlyOpen()) {
            // If it's an AJAX request, return JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Form is currently closed',
                    'message' => $formSetting->closed_message ?? 'This form is not accepting submissions at this time.',
                ], 403);
            }

            // For regular requests, redirect with error message
            return redirect()->route('home')->with('error', $formSetting->closed_message ?? 'The application form is currently closed.');
        }

        return $next($request);
    }
}
