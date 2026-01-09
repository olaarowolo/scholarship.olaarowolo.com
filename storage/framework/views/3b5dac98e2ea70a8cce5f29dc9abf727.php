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
                    Our <span class="text-primary">Story</span>
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                    The journey of OA Foundation & Scholarship and our commitment to empowering Iba Town's brightest minds.
                </p>
            </div>
        </div>
    </header>

    <!-- Story Content -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg mx-auto">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">The Beginning</h2>
                <p class="text-gray-600 mb-6">
                    Founded in 2022 by OA, a dedicated educator and community leader, the OA Foundation & Scholarship was
                    born from a simple yet powerful vision: to ensure that no talented young person from Iba Town, Ojo,
                    Lagos, is denied access to quality higher education due to financial constraints.
                </p>

                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Our Mission</h2>
                <p class="text-gray-600 mb-6">
                    We are committed to providing financial support, mentorship, and resources to indigenes of Iba Town
                    pursuing university education. Our program focuses on academic excellence, community reinvestment, and
                    long-term leadership development.
                </p>

                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Impact and Growth</h2>
                <p class="text-gray-600 mb-6">
                    Since our inception, we have supported over 16 beneficiaries, with 100% securing university admission
                    and achieving remarkable academic success. Our scholars have excelled in various fields, from
                    engineering to medicine, embodying the potential of Iba Town's youth.
                </p>

                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Looking Forward</h2>
                <p class="text-gray-600 mb-6">
                    As we continue to grow, our commitment remains unwavering: to create opportunities, foster excellence,
                    and build a brighter future for Iba Town through education and empowerment.
                </p>
            </div>
        </div>
    </section>



    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/olasunkanmiarowolo/scholarship.olaarowolo.com/resources/views/our-story.blade.php ENDPATH**/ ?>