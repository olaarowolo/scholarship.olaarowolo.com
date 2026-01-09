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
                    Our <span class="text-primary">Impact</span>
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                    See how the OA Foundation & Scholarship is transforming lives and communities.
                </p>
            </div>
        </div>
    </header>

    <!-- Key Stats Section -->
    <section class="py-24 bg-white border-t border-accent">
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

    <!-- Success Stories Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Success Stories
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Hear from our scholars about how the scholarship has changed their lives.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Story 1 -->
                <div class="card bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div
                            class="h-12 w-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">
                            A</div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Adebayo O.</h3>
                            <p class="text-gray-600">Engineering Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "The OA Foundation & Scholarship gave me the financial freedom to focus on my studies. I'm now in my
                        final year with a First Class GPA, pursuing my dream of becoming an engineer."
                    </p>
                </div>

                <!-- Story 2 -->
                <div class="card bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div
                            class="h-12 w-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">
                            C</div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Chioma N.</h3>
                            <p class="text-gray-600">Medical Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Without this scholarship, medical school would have been impossible. The mentorship program has
                        been invaluable in helping me navigate university life."
                    </p>
                </div>

                <!-- Story 3 -->
                <div class="card bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div
                            class="h-12 w-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">
                            K</div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Kemi A.</h3>
                            <p class="text-gray-600">Law Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "This scholarship represents hope for Iba Town's youth. It's not just financial aid; it's an
                        investment in our community's future leaders."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Impact Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Community Impact
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    How our scholars are giving back to Iba Town.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Impact 1 -->
                <div class="card bg-white p-8 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold text-primary mb-4">Educational Outreach</h3>
                    <p class="text-gray-600">
                        Our scholars regularly return to Iba Town to mentor secondary school students, sharing their
                        experiences and inspiring the next generation.
                    </p>
                </div>

                <!-- Impact 2 -->
                <div class="card bg-white p-8 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold text-primary mb-4">Community Development</h3>
                    <p class="text-gray-600">
                        Graduates are encouraged to contribute to local development projects, ensuring that the benefits of
                        education flow back to the community.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
@endsection
