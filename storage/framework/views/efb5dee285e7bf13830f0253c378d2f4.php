<?php $__env->startSection('content'); ?>
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
    <?php echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <!-- Hero Section -->
    <header class="hero-bg relative overflow-hidden pt-20 pb-28 sm:pt-28 lg:pt-36">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl tracking-tight font-extrabold text-gray-900 sm:text-6xl lg:text-7xl">
                    Sponsor <span class="text-primary">Information</span>
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                    Learn how you can support the OA Foundation & Scholarship and make a difference in Iba Town's future.
                </p>
            </div>
        </div>
    </header>

    <!-- Sponsorship Information -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg mx-auto">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Become a Sponsor</h2>
                <p class="text-gray-600 mb-6">
                    The OA Foundation & Scholarship relies on generous sponsors to provide financial support to deserving
                    students from Iba Town. Your contribution directly impacts the lives of young people pursuing higher
                    education.
                </p>

                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Sponsorship Levels</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div class="card bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-bold text-primary mb-4">Bronze Sponsor</h3>
                        <p class="text-2xl font-extrabold text-gray-900 mb-2">₦50,000</p>
                        <p class="text-gray-600">Supports one semester of education for a scholar.</p>
                    </div>
                    <div class="card bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-bold text-primary mb-4">Silver Sponsor</h3>
                        <p class="text-2xl font-extrabold text-gray-900 mb-2">₦100,000</p>
                        <p class="text-gray-600">Supports one full academic year for a scholar.</p>
                    </div>
                    <div class="card bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-bold text-primary mb-4">Gold Sponsor</h3>
                        <p class="text-2xl font-extrabold text-gray-900 mb-2">₦200,000+</p>
                        <p class="text-gray-600">Supports multiple scholars or special initiatives.</p>
                    </div>
                </div>

                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">How Your Donation Helps</h2>
                <ul class="text-gray-600 mb-6 list-disc list-inside">
                    <li>Covers tuition fees for university education</li>
                    <li>Provides textbooks and study materials</li>
                    <li>Supports accommodation and living expenses</li>
                    <li>Funds mentorship and career development programs</li>
                    <li>Enables community outreach and educational initiatives</li>
                </ul>

                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Recognition and Impact</h2>
                <p class="text-gray-600 mb-6">
                    As a sponsor, you'll receive recognition on our website and annual impact reports. More importantly,
                    you'll be part of a legacy of educational empowerment that transforms lives and strengthens communities.
                </p>

                <div class="text-center mt-12">
                    <a href="mailto:scholarship@olaarowolo.com"
                        class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center">
                        Contact Us to Sponsor
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <!-- Contact Info -->
                <div class="space-y-4 xl:col-span-1">
                    <img class="h-10 w-auto mb-4" src="<?php echo e(asset('assets/img/favicon/olaarowolo.com_logo_black.png')); ?>"
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
                                <li><a href="<?php echo e(route('our-story')); ?>" class="text-base text-gray-300 hover:text-white">Our
                                        Story</a></li>
                                <li><a href="<?php echo e(route('application-steps')); ?>"
                                        class="text-base text-gray-300 hover:text-white">Application Steps</a></li>
                                <li><a href="<?php echo e(route('view-impact')); ?>"
                                        class="text-base text-gray-300 hover:text-white">View Impact</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Portal & Legal
                            </h3>
                            <ul role="list" class="mt-4 space-y-3">
                                <li><a href="<?php echo e(route('scholar-login')); ?>"
                                        class="text-base text-gray-300 hover:text-white">Scholar Login</a></li>
                                

                                <li><a href="<?php echo e(route('terms')); ?>" class="text-base text-gray-300 hover:text-white">Terms &
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/sponsor-information.blade.php ENDPATH**/ ?>