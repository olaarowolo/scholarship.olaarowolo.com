<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserConsent;

class ConsentController extends Controller
{
    /**
     * Store user consent
     */
    public function store(Request $request)
    {
        $request->validate([
            'terms_accepted' => 'required|accepted',
            'privacy_accepted' => 'required|accepted',
        ]);

        $sessionId = session()->getId();
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();

        UserConsent::recordConsent($sessionId, $ipAddress, $userAgent);

        return response()->json([
            'success' => true,
            'message' => 'Consent recorded successfully'
        ]);
    }

    /**
     * Check if user has given consent
     */
    public function check(Request $request)
    {
        $sessionId = session()->getId();
        $ipAddress = $request->ip();

        $hasConsent = UserConsent::hasConsent($sessionId, $ipAddress);

        return response()->json([
            'has_consent' => $hasConsent
        ]);
    }
}
