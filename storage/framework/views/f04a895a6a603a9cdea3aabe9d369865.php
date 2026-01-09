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

        /* Form styling */
        .form-input {
            border: 1px solid var(--accent);
            border-radius: 0.5rem;
            padding: 0.75rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: block;
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
                Contact <span class="text-primary">Us</span>
            </h1>
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto animate-fade-in-up animation-delay-200">
                Have questions about the scholarship? We're here to help. Send us your inquiries and we'll get back to you
                promptly.
            </p>
        </div>
    </header>

    <!-- Contact Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div class="animate-slide-in-left animation-delay-200">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Get in Touch</h2>

                    <div class="space-y-8">
                        <!-- Email -->
                        <div class="flex items-start space-x-4 hover:scale-105 transition-all duration-300">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center animate-pulse-slow">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Email Us</h3>
                                <p class="text-gray-600 mt-1">Send us your questions and we'll respond within 24 hours.</p>
                                <a href="mailto:scholarship@olaarowolo.com"
                                    class="text-primary hover:text-secondary font-medium mt-2 inline-block">
                                    scholarship@olaarowolo.com
                                </a>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start space-x-4 hover:scale-105 transition-all duration-300">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center animate-pulse-slow">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Location</h3>
                                <p class="text-gray-600 mt-1">Find us in the heart of Iba community.</p>
                                <p class="text-gray-900 font-medium mt-2">
                                    Iba, Lagos State, Nigeria
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div
                    class="bg-gray-50 rounded-lg p-8 shadow-sm hover:shadow-lg transition-shadow duration-300 animate-slide-in-right animation-delay-400">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Send us a Message</h2>

                    <?php if(session('success')): ?>
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded animate-scale-in">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('contact.send')); ?>" method="POST" class="space-y-6">
                        <?php echo csrf_field(); ?>

                        <div>
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" id="name" name="name" required
                                class="form-input w-full <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('name')); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" id="email" name="email" required
                                class="form-input w-full <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('email')); ?>">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="message" class="form-label">Your Message</label>
                            <textarea id="message" name="message" rows="6" required
                                class="form-input w-full <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <button type="submit"
                                class="btn-primary w-full py-3 px-6 rounded-lg text-base font-semibold hover:scale-105 transition-all duration-300">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; 2025 Ola Arowolo Scholarship. All rights reserved.</p>
            </div>
        </div>
    </footer>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/olasunkanmiarowolo/scholarship.olaarowolo.com/resources/views/contact.blade.php ENDPATH**/ ?>