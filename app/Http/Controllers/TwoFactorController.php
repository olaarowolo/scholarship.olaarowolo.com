<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    /**
     * Show the 2FA verification form
     */
    public function show()
    {
        $user = Auth::user();

        if (!$user->two_factor_enabled) {
            return redirect()->route('dashboard');
        }

        return view('auth.two-factor-verify');
    }

    /**
     * Verify the 2FA code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = Auth::user();

        if ($user->verifyTwoFactorCode($request->code)) {
            $user->resetTwoFactorCode();
            $request->session()->put('two_factor_verified_' . $user->id, true);

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Two-factor authentication verified successfully!');
        }

        return back()->withErrors([
            'code' => 'The verification code is invalid or has expired.',
        ]);
    }

    /**
     * Resend the 2FA code
     */
    public function resend(Request $request)
    {
        $user = Auth::user();

        $code = $user->generateTwoFactorCode();

        Mail::to($user->email)->send(new TwoFactorCode($code, $user->name));

        return back()->with('success', 'A new verification code has been sent to your email.');
    }

    /**
     * Show 2FA settings page
     */
    public function settings()
    {
        return view('auth.two-factor-settings');
    }

    /**
     * Enable or disable 2FA
     */
    public function toggle(Request $request)
    {
        $user = Auth::user();

        $user->two_factor_enabled = !$user->two_factor_enabled;
        $user->save();

        if ($user->two_factor_enabled) {
            $code = $user->generateTwoFactorCode();
            Mail::to($user->email)->send(new TwoFactorCode($code, $user->name));

            return back()->with('success', 'Two-factor authentication enabled! Check your email for the verification code.');
        }

        $user->resetTwoFactorCode();
        $request->session()->forget('two_factor_verified_' . $user->id);

        return back()->with('success', 'Two-factor authentication disabled.');
    }
}
