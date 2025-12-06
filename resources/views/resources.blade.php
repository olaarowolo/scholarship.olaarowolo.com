@extends('layouts.app')

@section('content')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Theme Configuration */
        :root {
            --color-brand-blue: #1E40AF;
            /* Strong Blue */
            --color-brand-dark: #111827;
            /* Dark Grey/Black */
            --color-accent-gold: #F59E0B;
            /* Amber/Gold */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            /* Light background */
        }

        /* Configure Tailwind to use our custom colors */
        .bg-brand-blue {
            background-color: var(--color-brand-blue);
        }

        .text-brand-blue {
            color: var(--color-brand-blue);
        }

        .bg-accent-gold {
            background-color: var(--color-accent-gold);
        }

        .text-accent-gold {
            color: var(--color-accent-gold);
        }

        .hover\:bg-brand-dark:hover {
            background-color: var(--color-brand-dark);
        }

        /* Custom Card Styles for visual appeal */
        .resource-card {
            transition: all 0.3s ease;
        }

        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Blue background wrapper extending to top */
        .hero-wrapper {
            background-color: var(--color-brand-blue);
            padding-top: 0;
            margin-top: 0;
        }
    </style>

    <!-- Blue Background Wrapper -->
    <div class="hero-wrapper">
        <!-- Navigation Bar -->
        @include('components.navbar', ['user' => Auth::user()])

        <!-- Hero Section -->
        <header class="text-white py-16 sm:py-24 pt-32 sm:pt-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight">
                    Scholarship Resources & Media Hub
                </h1>
                <p class="mt-4 text-xl sm:text-2xl font-light opacity-80 max-w-3xl mx-auto">
                    Access study guides, foundation media, and promotional materials to support your journey.
                </p>
                <div class="mt-8">
                    <a href="#resources"
                        class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-brand-blue bg-accent-gold hover:bg-yellow-400 transition duration-300 shadow-lg">
                        Explore Resources &darr;
                    </a>
                </div>
            </div>
        </header>
    </div>
    <!-- End Blue Background Wrapper -->

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <!-- 1. Educational Resources Section -->
        <section id="resources" class="mb-20">
            <h2
                class="text-3xl sm:text-4xl font-extrabold text-brand-dark mb-10 border-b-4 border-accent-gold inline-block pb-1">
                📚 Study & Application Guides
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Resource Card 1 -->
                <a href="javascript:void(0)"
                    onclick="alert('This resource will be available soon. Please check back later!')"
                    class="resource-card block bg-white p-6 rounded-xl shadow-lg border border-gray-200 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.42 9.043 5 7.007 5c-4.137 0-6.096 2.053-6.096 5.568 0 3.978 2.08 5.756 6.182 5.756C14.39 16.324 16 14.774 16 12s-1.61-4.324-6.097-4.324z">
                            </path>
                        </svg>
                        <h3 class="ml-3 text-xl font-bold text-gray-800">JAMB Prep Blueprint</h3>
                    </div>
                    <p class="text-gray-600 text-sm">A complete 90-day study plan covering all core UTME subjects and
                        recommended textbooks.</p>
                    <span class="mt-4 inline-block text-brand-blue font-semibold text-sm">Download PDF &rarr;</span>
                </a>

                <!-- Resource Card 2 -->
                <a href="javascript:void(0)"
                    onclick="alert('This resource will be available soon. Please check back later!')"
                    class="resource-card block bg-white p-6 rounded-xl shadow-lg border border-gray-200 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="ml-3 text-xl font-bold text-gray-800">Application Checklist</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Ensure you have all the necessary documents and meet the eligibility
                        criteria before applying.</p>
                    <span class="mt-4 inline-block text-brand-blue font-semibold text-sm">View Guide &rarr;</span>
                </a>

                <!-- Resource Card 3 -->
                <a href="javascript:void(0)"
                    onclick="alert('This resource will be available soon. Please check back later!')"
                    class="resource-card block bg-white p-6 rounded-xl shadow-lg border border-gray-200 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        <h3 class="ml-3 text-xl font-bold text-gray-800">Interview Tips</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Top strategies and expected questions to help you succeed in the final
                        selection stage.</p>
                    <span class="mt-4 inline-block text-brand-blue font-semibold text-sm">Watch Video &rarr;</span>
                </a>
            </div>
        </section>

        <!-- 2. Inspirational Content (Promotional) Section -->
        <section id="inspirational" class="mb-20">
            <h2
                class="text-3xl sm:text-4xl font-extrabold text-brand-dark mb-10 border-b-4 border-accent-gold inline-block pb-1">
                🌟 Success Stories & Foundation Media
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Video Placeholder Card -->
                <div class="lg:col-span-2 bg-gray-200 rounded-xl shadow-lg overflow-hidden border-2 border-brand-blue">
                    <!-- Placeholder for an embedded YouTube video/Player -->
                    <div class="relative aspect-video w-full">
                        <!-- Use a responsive placeholder for the video -->
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-800 text-white p-4">
                            <span class="text-2xl font-bold">Featured Video: Ola Arowolo Foundation Impact</span>
                        </div>
                        <!-- In a real app, embed code would go here:
                                        <iframe src="..." frameborder="0" allowfullscreen></iframe>
                                        -->
                    </div>
                    <div class="p-4 bg-white">
                        <p class="font-semibold text-lg text-brand-dark">Changing Lives Through Education</p>
                        <p class="text-sm text-gray-600">Watch the story of how the scholarship program has transformed
                            futures across the region.</p>
                    </div>
                </div>

                <!-- Testimonial Card -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex flex-col justify-between">
                    <div>
                        <blockquote class="italic text-gray-700 mb-4">
                            "The scholarship has been a life-changing opportunity, enabling me to pursue my dreams."
                        </blockquote>
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full object-cover mr-3"
                                src="https://placehold.co/40x40/1E40AF/FFFFFF?text=AA" alt="Applicant Avatar"
                                onerror="this.onerror=null;this.src='https://placehold.co/40x40/1E40AF/FFFFFF?text=AA';" />
                            <div>
                                <p class="font-semibold text-brand-blue">Shalom Oluwatayo</p>
                                <p class="text-xs text-gray-500">Mass Comm Student, Beneficiary 2025</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('testimonials') }}"
                        class="mt-4 text-sm font-medium text-accent-gold hover:text-yellow-700">Read
                        More Testimonials &rarr;</a>
                </div>
            </div>
        </section>

        <!-- 3. Promotional Downloads Section -->
        <section id="promotional-media">
            <h2
                class="text-3xl sm:text-4xl font-extrabold text-brand-dark mb-10 border-b-4 border-accent-gold inline-block pb-1">
                📢 Shareable Promotional Assets
            </h2>
            <p class="text-gray-600 mb-6 max-w-3xl">
                Help us spread the word! Download official media kits, banners, and flyers to share on social media and
                local community boards.
            </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <!-- Asset Card 1: Social Media Kit -->
                <div class="bg-white p-4 rounded-xl shadow-md text-center border border-gray-100">
                    <svg class="w-10 h-10 mx-auto text-pink-600 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V8a2 2 0 00-2-2H9a2 2 0 00-2 2v8l3-3m0-3h.01">
                        </path>
                    </svg>
                    <h4 class="font-bold text-gray-800 text-sm">Social Media Kit</h4>
                    <p class="text-xs text-gray-500 mt-1">Ready-to-post graphics for Instagram, X, and Facebook.</p>
                    <a href="#"
                        class="mt-3 inline-block bg-accent-gold text-brand-dark text-xs font-semibold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download ZIP (10MB)
                    </a>
                </div>

                <!-- Asset Card 2: Print Flyer (A5) -->
                <div class="bg-white p-4 rounded-xl shadow-md text-center border border-gray-100">
                    <svg class="w-10 h-10 mx-auto text-green-600 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <h4 class="font-bold text-gray-800 text-sm">A5 Print Flyer</h4>
                    <p class="text-xs text-gray-500 mt-1">High-resolution PDF for printing and distribution.</p>
                    <a href="#"
                        class="mt-3 inline-block bg-accent-gold text-brand-dark text-xs font-semibold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download PDF (2MB)
                    </a>
                </div>

                <!-- Asset Card 3: Desktop Banner -->
                <div class="bg-white p-4 rounded-xl shadow-md text-center border border-gray-100">
                    <svg class="w-10 h-10 mx-auto text-purple-600 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <h4 class="font-bold text-gray-800 text-sm">Website Banner</h4>
                    <p class="text-xs text-gray-500 mt-1">Leaderboard image for websites and digital ads.</p>
                    <a href="{{ asset('assets/img/2026_UTME_Scholarship_Application_for_Iba_Indigenes -  Web Open.jpg') }}"
                        class="mt-3 inline-block bg-accent-gold text-brand-dark text-xs font-semibold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download JPG (500KB)
                    </a>
                </div>

                <!-- Asset Card 4: Logo Pack -->
                <div class="bg-white p-4 rounded-xl shadow-md text-center border border-gray-100">
                    <svg class="w-10 h-10 mx-auto text-gray-700 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.5 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.5-3-9s1.343-9 3-9m-9 9h6">
                        </path>
                    </svg>
                    <h4 class="font-bold text-gray-800 text-sm">Logo & Brand Pack</h4>
                    <p class="text-xs text-gray-500 mt-1">EPS, PNG, and SVG formats of the foundation logo.</p>
                    <a href="#"
                        class="mt-3 inline-block bg-accent-gold text-brand-dark text-xs font-semibold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download ZIP (1MB)
                    </a>
                </div>

            </div>
            <br>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <!-- Asset Card 1: Social Media Kit -->
                <div class="bg-white p-4 rounded-xl shadow-md text-center border border-gray-100">
                    <svg class="w-10 h-10 mx-auto text-pink-600 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V8a2 2 0 00-2-2H9a2 2 0 00-2 2v8l3-3m0-3h.01">
                        </path>
                    </svg>
                    <h4 class="font-bold text-gray-800 text-sm">Social Media Kit</h4>
                    <p class="text-xs text-gray-500 mt-1">Ready-to-post graphics for Instagram, X, and Facebook.</p>
                    <a href="#"
                        class="mt-3 inline-block bg-accent-gold text-brand-dark text-xs font-semibold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download ZIP (10MB)
                    </a>
                </div>

                <!-- Asset Card 2: Print Flyer (A5) -->
                <div class="bg-white p-4 rounded-xl shadow-md text-center border border-gray-100">
                    <svg class="w-10 h-10 mx-auto text-green-600 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <h4 class="font-bold text-gray-800 text-sm">A5 Print Flyer</h4>
                    <p class="text-xs text-gray-500 mt-1">High-resolution PDF for printing and distribution.</p>
                    <a href="#"
                        class="mt-3 inline-block bg-accent-gold text-brand-dark text-xs font-semibold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download PDF (2MB)
                    </a>
                </div>

                <!-- Asset Card 3: Desktop Banner -->
                <div class="bg-white p-4 rounded-xl shadow-md text-center border border-gray-100">
                    <svg class="w-10 h-10 mx-auto text-purple-600 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <h4 class="font-bold text-gray-800 text-sm">Website Banner</h4>
                    <p class="text-xs text-gray-500 mt-1">Leaderboard image for websites and digital ads.</p>
                    <a href="#"
                        class="mt-3 inline-block bg-accent-gold text-brand-dark text-xs font-semibold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download PNG (500KB)
                    </a>
                </div>

                <!-- Asset Card 4: Logo Pack -->
                <div class="bg-white p-4 rounded-xl shadow-md text-center border border-gray-100">
                    <svg class="w-10 h-10 mx-auto text-gray-700 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.5 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.5-3-9s1.343-9 3-9m-9 9h6">
                        </path>
                    </svg>
                    <h4 class="font-bold text-gray-800 text-sm">Logo & Brand Pack</h4>
                    <p class="text-xs text-gray-500 mt-1">EPS, PNG, and SVG formats of the foundation logo.</p>
                    <a href="#"
                        class="mt-3 inline-block bg-accent-gold text-brand-dark text-xs font-semibold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download ZIP (1MB)
                    </a>
                </div>

            </div>
        </section>

    </main>

    <!-- Footer -->
    @include('partials.footer')
@endsection
