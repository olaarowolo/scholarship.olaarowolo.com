<?php $__env->startSection('content'); ?>
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
                anchor.addEventListener('click', function(e) {
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
    <?php echo $__env->make('components.navbar', ['user' => Auth::user()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Error Message (for closed forms) -->
    <?php if(session('error')): ?>
        <div class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50 max-w-md w-full mx-4">
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg shadow-lg p-4 animate-pulse">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-semibold text-red-800">
                            <?php echo e(session('error')); ?>

                        </p>
                    </div>
                    <button onclick="this.parentElement.parentElement.parentElement.remove()"
                        class="ml-3 flex-shrink-0 text-red-500 hover:text-red-700">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <script>
            // Auto-hide error message after 5 seconds
            setTimeout(function() {
                const errorMsg = document.querySelector('.fixed.top-20');
                if (errorMsg) {
                    errorMsg.style.transition = 'opacity 0.5s';
                    errorMsg.style.opacity = '0';
                    setTimeout(() => errorMsg.remove(), 500);
                }
            }, 5000);
        </script>
    <?php endif; ?>

    <!-- 1. Hero Section -->
    <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <!-- 2. Mission Section -->
    <section id="mission" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">
                    Why We Exist
                </h2>
                <p class="mt-2 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                    Our Core Values and Commitment
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1: Focus on Locals -->
                <div
                    class="card bg-white p-8 rounded-xl shadow-lg border-t-4 border-primary hover:scale-105 transition-all duration-300 animate-fade-in-up animation-delay-200">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fa-solid fa-house-chimney text-3xl text-primary"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Community First</h3>
                    </div>
                    <p class="text-gray-600">
                        Dedicated solely to supporting indigenes of Iba town, Ojo, Lagos, ensuring that funds are reinvested
                        directly into the community's future leadership.
                    </p>
                </div>
                <!-- Value 2: Performance-based -->
                <div
                    class="card bg-white p-8 rounded-xl shadow-lg border-t-4 border-secondary hover:scale-105 transition-all duration-300 animate-fade-in-up animation-delay-400">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fa-solid fa-star text-3xl text-secondary"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Academic Excellence</h3>
                    </div>
                    <p class="text-gray-600">
                        Funding is tied to academic performance, encouraging scholars to maintain high standards (e.g.,
                        First Class honors receive full subsequent funding).
                    </p>
                </div>
                <!-- Value 3: Comprehensive Support -->
                <div
                    class="card bg-white p-8 rounded-xl shadow-lg border-t-4 border-primary hover:scale-105 transition-all duration-300 animate-fade-in-up animation-delay-600">
                    <div class="flex items-center space-x-4 mb-4">
                        <i class="fa-solid fa-handshake-angle text-3xl text-primary"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Beyond Finances</h3>
                    </div>
                    <p class="text-gray-600">
                        Beyond financial aid, we offer mentorship, career guidance, and a support network to help scholars
                        navigate university life and beyond.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Process Section -->
    <section id="process" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
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
                <div class="flex flex-col md:flex-row mb-12 items-center animate-slide-in-left animation-delay-200">
                    <div class="md:w-1/2 md:pr-10 text-center md:text-right">
                        <h3 class="text-2xl font-bold text-primary mb-1">Initial Screening</h3>
                        <p class="text-gray-600 text-sm md:text-base">Submit your online application, providing details of
                            your background, WAEC/GCE results, and JAMB score.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div
                            class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-white shadow-lg hover:scale-110 transition-transform duration-300">
                            1</div>
                    </div>
                    <div class="md:w-1/2 md:pl-10"></div>
                </div>

                <!-- Step 2 -->
                <div
                    class="flex flex-col md:flex-row mb-12 items-center md:flex-row-reverse animate-slide-in-right animation-delay-400">
                    <div class="md:w-1/2 md:pl-10 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-primary mb-1">Local Verification</h3>
                        <p class="text-gray-600 text-sm md:text-base">Successful candidates are contacted for physical
                            verification of residency and indigene status by local committees.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div
                            class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-gray-50 shadow-lg hover:scale-110 transition-transform duration-300">
                            2</div>
                    </div>
                    <div class="md:w-1/2 md:pr-10"></div>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row mb-12 items-center animate-slide-in-left animation-delay-600">
                    <div class="md:w-1/2 md:pr-10 text-center md:text-right">
                        <h3 class="text-2xl font-bold text-primary mb-1">Admission Confirmation</h3>
                        <p class="text-gray-600 text-sm md:text-base">Upon securing provisional admission, beneficiaries
                            submit confirmation documents to activate the funding cycle.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div
                            class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-white shadow-lg hover:scale-110 transition-transform duration-300">
                            3</div>
                    </div>
                    <div class="md:w-1/2 md:pl-10"></div>
                </div>

                <!-- Step 4 -->
                <div
                    class="flex flex-col md:flex-row items-center md:flex-row-reverse animate-slide-in-right animation-delay-800">
                    <div class="md:w-1/2 md:pl-10 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-primary mb-1">Performance Tracking</h3>
                        <p class="text-gray-600 text-sm md:text-base">Scholars submit semester results for review. Funds for
                            the next academic year are disbursed based on maintained CGPA.</p>
                    </div>
                    <div class="relative my-4 md:my-0">
                        <div
                            class="h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg ring-4 ring-gray-50 shadow-lg hover:scale-110 transition-transform duration-300">
                            4</div>
                    </div>
                    <div class="md:w-1/2 md:pr-10"></div>
                </div>
            </div>

            <div class="mt-16 text-center animate-fade-in-up animation-delay-1000">
                <a href="<?php echo e(route('apply')); ?>"
                    class="bg-primary text-white hover:bg-secondary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    Check Eligibility & Apply Now
                </a>
            </div>
        </div>
    </section>

    <!-- 4. Key Stats/Impact Section -->
    <section id="impact" class="py-24 bg-white border-t border-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-16 sm:text-4xl animate-fade-in-up">
                Impact Since Inception
            </h2>
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4 text-center">
                <!-- Stat 1 -->
                <div
                    class="p-4 sm:p-6 bg-gray-50 rounded-xl shadow-inner border border-accent hover:shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-200">
                    <p class="text-4xl sm:text-5xl font-extrabold text-primary">16+</p>
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">Beneficiaries Since 2022</p>
                </div>
                <!-- Stat 2 -->
                <div
                    class="p-4 sm:p-6 bg-gray-50 rounded-xl shadow-inner border border-accent hover:shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-400">
                    <p class="text-4xl sm:text-5xl font-extrabold text-primary">85%</p>
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">JAMB Aced (10+)</p>
                </div>
                <!-- Stat 3 -->
                <div
                    class="p-4 sm:p-6 bg-gray-50 rounded-xl shadow-inner border border-accent hover:shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-600">
                    <p class="text-4xl sm:text-5xl font-extrabold text-primary">100%</p>
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">Confirmed University Admission</p>
                </div>
                <!-- Stat 4 -->
                <div
                    class="p-4 sm:p-6 bg-gray-50 rounded-xl shadow-inner border border-accent hover:shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-800">
                    <p class="text-4xl sm:text-5xl font-extrabold text-primary">First Class</p>
                    <p class="mt-2 text-md sm:text-lg font-medium text-gray-600">Achieved by Top Scholar</p>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home1/httprapu/scholarship.olaarowolo.com/resources/views/home.blade.php ENDPATH**/ ?>