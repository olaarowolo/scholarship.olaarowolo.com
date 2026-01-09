@extends('layouts.app')

@section('content')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Theme Configuration */
        :root {
            --color-brand-dark: #111827;
            --color-accent-gold: #F59E0B;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }

        .bg-brand-dark {
            background-color: var(--color-brand-dark);
        }

        .text-brand-dark {
            color: var(--color-brand-dark);
        }

        .bg-accent-gold {
            background-color: var(--color-accent-gold);
        }

        .text-accent-gold {
            color: var(--color-accent-gold);
        }

        .press-card {
            transition: all 0.3s ease;
        }

        .press-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>

    <!-- Blue Background Wrapper -->
    <div style="background-color: #1E40AF;">
        <!-- Navigation Bar -->
        @include('components.navbar', ['user' => Auth::user()])

        <!-- Hero Section -->
        <header class="text-white py-16 sm:py-24 pt-32 sm:pt-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight">
                    Press & Media Center
                </h1>
                <p class="mt-4 text-xl sm:text-2xl font-light opacity-80 max-w-3xl mx-auto">
                    Latest news, press releases, and media coverage about the Ola Arowolo Scholarship Foundation
                </p>
            </div>
        </header>
    </div>
    <!-- End Blue Background Wrapper -->

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <!-- Press Releases Section -->
        <section id="press-releases" class="mb-20">
            <h2
                class="text-3xl sm:text-4xl font-extrabold text-brand-dark mb-10 border-b-4 border-accent-gold inline-block pb-1">
                📰 Press Releases
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Press Release 1 -->
                <div class="press-card bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase">December 8, 2025</span>
                        <span class="px-3 py-1 bg-accent-gold text-black text-xs font-bold rounded-full">New</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">2025/2026 Scholarship Application Now Open</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        The Ola Arowolo Foundation announces the opening of applications for the 2025/2026 academic year
                        scholarship program, supporting Iba Kingdom indigenes pursuing higher education.
                    </p>
                    <a href="javascript:void(0)" onclick="alert('Full press release coming soon!')"
                        class="text-blue-600 font-semibold text-sm hover:underline cursor-pointer">
                        Read Full Release &rarr;
                    </a>
                </div>

                <!-- Press Release 2 -->
                <div class="press-card bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase">November 15, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">50 Scholars Graduate with Honors</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Celebrating academic excellence as 50 scholarship recipients graduate from various universities
                        across
                        Nigeria with outstanding academic records.
                    </p>
                    <a href="javascript:void(0)" onclick="alert('Full press release coming soon!')"
                        class="text-blue-600 font-semibold text-sm hover:underline cursor-pointer">
                        Read Full Release &rarr;
                    </a>
                </div>

                <!-- Press Release 3 -->
                <div class="press-card bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase">October 5, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Foundation Expands to 15 Universities</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        The scholarship program extends its reach to three additional universities, providing more
                        opportunities for deserving students from Iba Kingdom.
                    </p>
                    <a href="javascript:void(0)" onclick="alert('Full press release coming soon!')"
                        class="text-blue-600 font-semibold text-sm hover:underline cursor-pointer">
                        Read Full Release &rarr;
                    </a>
                </div>

            </div>
        </section>

        <!-- Media Coverage Section -->
        <section id="media-coverage" class="mb-20">
            <h2
                class="text-3xl sm:text-4xl font-extrabold text-brand-dark mb-10 border-b-4 border-accent-gold inline-block pb-1">
                📺 Media Coverage
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Media Article 1 -->
                <div class="press-card bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex">
                    <div class="flex-shrink-0 mr-4">
                        <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">The Guardian Nigeria</p>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">
                            Empowering Local Communities Through Education
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">
                            Feature article highlighting the impact of community-focused scholarship programs...
                        </p>
                        <a href="javascript:void(0)" onclick="alert('Article link coming soon!')"
                            class="text-blue-600 font-semibold text-sm hover:underline cursor-pointer">
                            Read Article &rarr;
                        </a>
                    </div>
                </div>

                <!-- Media Article 2 -->
                <div class="press-card bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex">
                    <div class="flex-shrink-0 mr-4">
                        <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Channels TV</p>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">
                            Success Stories from Iba Kingdom Scholars
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">
                            Television feature showcasing testimonials from scholarship beneficiaries...
                        </p>
                        <a href="javascript:void(0)" onclick="alert('Video link coming soon!')"
                            class="text-blue-600 font-semibold text-sm hover:underline cursor-pointer">
                            Watch Video &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- Media Kit Section -->
        <section id="media-kit" class="mb-20">
            <h2
                class="text-3xl sm:text-4xl font-extrabold text-brand-dark mb-10 border-b-4 border-accent-gold inline-block pb-1">
                📁 Media Kit
            </h2>
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                <p class="text-gray-700 mb-6">
                    Download our official media kit containing logos, brand guidelines, fact sheets, and high-resolution
                    images for press and media use.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="border border-gray-200 rounded-lg p-4 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-600 mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h4 class="font-bold text-gray-800 mb-2">Logo Pack</h4>
                        <p class="text-xs text-gray-600 mb-3">PNG, SVG, EPS formats</p>
                        <button onclick="alert('Download available soon!')"
                            class="bg-accent-gold text-black px-4 py-2 rounded-full text-sm font-semibold hover:bg-yellow-600 transition cursor-pointer">
                            Download
                        </button>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-600 mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h4 class="font-bold text-gray-800 mb-2">Fact Sheet</h4>
                        <p class="text-xs text-gray-600 mb-3">Key statistics & info</p>
                        <button onclick="alert('Download available soon!')"
                            class="bg-accent-gold text-black px-4 py-2 rounded-full text-sm font-semibold hover:bg-yellow-600 transition cursor-pointer">
                            Download
                        </button>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-600 mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <h4 class="font-bold text-gray-800 mb-2">Brand Guidelines</h4>
                        <p class="text-xs text-gray-600 mb-3">Usage & style guide</p>
                        <button onclick="alert('Download available soon!')"
                            class="bg-accent-gold text-black px-4 py-2 rounded-full text-sm font-semibold hover:bg-yellow-600 transition cursor-pointer">
                            Download
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="press-contact" class="bg-gray-100 p-8 rounded-xl">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-brand-dark mb-4">Media Inquiries</h2>
                <p class="text-gray-700 mb-6">
                    For press inquiries, interview requests, or additional information, please contact our media relations
                    team.
                </p>
                <div class="space-y-2 text-left inline-block">
                    <p class="text-gray-800">
                        <span class="font-semibold">Email:</span>
                        <a href="mailto:press@olaarowolo.com" class="text-blue-600 hover:underline">
                            press@olaarowolo.com
                        </a>
                    </p>
                    <p class="text-gray-800">
                        <span class="font-semibold">Phone:</span>
                        <a href="tel:+2341234567890" class="text-blue-600 hover:underline">
                            +234 123 456 7890
                        </a>
                    </p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    @include('partials.footer')
@endsection
