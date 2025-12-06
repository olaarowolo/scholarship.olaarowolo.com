<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_iba_indigene' => ['required', 'accepted'],
        ], [
            'is_iba_indigene.required' => 'You must confirm that you are an indigene of Iba Kingdom to register.',
            'is_iba_indigene.accepted' => 'You must confirm that you are an indigene of Iba Kingdom to register.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_iba_indigene' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect to apply form if user came from Start Application button
        // Otherwise redirect to dashboard
        return redirect()->intended(route('apply-form', absolute: false));
    }
}
