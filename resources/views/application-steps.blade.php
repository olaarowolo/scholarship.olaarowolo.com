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


    <!-- Hero Section -->
    <header class="hero-bg relative overflow-hidden pt-20 pb-28 sm:pt-28 lg:pt-36">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl tracking-tight font-extrabold text-gray-900 sm:text-6xl lg:text-7xl">
                    Application <span class="text-primary">Steps</span>
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                    A detailed guide to applying for the OA Foundation & Scholarship.
                </p>
            </div>
        </div>
    </header>

    <!-- Application Process Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Your Path to Scholarship</h2>
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
                        <h3 class="text-2xl font-bold text-primary mb-4">1. Initial Screening</h3>
                        <p class="text-gray-600 text-sm md:text-base mb-4">
                            Submit your online application, providing details of your background, WAEC/GCE results, and JAMB
                            score.
                        </p>
                        <ul class="text-gray-600 text-sm md:text-base list-disc list-inside">
                            <li>Complete the online application form</li>
                            <li>Upload your academic documents</li>
                            <li>Provide personal and contact information</li>
                        </ul>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div
                            class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-white shadow-lg">
                            1</div>
                    </div>
                    <div class="md:w-1/2 md:pl-10"></div>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row mb-12 items-center md:flex-row-reverse">
                    <div class="md:w-1/2 md:pl-10 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-primary mb-4">2. Local Verification</h3>
                        <p class="text-gray-600 text-sm md:text-base mb-4">
                            Successful candidates are contacted for physical verification of residency and indigene status
                            by local committees.
                        </p>
                        <ul class="text-gray-600 text-sm md:text-base list-disc list-inside">
                            <li>Receive notification of shortlisting</li>
                            <li>Attend verification meeting</li>
                            <li>Provide proof of Iba Town indigene status</li>
                        </ul>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div
                            class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-gray-50 shadow-lg">
                            2</div>
                    </div>
                    <div class="md:w-1/2 md:pr-10"></div>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row mb-12 items-center">
                    <div class="md:w-1/2 md:pr-10 text-center md:text-right">
                        <h3 class="text-2xl font-bold text-primary mb-4"> Admission Confirmation</h3>
                        <p class="text-gray-600 text-sm md:text-base mb-4">
                            Upon securing provisional admission, beneficiaries submit confirmation documents to activate the
                            funding cycle.
                        </p>
                        <ul class="text-gray-600 text-sm md:text-base list-disc list-inside">
                            <li>Secure university admission</li>
                            <li>Submit admission letter and documents</li>
                            <li>Complete scholarship agreement</li>
                        </ul>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div
                            class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-white shadow-lg">
                            3</div>
                    </div>
                    <div class="md:w-1/2 md:pl-10"></div>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col md:flex-row items-center md:flex-row-reverse">
                    <div class="md:w-1/2 md:pl-10 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-primary mb-4">Performance Tracking</h3>
                        <p class="text-gray-600 text-sm md:text-base mb-4">
                            Scholars submit semester results for review. Funds for the next academic year are disbursed
                            based on maintained CGPA.
                        </p>
                        <ul class="text-gray-600 text-sm md:text-base list-disc list-inside">
                            <li>Submit semester results</li>
                            <li>Maintain required CGPA</li>
                            <li>Receive funding for subsequent years</li>
                        </ul>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div
                            class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-gray-50 shadow-lg">
                            4</div>
                    </div>
                    <div class="md:w-1/2 md:pr-10"></div>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('apply') }}"
                    class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center">
                    Start Your Application Now
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <!-- Contact Info -->
                <div class="space-y-4 xl:col-span-1">
                    <img class="h-10 w-auto mb-4" src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                        alt="OA Logo" style="filter: invert(1) grayscale(100%) brightness(200%);">
                    <p class="text-gray-400 text-sm">A commitment to educational equity for Iba indigenes.</p>
                    <div class="text-sm text-gray-400 space-y-1 pt-2">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-envelope"></i>
                            <p>Email: <a href="mailto:scholarship@olaarowolo.com"
                                    class="hover:text-white">scholarship@olaarowolo.com</a></p>
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
                                <li><a href="{{ route('our-story') }}" class="text-base text-gray-300 hover:text-white">Our
                                        Story</a></li>
                                <li><a href="{{ route('application-steps') }}"
                                        class="text-base text-gray-300 hover:text-white">Application Steps</a></li>
                                <li><a href="{{ route('view-impact') }}"
                                        class="text-base text-gray-300 hover:text-white">View Impact</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Portal & Legal
                            </h3>
                            <ul role="list" class="mt-4 space-y-3">
                                <li><a href="{{ route('scholar-login') }}"
                                        class="text-base text-gray-300 hover:text-white">Scholar Login</a></li>
                                {{-- <li><a href="{{ route('sponsor-information') }}" class="text-base text-gray-300 hover:text-white">Sponsor Information</a></li> --}}

                                <li><a href="{{ route('terms') }}" class="text-base text-gray-300 hover:text-white">Terms &
                                        Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8 text-center">
                <p class="text-base text-gray-400">&copy; 2024 OA Foundation & Scholarship. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
@endsection
