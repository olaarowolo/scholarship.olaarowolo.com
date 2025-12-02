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
        menu.classList.toggle('translate-y-full');
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
    @include('components.navbar')


    <!-- 1. Hero Section -->
    @include('components.header')


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

    <!-- Application Process Section -->
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
                        <h3 class="text-2xl font-bold text-primary mb-1">Initial Screening</h3>
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
                        <h3 class="text-2xl font-bold text-primary mb-1">Local Verification</h3>
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
                        <h3 class="text-2xl font-bold text-primary mb-1">Admission Confirmation</h3>
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
                        <h3 class="text-2xl font-bold text-primary mb-1">Performance Tracking</h3>
                        <p class="text-gray-600 text-sm md:text-base">Scholars submit semester results for review. Funds for the next academic year are disbursed based on maintained CGPA.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-gray-50 shadow-lg">4</div>
                    </div>
                    <div class="md:w-1/2 md:pr-10"></div>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('apply') }}" class="bg-gray-400 text-gray-600 cursor-not-allowed text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center" disabled>
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
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">JAMB Aced (10+)</p>
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
    @include('partials.footer')

@endsection
