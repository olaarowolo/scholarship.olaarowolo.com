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

    /* Hero section background texture */
    .hero-bg {
        background: linear-gradient(to bottom, #ffffff, #f1f1f1);
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

    // Function to toggle mobile menu visibility
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    // Function for smooth scrolling
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
                // Close mobile menu after clicking a link
                const menu = document.getElementById('mobile-menu');
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
        });
    });
</script>

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md sticky top-0 z-50 transition-shadow duration-300 border-b border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-10 w-auto"
                         src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                         alt="Ola Arowolo Scholarship Logo">
                </div>

                <!-- Desktop Links -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">
                    <a href="#mission" class="text-gray-600 hover:text-primary px-3 py-2 text-base font-medium transition duration-200">Our Mission</a>
                    <a href="#process" class="text-gray-600 hover:text-primary px-3 py-2 text-base font-medium transition duration-200">How to Apply</a>
                    <a href="#impact" class="text-gray-600 hover:text-primary px-3 py-2 text-base font-medium transition duration-200">Impact</a>
                    <a href="#contact" class="text-gray-600 hover:text-primary px-3 py-2 text-base font-medium transition duration-200">Contact</a>
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
                <a href="#mission" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium" onclick="toggleMenu()">Our Mission</a>
                <a href="#process" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium" onclick="toggleMenu()">How to Apply</a>
                <a href="#impact" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium" onclick="toggleMenu()">Impact</a>
                <a href="#contact" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium" onclick="toggleMenu()">Contact</a>
                <a href="{{ route('apply') }}" class="btn-primary block w-full text-center mt-4 px-3 py-2 rounded-full text-base font-medium">Apply Now</a>
            </div>
        </div>
    </nav>

    <!-- 1. Hero Section -->
    <header class="hero-bg relative overflow-hidden pt-20 pb-28 sm:pt-28 lg:pt-36">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-7 lg:text-left">
                    <div class="text-sm font-semibold uppercase tracking-widest text-primary">
                        Empowering Local Excellence
                    </div>
                    <h1 class="mt-4 text-5xl tracking-tight font-extrabold text-gray-900 sm:text-6xl lg:text-5xl xl:text-7xl">
                        The <span class="text-primary block lg:inline">Scholarship</span> for Iba Town's Brightest
                    </h1>
                    <p class="mt-6 text-xl text-gray-600 max-w-xl mx-auto lg:mx-0">
                        Providing financial and mentorship support to emerging leaders to access and excel in quality university education.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-4">
                        <a href="{{ route('apply') }}" class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center">
                            Start Application &rarr;
                        </a>
                        <a href="#process" class="inline-flex items-center justify-center px-10 py-4 border border-secondary text-base font-medium rounded-full text-primary bg-white hover:bg-gray-100 transition duration-300 shadow-md">
                            View Process
                        </a>
                    </div>
                    <p class="mt-4 text-sm text-gray-500 sm:text-center lg:text-left">
                        Next Application Window: Dec. 8, 2025 - Jan. 16, 2026
                    </p>
                </div>

                <!-- Mockup Image/Illustration Placeholder -->
                <div class="mt-16 lg:mt-0 lg:col-span-5">
                    <div class="aspect-w-4 aspect-h-3 rounded-3xl overflow-hidden shadow-2xl card transform hover:scale-[1.01]">
                        <img class="w-full object-cover h-auto rounded-3xl" src="{{ asset('assets/img/2025_UTME_Scholarship_Application_for_Iba_Indigenes -  Web Open.jpg') }}" alt="Students studying together">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. Mission Section -->
    <section id="mission" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">
                    Why We Exist
                </h2>
                <p class="mt-2 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                    Our Core Values and Commitment
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1: Focus on Locals -->
                <div class="card bg-white p-8 rounded-xl shadow-lg border-t-4 border-primary">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fa-solid fa-house-chimney text-3xl text-primary"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Community First</h3>
                    </div>
                    <p class="text-gray-600">
                        Dedicated solely to supporting indigenes of Iba town, Ojo, Lagos, ensuring that funds are reinvested directly into the community's future leadership.
                    </p>
                </div>
                <!-- Value 2: Performance-based -->
                <div class="card bg-white p-8 rounded-xl shadow-lg border-t-4 border-secondary">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fa-solid fa-star text-3xl text-secondary"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Academic Excellence</h3>
                    </div>
                    <p class="text-gray-600">
                        Funding is tied to academic performance, encouraging scholars to maintain high standards (e.g., First Class honors receive full subsequent funding).
                    </p>
                </div>
                <!-- Value 3: Comprehensive Support -->
                <div class="card bg-white p-8 rounded-xl shadow-lg border-t-4 border-primary">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fa-solid fa-handshake-angle text-3xl text-primary"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Beyond Finances</h3>
                    </div>
                    <p class="text-gray-600">
                        Beyond financial aid, we offer mentorship, career guidance, and a support network to help scholars navigate university life and beyond.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Application Process Section -->
    <section id="process" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">
                    Your Path to Scholarship
                </h2>
                <p class="mt-2 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                    The 4-Step Application Flow
                </p>
            </div>

            <div class="relative max-w-4xl mx-auto">
                <!-- Timeline Line -->
                <div class="hidden md:block absolute h-full w-0.5 bg-accent left-1/2 transform -translate-x-1/2"></div>

                <!-- Step 1 -->
                <div class="flex flex-col md:flex-row mb-12 items-center">
                    <div class="md:w-1/2 md:pr-10 text-center md:text-right">
                        <h3 class="text-2xl font-bold text-primary mb-1">1. Initial Screening</h3>
                        <p class="text-gray-600 text-sm md:text-base">Submit your online application, providing details of your background, WAEC/GCE results, and JAMB score.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-white shadow-lg">1</div>
                    </div>
                    <div class="md:w-1/2 md:pl-10"></div>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row mb-12 items-center md:flex-row-reverse">
                    <div class="md:w-1/2 md:pl-10 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-primary mb-1">2. Local Verification</h3>
                        <p class="text-gray-600 text-sm md:text-base">Successful candidates are contacted for physical verification of residency and indigene status by local committees.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-gray-50 shadow-lg">2</div>
                    </div>
                    <div class="md:w-1/2 md:pr-10"></div>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row mb-12 items-center">
                    <div class="md:w-1/2 md:pr-10 text-center md:text-right">
                        <h3 class="text-2xl font-bold text-primary mb-1">3. Admission Confirmation</h3>
                        <p class="text-gray-600 text-sm md:text-base">Upon securing provisional admission, beneficiaries submit confirmation documents to activate the funding cycle.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-white shadow-lg">3</div>
                    </div>
                    <div class="md:w-1/2 md:pl-10"></div>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col md:flex-row items-center md:flex-row-reverse">
                    <div class="md:w-1/2 md:pl-10 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-primary mb-1">4. Performance Tracking</h3>
                        <p class="text-gray-600 text-sm md:text-base">Scholars submit semester results for review. Funds for the next academic year are disbursed based on maintained CGPA.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-gray-50 shadow-lg">4</div>
                    </div>
                    <div class="md:w-1/2 md:pr-10"></div>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('apply') }}" class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center">
                    Check Eligibility & Apply Now
                </a>
            </div>
        </div>
    </section>

    <!-- 4. Key Stats/Impact Section -->
    <section id="impact" class="py-24 bg-white border-t border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-16 sm:text-4xl">
                Impact Since Inception
            </h2>
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4 text-center">
                <!-- Stat 1 -->
                <div class="p-4 sm:p-6 bg-gray-50 rounded-xl shadow-inner border border-accent">
                    <p class="text-4xl sm:text-5xl font-extrabold text-primary">16+</p>
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">Beneficiaries Since 2022</p>
                </div>
                <!-- Stat 2 -->
                <div class="p-4 sm:p-6 bg-gray-50 rounded-xl shadow-inner border border-accent">
                    <p class="text-4xl sm:text-5xl font-extrabold text-primary">85%</p>
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">JAMB Aced (250+)</p>
                </div>
                <!-- Stat 3 -->
                <div class="p-4 sm:p-6 bg-gray-50 rounded-xl shadow-inner border border-accent">
                    <p class="text-4xl sm:text-5xl font-extrabold text-primary">100%</p>
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">Confirmed University Admission</p>
                </div>
                <!-- Stat 4 -->
                <div class="p-4 sm:p-6 bg-gray-50 rounded-xl shadow-inner border border-accent">
                    <p class="text-4xl sm:text-5xl font-extrabold text-primary">First Class</p>
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">Achieved by Top Scholar</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Footer/Contact Section -->
    <footer id="contact" class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <!-- Contact Info -->
                <div class="space-y-4 xl:col-span-1">
                    <img class="h-10 w-auto mb-4"
                         src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                         alt="Ola Arowolo Logo" style="filter: invert(1) grayscale(100%) brightness(200%);">
                    <p class="text-gray-400 text-sm">A commitment to educational equity for Iba indigenes.</p>
                    <div class="text-sm text-gray-400 space-y-1 pt-2">
                        <div class="flex items-center space-x-2">
                             <i class="fa-solid fa-envelope"></i>
                             <p>Email: <a href="mailto:scholarship@olaarowolo.com" class="hover:text-white">scholarship@olaarowolo.com</a></p>
                        </div>
                        <div class="flex items-center space-x-2">
                             <i class="fa-solid fa-location-dot"></i>
                             <p>Location: Iba Town, Ojo, Lagos, Nigeria</p>
                        </div>
                    </div>
                </div>
                <!-- Navigation Links -->
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Quick Links
                            </h3>
                            <ul role="list" class="mt-4 space-y-3">
                                <li><a href="#mission" class="text-base text-gray-300 hover:text-white">Our Story</a></li>
                                <li><a href="#process" class="text-base text-gray-300 hover:text-white">Application Steps</a></li>
                                <li><a href="#impact" class="text-base text-gray-300 hover:text-white">View Impact</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Portal & Legal
                            </h3>
                            <ul role="list" class="mt-4 space-y-3">
                                <li><a href="{{ route('apply') }}" class="text-base text-gray-300 hover:text-white">Scholar Login</a></li>
                                <li><a href="#" class="text-base text-gray-300 hover:text-white">Sponsor Information</a></li>
                                <li><a href="#" class="text-base text-gray-300 hover:text-white">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8 text-center">
                <p class="text-base text-gray-400">
                    &copy; 2024 Ola Arowolo Scholarship. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
@endsection
