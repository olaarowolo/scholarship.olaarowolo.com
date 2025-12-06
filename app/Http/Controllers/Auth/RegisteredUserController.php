<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
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
        $validationRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $validationMessages = [];

        // Only validate is_iba_indigene if the column exists in the database
        if (Schema::hasColumn('users', 'is_iba_indigene')) {
            $validationRules['is_iba_indigene'] = ['required', 'accepted'];
            $validationMessages['is_iba_indigene.required'] = 'You must confirm that you are an indigene of Iba Kingdom to register.';
            $validationMessages['is_iba_indigene.accepted'] = 'You must confirm that you are an indigene of Iba Kingdom to register.';
        }

        $request->validate($validationRules, $validationMessages);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        // Only include is_iba_indigene if the column exists
        if (Schema::hasColumn('users', 'is_iba_indigene')) {
            $userData['is_iba_indigene'] = true;
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        // Redirect to apply form if user came from Start Application button
        // Otherwise redirect to dashboard
        return redirect()->intended(route('apply-form', absolute: false));
    }
}
