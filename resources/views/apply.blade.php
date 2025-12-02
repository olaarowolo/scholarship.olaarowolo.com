@extends('layouts.app')

@section('content')
<style>
    /* Define the black and white theme based on the logo */
    :root {
        --primary: #000000;
        --secondary: #333333;
        --background: #f8f8f8;
        --text-dark: #1f2937;
        --text-light: #ffffff;
        --accent: #e5e7eb; /* Light gray for subtle accents/borders */
    }

    body {
        font-family: 'Inter', sans-serif;
        scroll-behavior: smooth;
        background-color: var(--background);
    }
    /* Custom styles for the primary black CTA button */
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

    /* Subtle card shadow and border */
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
    <nav class="bg-white shadow-md sticky top-0 z-50 transition-shadow duration-300 border-b border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img class="h-10 w-auto"
                             src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                             alt="OA Scholarship Logo">
                    </a>
                </div>

                <!-- Desktop Links -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">
                    <a href="{{ route('home') }}#mission" class="text-gray-600 hover:text-primary px-3 py-2 text-base font-medium transition duration-200">Our Mission</a>
                    <a href="{{ route('how-it-works') }}" class="text-gray-600 hover:text-primary px-3 py-2 text-base font-medium transition duration-200">How to Apply</a>
                    <a href="{{ route('home') }}#impact" class="text-gray-600 hover:text-primary px-3 py-2 text-base font-medium transition duration-200">Impact</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 hover:text-primary px-3 py-2 text-base font-medium transition duration-200">Contact</a>
                    <!-- CTA Button -->
                    <a href="{{ route('apply') }}" class="btn-primary text-sm font-semibold px-6 py-2.5 rounded-full ml-4">
                        Apply Now
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-primary hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary" aria-expanded="false" onclick="toggleMenu()">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}#mission" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium">Our Mission</a>
                <a href="{{ route('how-it-works') }}" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium">How to Apply</a>
                <a href="{{ route('home') }}#impact" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium">Impact</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium">Contact</a>
                <a href="{{ route('apply') }}" class="btn-primary block w-full text-center mt-4 px-3 py-2 rounded-full text-base font-medium">Apply Now</a>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="hero-bg relative overflow-hidden pt-20 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl lg:text-6xl">
                Apply for the <span class="text-primary">Scholarship</span>
            </h1>
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                Take the first step towards your educational dreams. Our application process is designed to be straightforward and accessible.
            </p>
        </div>
    </header>

    <!-- Application Status Section -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Application Status
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Current application window information
                </p>
            </div>

            <div class="card bg-gradient-to-r from-gray-50 to-gray-100 p-8 rounded-xl shadow-lg mb-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary text-white rounded-full mb-4">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Next Application Window</h3>
                    <p class="text-xl text-primary font-semibold mb-4">December 8, 2025 - January 16, 2026</p>
                    <p class="text-gray-600 mb-6">
                        Applications for the 2025/2026 academic year will open soon. Stay tuned for updates and prepare your documents.
                    </p>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Important:</strong> The applicant portal will be available during the application window. Early preparation is recommended.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coming Soon Notice -->
            <div class="card bg-gradient-to-r from-gray-50 to-gray-100 p-8 rounded-xl shadow-lg text-center">
                <div class="mb-6">
                    <i class="fas fa-tools text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-4">Applicant Portal Coming Soon</h3>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        We're currently building a secure online application system. In the meantime, you can prepare your documents and stay updated.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8 mb-12">
                    <div class="text-left bg-white p-6 rounded-lg shadow-md">
                        <h4 class="font-semibold text-xl text-gray-900 mb-4">Required Documents:</h4>
                        <ul class="text-base text-gray-700 space-y-3 list-disc list-inside">
                            <li>WAEC/GCE Results</li>
                            <li>JAMB Result Slip</li>
                            <li>Birth Certificate</li>
                            <li>Proof of Indigene Status</li>
                            <li>Passport Photograph</li>
                        </ul>
                    </div>
                    <div class="text-left bg-white p-6 rounded-lg shadow-md">
                        <h4 class="font-semibold text-xl text-gray-900 mb-4">Eligibility Check:</h4>
                        <ul class="text-base text-gray-700 space-y-3 list-disc list-inside">
                            <li>Iba Town Indigene</li>
                            <li>Strong Academic Record</li>
                            <li>University Admission</li>
                            <li>Financial Need</li>
                            <li>Community Involvement</li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="{{ route('how-it-works') }}" class="btn-primary text-lg font-bold px-8 py-3 rounded-full shadow-lg inline-flex items-center justify-center">
                        View Application Process
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer/Contact Section -->
    @include('partials.footer')


    <script>
        // Function to toggle mobile menu visibility
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
@endsection
