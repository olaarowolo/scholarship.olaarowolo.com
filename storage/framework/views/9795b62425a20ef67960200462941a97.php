<?php $__env->startSection('content'); ?>
    <script src="https://cdn.tailwindcss.com"></script>

    <?php
        $user = Auth::user();
    ?>

    <?php echo $__env->make('components.navbar', ['user' => $user], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <style>
        /* Define the black and white theme based on the logo */
        :root {
            --primary: #000000;
            --secondary: #333333;
            --background: #f8f8f8;
            --text-dark: #1f2937;
            --text-light: #ffffff;
            --accent: #e5e7eb;
            /* Light gray for subtle accents/borders */
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

    <!-- Header Section -->
    <header class="hero-bg relative overflow-hidden pt-32 pb-20 sm:pt-40 lg:pt-48">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl lg:text-6xl animate-fade-in-down">
                Apply for the <span class="text-primary">Scholarship</span>
            </h1>
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto animate-fade-in-up animation-delay-200">
                Take the first step towards your educational dreams. Our application process is designed to be
                straightforward and accessible.
            </p>
        </div>
    </header>

    <!-- Application Status Section -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Application Status
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Current application window information
                </p>
            </div>

            <div
                class="card bg-gradient-to-r from-gray-50 to-gray-100 p-8 rounded-xl shadow-lg mb-12 hover:shadow-2xl transition-all duration-300 animate-scale-in animation-delay-200">
                <div class="text-center">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-primary text-white rounded-full mb-4 animate-pulse-slow">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Next Application Window</h3>
                    <p class="text-xl text-primary font-semibold mb-4">December 8, 2025 - January 16, 2026</p>
                    <p class="text-gray-600 mb-6">
                        Applications for the 2025/2026 academic year will open soon. Stay tuned for updates and prepare your
                        documents.
                    </p>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 animate-fade-in-up animation-delay-400">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Important:</strong> The applicant portal will be available during the
                                    application window. Early preparation is recommended.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coming Soon Notice -->
            <div
                class="card bg-gradient-to-r from-gray-50 to-gray-100 p-8 rounded-xl shadow-lg text-center hover:shadow-2xl transition-all duration-300 animate-scale-in animation-delay-400">
                <div class="mb-6">
                    <i class="fas fa-tools text-6xl text-gray-400 mb-4 animate-bounce-slow"></i>
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-4">Applicant Portal Coming Soon</h3>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        We're currently building a secure online application system. In the meantime, you can prepare your
                        documents and stay updated.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8 mb-12">
                    <div
                        class="text-left bg-white p-6 rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 animate-slide-in-left animation-delay-600">
                        <h4 class="font-semibold text-xl text-gray-900 mb-4">Required Documents:</h4>
                        <ul class="text-base text-gray-700 space-y-3 list-disc list-inside">
                            <li>WAEC/GCE Results</li>
                            <li>JAMB Result Slip</li>
                            <li>Birth Certificate</li>
                            <li>Proof of Indigene Status</li>
                            <li>Passport Photograph</li>
                        </ul>
                    </div>
                    <div
                        class="text-left bg-white p-6 rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 animate-slide-in-right animation-delay-600">
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

                <div class="flex flex-col sm:flex-row gap-6 justify-center animate-fade-in-up animation-delay-800">
                    <a href="<?php echo e(route('how-it-works')); ?>"
                        class="btn-primary text-lg font-bold px-8 py-3 rounded-full shadow-lg inline-flex items-center justify-center hover:scale-105 transition-all duration-300">
                        View Application Process
                    </a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('apply-form')); ?>"
                            class="bg-white text-primary border-2 border-primary hover:bg-gray-50 text-lg font-bold px-8 py-3 rounded-full shadow-lg inline-flex items-center justify-center hover:scale-105 transition-all duration-300">
                            Start Application
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>"
                            class="bg-white text-primary border-2 border-primary hover:bg-gray-50 text-lg font-bold px-8 py-3 rounded-full shadow-lg inline-flex items-center justify-center hover:scale-105 transition-all duration-300">
                            Start Application
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer/Contact Section -->
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/olasunkanmiarowolo/scholarship.olaarowolo.com/resources/views/apply.blade.php ENDPATH**/ ?>