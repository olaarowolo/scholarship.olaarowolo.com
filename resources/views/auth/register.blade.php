@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>

    @php
        $user = Auth::user();
    @endphp

    @include('components.navbar', ['user' => $user])

    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
    <!-- Register Card -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header Section -->
        <div class="px-8 pt-8 pb-6 text-center">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-16 h-16 bg-black rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h1>
            <p class="text-gray-600">Join the Iba Kingdom Scholarship Program</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="px-8 pb-8 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Full Name
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        autocomplete="name"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-black focus:border-black transition duration-150"
                        placeholder="John Doe" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        autocomplete="username"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-black focus:border-black transition duration-150"
                        placeholder="you@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-black focus:border-black transition duration-150"
                        placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                    Confirm Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-black focus:border-black transition duration-150"
                        placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Iba Kingdom Indigene Confirmation -->
            <div class="bg-yellow-50 border-2 border-yellow-300 rounded-lg p-4">
                <div class="flex items-start">
                    <input id="is_iba_indigene" name="is_iba_indigene" type="checkbox"
                        class="h-5 w-5 text-black border-gray-300 rounded focus:ring-black mt-0.5" required
                        value="1" {{ old('is_iba_indigene') ? 'checked' : '' }}>
                    <label for="is_iba_indigene" class="ml-3 block text-sm">
                        <span class="font-bold text-gray-900">I confirm that I am an indigene of Iba Kingdom</span>
                        <p class="mt-1 text-xs text-gray-700">
                            This scholarship is exclusively for indigenes of Iba Kingdom, Ojo Local Government Area,
                            Lagos State, Nigeria. By checking this box, you confirm your indigene status.
                        </p>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('is_iba_indigene')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-semibold text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition-all duration-150">
                <span>Create Account</span>
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>
        </form>

        <!-- Footer Section -->
        <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold text-black hover:text-gray-700 transition">
                    Sign in here
                </a>
            </p>
            <p class="text-center text-xs text-gray-500 mt-3">
                Or
                <a href="{{ route('home') }}" class="font-medium text-black hover:text-gray-700 transition">
                    return to homepage
                </a>
            </p>
        </div>
    </div>

    <!-- Security Badge -->
    <div class="text-center mt-6">
        <p class="text-sm text-gray-600 flex items-center justify-center">
            <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Your information is secure and protected
        </p>
    </div>
    </div>
    </div>
@endsection
