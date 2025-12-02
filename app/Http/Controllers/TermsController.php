<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TermsController extends Controller
{
    /**
     * Show the terms acceptance page.
     *
     * @return \Illuminate\View\View
     */
    public function showAcceptancePage()
    {
        return view('terms-acceptance');
    }

    /**
     * Handle terms acceptance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptTerms(Request $request)
    {
        $request->validate([
            'device' => 'required|string',
            'location' => 'required|string',
            'credentials' => 'required|string',
        ]);

        // Save acceptance in session or database
        Session::put('terms_accepted', true);

        if (Auth::check()) {
            $user = Auth::user();
            $user->update([
                'terms_accepted' => true,
                'device' => $request->device,
                'location' => $request->location,
                'credentials' => $request->credentials,
            ]);
        }

        return redirect()->route('home');
    }
}
