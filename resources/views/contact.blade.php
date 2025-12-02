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

    /* Form styling */
    .form-input {
        border: 1px solid var(--accent);
        border-radius: 0.5rem;
        padding: 0.75rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }
    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        display: block;
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
                    <a href="{{ route('contact') }}" class="text-primary px-3 py-2 text-base font-medium transition duration-200">Contact</a>
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
                <a href="{{ route('contact') }}" class="text-primary hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium">Contact</a>
                <a href="{{ route('apply') }}" class="btn-primary block w-full text-center mt-4 px-3 py-2 rounded-full text-base font-medium">Apply Now</a>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="hero-bg relative overflow-hidden pt-20 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl lg:text-6xl">
                Contact <span class="text-primary">Us</span>
            </h1>
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                Have questions about the scholarship? We're here to help. Send us your inquiries and we'll get back to you promptly.
            </p>
        </div>
    </header>

    <!-- Contact Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Get in Touch</h2>

                    <div class="space-y-8">
                        <!-- Email -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Email Us</h3>
                                <p class="text-gray-600 mt-1">Send us your questions and we'll respond within 24 hours.</p>
                                <a href="mailto:scholarship@olaarowolo.com" class="text-primary hover:text-secondary font-medium mt-2 inline-block">
                                    scholarship@olaarowolo.com
                                </a>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Location</h3>
                                <p class="text-gray-600 mt-1">Find us in the heart of Iba community.</p>
                                <p class="text-gray-900 font-medium mt-2">
