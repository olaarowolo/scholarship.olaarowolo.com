@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #000000;
        --secondary: #333333;
        --background: #f8f8f8;
        --text-dark: #1f2937;
        --text-light: #ffffff;
        --accent: #e5e7eb;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background);
    }

    .btn-primary {
        background-color: var(--primary);
        color: var(--text-light);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
    }

    .btn-primary:hover {
        background-color: var(--secondary);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .card {
        border: 1px solid var(--accent);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
    }
</style>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#000000',
                    'secondary': '#333333',
                    'accent': '#e5e7eb',
                },
            }
        }
    }
</script>

    <!-- Navigation Bar -->
    @include('components.navbar')


<!-- Login Section -->
<section class="py-24 bg-white">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Scholar Login</h1>
            <p class="mt-2 text-gray-600">Access your scholarship dashboard</p>
        </div>

        <div class="card bg-white p-8 rounded-xl shadow-lg">
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                </div>

                <button type="submit" class="btn-primary w-full py-2 px-4 rounded-md font-medium">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="#" class="text-sm text-primary hover:text-secondary">Forgot your password?</a>
            </div>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('apply') }}" class="text-primary hover:text-secondary font-medium">Apply for Scholarship</a>
                </p>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
@include('partials.footer')

@endsection
