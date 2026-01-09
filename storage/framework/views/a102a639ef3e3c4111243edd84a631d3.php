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
    <?php echo $__env->make('components.navbar', ['user' => Auth::user()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Header Section -->
    <header class="hero-bg relative overflow-hidden pt-32 pb-20 sm:pt-40 lg:pt-48">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl lg:text-6xl animate-fade-in-down">
                How It <span class="text-primary">Works</span>
            </h1>
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto animate-fade-in-up animation-delay-200">
                Your step-by-step guide to applying for the OA Local Scholarship and securing your path to higher education.
            </p>
        </div>
    </header>

    <!-- Application Process Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">
                    The Application Journey
                </h2>
                <p class="mt-2 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                    4-Step Application Flow
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
                        <div class="mt-4 text-sm text-gray-500">
                            <strong>Requirements:</strong> Valid contact info, academic records, indigene verification
                        </div>
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
                        <h3 class="text-2xl font-bold text-primary mb-1"> Local Verification</h3>
                        <p class="text-gray-600 text-sm md:text-base">Successful candidates are contacted for physical
                            verification of residency and indigene status by local committees.</p>
                        <div class="mt-4 text-sm text-gray-500">
                            <strong>Process:</strong> Community verification, document review, eligibility confirmation
                        </div>
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
                        <div class="mt-4 text-sm text-gray-500">
                            <strong>Documents:</strong> Admission letter, fee schedule, acceptance proof
                        </div>
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
                        <div class="mt-4 text-sm text-gray-500">
                            <strong>Funding:</strong> Performance-based disbursement, annual reviews, continued support
                        </div>
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
                    class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center hover:scale-105 transition-all duration-300">
                    Check Eligibility & Apply Now
                </a>
            </div>
        </div>
    </section>

    <!-- Eligibility Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Eligibility Criteria
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Who can apply for the OA Local Scholarship?
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Criterion 1 -->
                <div
                    class="card bg-white p-6 rounded-xl shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-200">
                    <div class="flex items-center mb-4">
                        <i class="fa-solid fa-house-chimney text-2xl text-primary mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">Indigene Status</h3>
                    </div>
                    <p class="text-gray-600">
                        Must be an indigene of Iba town, Ojo Local Government Area, Lagos State, Nigeria.
                    </p>
                </div>

                <!-- Criterion 2 -->
                <div
                    class="card bg-white p-6 rounded-xl shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-300">
                    <div class="flex items-center mb-4">
                        <i class="fa-solid fa-graduation-cap text-2xl text-primary mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">Academic Excellence</h3>
                    </div>
                    <p class="text-gray-600">
                        Strong WAEC/GCE results and competitive JAMB score (preferably 250+).
                    </p>
                </div>

                <!-- Criterion 3 -->
                <div
                    class="card bg-white p-6 rounded-xl shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-400">
                    <div class="flex items-center mb-4">
                        <i class="fa-solid fa-university text-2xl text-primary mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">University Admission</h3>
                    </div>
                    <p class="text-gray-600">
                        Provisional admission to a recognized Nigerian university.
                    </p>
                </div>

                <!-- Criterion 4 -->
                <div
                    class="card bg-white p-6 rounded-xl shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-500">
                    <div class="flex items-center mb-4">
                        <i class="fa-solid fa-hand-holding-heart text-2xl text-primary mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">Financial Need</h3>
                    </div>
                    <p class="text-gray-600">
                        Demonstrated financial need and commitment to community development.
                    </p>
                </div>

                <!-- Criterion 5 -->
                <div
                    class="card bg-white p-6 rounded-xl shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-600">
                    <div class="flex items-center mb-4">
                        <i class="fa-solid fa-users text-2xl text-primary mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">Community Involvement</h3>
                    </div>
                    <p class="text-gray-600">
                        Active participation in community activities and leadership potential.
                    </p>
                </div>

                <!-- Criterion 6 -->
                <div
                    class="card bg-white p-6 rounded-xl shadow-lg hover:scale-105 transition-all duration-300 animate-scale-in animation-delay-700">
                    <div class="flex items-center mb-4">
                        <i class="fa-solid fa-file-contract text-2xl text-primary mr-3"></i>
                        <h3 class="text-xl font-bold text-gray-900">Agreement</h3>
                    </div>
                    <p class="text-gray-600">
                        Willingness to abide by scholarship terms and performance requirements.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Frequently Asked Questions
                </h2>
            </div>

            <div class="space-y-6">
                <div
                    class="card bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-all duration-300 animate-fade-in-up animation-delay-200">
                    <h3 class="text-lg font-semibold text-primary mb-2">When is the application window open?</h3>
                    <p class="text-gray-600">Applications are typically open once a year. Check our homepage for current
                        application windows.</p>
                </div>

                <div
                    class="card bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-all duration-300 animate-fade-in-up animation-delay-400">
                    <h3 class="text-lg font-semibold text-primary mb-2">What documents do I need to apply?</h3>
                    <p class="text-gray-600">You'll need your WAEC/GCE results, JAMB result slip, birth certificate, proof
                        of indigene status, and passport photograph.</p>
                </div>

                <div
                    class="card bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-all duration-300 animate-fade-in-up animation-delay-600">
                    <h3 class="text-lg font-semibold text-primary mb-2">How much funding can I receive?</h3>
                    <p class="text-gray-600">Funding is performance-based, up to ₦100,000 per academic year, with potential
                        rollover for excellent performance.</p>
                </div>

                <div
                    class="card bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-all duration-300 animate-fade-in-up animation-delay-800">
                    <h3 class="text-lg font-semibold text-primary mb-2">Can I apply if I'm already in university?</h3>
                    <p class="text-gray-600">The scholarship is primarily for new admissions, but exceptional cases may be
                        considered. Contact us for details.</p>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/how-it-works.blade.php ENDPATH**/ ?>