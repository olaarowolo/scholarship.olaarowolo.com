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
                        class="mt-3 inline-block bg-accent-gold text-xs font-bold" style="color: #000000 !important px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
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
                        class="mt-3 inline-block bg-accent-gold text-xs font-bold" style="color: #000000 !important px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
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
                        download
                        class="mt-3 inline-block bg-accent-gold text-xs font-bold px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200"
                        style="color: #000000 !important;">
                        Download JPG (500KB)
                    </a>
                    <button onclick="shareFlier()"
                        class="mt-2 w-full inline-flex items-center justify-center bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded-full hover:bg-blue-700 transition duration-200">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                        </svg>
                        Share Flier
                    </button>
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
                        class="mt-3 inline-block bg-accent-gold text-xs font-bold" style="color: #000000 !important px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
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
                        class="mt-3 inline-block bg-accent-gold text-xs font-bold" style="color: #000000 !important px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
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
                        class="mt-3 inline-block bg-accent-gold text-xs font-bold" style="color: #000000 !important px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
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
                        class="mt-3 inline-block bg-accent-gold text-xs font-bold" style="color: #000000 !important px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
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
                        class="mt-3 inline-block bg-accent-gold text-xs font-bold" style="color: #000000 !important px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-200">
                        Download ZIP (1MB)
                    </a>
                </div>

            </div>
        </section>

    </main>

    <!-- Footer -->
    @include('partials.footer')

    <script>
        function shareFlier() {
            const flierUrl = '{{ url('assets/img/2026_UTME_Scholarship_Application_for_Iba_Indigenes -  Web Open.jpg') }}';
            const title = '2026 UTME Scholarship Application - OA Foundation';
            const text =
                'Check out the OA Foundation Scholarship opportunity for Iba indigenes! Apply now for the 2026 UTME Scholarship.';

            // Check if the Web Share API is supported
            if (navigator.share) {
                navigator.share({
                        title: title,
                        text: text,
                        url: flierUrl
                    })
                    .then(() => console.log('Successful share'))
                    .catch((error) => console.log('Error sharing:', error));
            } else {
                // Fallback: Show modal with sharing options
                showShareModal(flierUrl, title, text);
            }
        }

        function showShareModal(url, title, text) {
            const encodedUrl = encodeURIComponent(url);
            const encodedTitle = encodeURIComponent(title);
            const encodedText = encodeURIComponent(text);

            const shareLinks = {
                whatsapp: `https://wa.me/?text=${encodedText}%20${encodedUrl}`,
                facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
                twitter: `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedText}`,
                linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`,
                telegram: `https://t.me/share/url?url=${encodedUrl}&text=${encodedText}`,
                email: `mailto:?subject=${encodedTitle}&body=${encodedText}%20${encodedUrl}`
            };

            // Create modal HTML
            const modalHTML = `
                <div id="shareModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" onclick="closeShareModal(event)">
                    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6" onclick="event.stopPropagation()">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Share Scholarship Flier</h3>
                            <button onclick="closeShareModal()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">Choose a platform to share the scholarship information:</p>
                        <div class="grid grid-cols-3 gap-4">
                            <a href="${shareLinks.whatsapp}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-colors">
                                <svg class="w-8 h-8 text-green-600 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">WhatsApp</span>
                            </a>
                            <a href="${shareLinks.facebook}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                                <svg class="w-8 h-8 text-blue-600 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">Facebook</span>
                            </a>
                            <a href="${shareLinks.twitter}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-sky-50 hover:bg-sky-100 rounded-xl transition-colors">
                                <svg class="w-8 h-8 text-sky-600 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">Twitter</span>
                            </a>
                            <a href="${shareLinks.linkedin}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                                <svg class="w-8 h-8 text-blue-700 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">LinkedIn</span>
                            </a>
                            <a href="${shareLinks.telegram}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                                <svg class="w-8 h-8 text-blue-500 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">Telegram</span>
                            </a>
                            <a href="${shareLinks.email}" class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition-colors">
                                <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">Email</span>
                            </a>
                        </div>
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <label class="text-xs font-semibold text-gray-700 mb-2 block">Or copy link:</label>
                            <div class="flex items-center gap-2">
                                <input type="text" value="${url}" readonly class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg bg-white" id="shareUrl">
                                <button onclick="copyToClipboard()" class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-lg hover:bg-gray-700 transition-colors">
                                    Copy
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);
            document.body.style.overflow = 'hidden';
        }

        function closeShareModal(event) {
            if (event && event.target.id !== 'shareModal') return;
            const modal = document.getElementById('shareModal');
            if (modal) {
                modal.remove();
                document.body.style.overflow = '';
            }
        }

        function copyToClipboard() {
            const input = document.getElementById('shareUrl');
            input.select();
            document.execCommand('copy');

            // Show feedback
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Copied!';
            button.classList.add('bg-green-600');
            button.classList.remove('bg-gray-800');

            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-green-600');
                button.classList.add('bg-gray-800');
            }, 2000);
        }
    </script>
@endsection
