<?php $__env->startSection('content'); ?>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        /* Define custom styles for the monochromatic theme */
        :root {
            --color-primary: #000000;
            --color-secondary: #333333;
            --color-accent: #F59E0B;
            /* Gold */
        }

        .bg-brand-secondary {
            background-color: var(--color-secondary);
        }

        .text-brand-primary {
            color: var(--color-primary);
        }

        .border-brand-primary {
            border-color: var(--color-primary);
        }

        .text-accent-gold {
            color: var(--color-accent);
        }
    </style>

    <!-- Navigation Bar -->
    <?php echo $__env->make('components.navbar', ['user' => Auth::user()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Header Section -->
    <header class="py-20 sm:py-24 text-white shadow-2xl bg-brand-secondary mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="uppercase tracking-widest text-sm font-semibold mb-3 text-accent-gold">
                Impact in Numbers
            </p>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight">
                Hear From Our Scholars
            </h1>
            <p class="mt-4 text-xl font-light opacity-80 max-w-3xl mx-auto">
                Real stories of transformation and success made possible through the Ola Arowolo Foundation.
            </p>
        </div>
    </header>

    <!-- Testimonials Grid and Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <!-- Statistics Bar -->
        <div
            class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12 text-center bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="p-3 border-r md:border-r-0 lg:border-r border-gray-200">
                <p class="text-3xl font-extrabold text-brand-primary">25+</p>
                <p class="text-sm text-gray-500">UTME Beneficiaries</p>
            </div>
            <div class="p-3 border-r md:border-r-0 lg:border-r border-gray-200">
                <p class="text-3xl font-extrabold text-brand-primary">3+</p>
                <p class="text-sm text-gray-500">Scholarships Awarded</p>
            </div>
            
            <div class="p-3 border-r md:border-r-0 border-gray-200">
                <p class="text-3xl font-extrabold text-brand-primary">2</p>
                <p class="text-sm text-gray-500">Universities Covered</p>
            </div>
            <div class="p-3">
                <p class="text-3xl font-extrabold text-brand-primary">0</p>
                <p class="text-sm text-gray-500">Graduates</p>
            </div>
        </div>

        <!-- Testimonials Container (JS will populate this) -->
        <div id="testimonials-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
            <!-- Loading Indicator -->
            <div id="loading-indicator" class="col-span-full flex justify-center items-center h-64">
                <svg class="animate-spin h-8 w-8 text-brand-primary" style="color: var(--color-primary);"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <p class="ml-3 text-lg text-gray-600">Loading inspiring stories...</p>
            </div>
        </div>

        <!-- Call to Action Footer -->
        <div class="mt-16 text-center">
            <h2 class="text-3xl font-extrabold text-brand-primary">Ready to Start Your Journey?</h2>
            <p class="text-lg text-gray-600 mt-3 mb-6">
                Join the hundreds of students who have benefited from our scholarship programs.
            </p>
            <a href="/apply"
                class="inline-flex items-center text-brand-primary px-8 py-3 rounded-full font-bold text-lg shadow-lg hover:bg-yellow-400 transition duration-300"
                style="background-color: var(--color-accent); color: var(--color-secondary);">
                Apply for Scholarship Today
                <!-- Lucide ArrowRight Icon -->
                <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-gray-600 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            &copy; 2024 Ola Arowolo Foundation | Empowering Education.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('testimonials-container');
            const loadingIndicator = document.getElementById('loading-indicator');

            // Define color variables and constants
            const BRAND_PRIMARY = '#000000';
            const ACCENT_GOLD = '#F59E0B';

            // --- Mock Data ---
            const MOCK_TESTIMONIALS = [{
                    id: 1,
                    quote: "The Ola Arowolo Foundation scholarship was a game-changer. It lifted the financial burden completely, allowing me to focus on my medicine degree without distraction. Their support goes beyond money; they truly mentor you.",
                    name: "Dr. Kemi Adebayo",
                    role: "Medical Doctor, Beneficiary 2018",
                    status: "Graduated",
                    icon: "https://placehold.co/40x40/000000/FFFFFF?text=KA",
                    colorClass: 'bg-green-600'
                },
                {
                    id: 2,
                    quote: "Securing the free UTME form meant I could actually take the first step towards my university dream. I passed with a score of 305 and am now pursuing Computer Science. Thank you for believing in my potential.",
                    name: "Tunde Olanrewaju",
                    role: "Computer Science Student, Beneficiary 2023",
                    status: "Active Student",
                    icon: "https://placehold.co/40x40/333333/FFFFFF?text=TO",
                    colorClass: 'bg-amber-600'
                },
                {
                    id: 3,
                    quote: "When I thought I had to defer my admission, the foundation stepped in. I wouldn't be studying Electrical Engineering today without their intervention. Their commitment to education is unparalleled.",
                    name: "Ngozi Okafor",
                    role: "Electrical Engineer, Beneficiary 2020",
                    status: "Graduated",
                    icon: "https://placehold.co/40x40/000000/FFFFFF?text=NO",
                    colorClass: 'bg-gray-700'
                },
                {
                    id: 4,
                    quote: "The mentorship program was as valuable as the financial aid. Learning from successful professionals helped me navigate my early career decisions. Highly recommend applying!",
                    name: "Chiamaka Eze",
                    role: "Business Analyst, Beneficiary 2019",
                    status: "Working Professional",
                    icon: "https://placehold.co/40x40/333333/FFFFFF?text=CE",
                    colorClass: 'bg-blue-600'
                },
            ];

            // Function to generate the HTML for a single testimonial card
            function createTestimonialCard(testimonial) {
                // Star rating SVG (5 stars, gold color)
                const starsHtml = Array(5).fill(0).map(() => `
                    <i data-lucide="star" class="w-5 h-5 fill-current" style="color: ${ACCENT_GOLD}"></i>
                `).join('');

                return `
                    <div class="bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:scale-[1.02] flex flex-col justify-between h-full"
                         style="border-top: 8px solid ${BRAND_PRIMARY};">
                        <div class="flex-grow">
                            <!-- Star Rating -->
                            <div class="flex space-x-0.5 mb-4 text-accent-gold">
                                ${starsHtml}
                            </div>

                            <!-- Quote -->
                            <blockquote class="text-lg italic font-medium text-gray-700 leading-relaxed border-l-4 border-gray-200 pl-4 mb-6">
                                ${testimonial.quote}
                            </blockquote>
                        </div>

                        <!-- Author Info -->
                        <div class="flex items-center pt-4 border-t border-gray-100">
                            <img
                                class="h-12 w-12 rounded-full object-cover mr-4 shadow-md"
                                src="${testimonial.icon}"
                                alt="${testimonial.name}"
                            />
                            <div>
                                <p class="font-bold text-lg" style="color: ${BRAND_PRIMARY};">${testimonial.name}</p>
                                <p class="text-sm text-gray-500">${testimonial.role}</p>
                                <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full text-white ${testimonial.colorClass}">
                                    ${testimonial.status}
                                </span>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Function to render all testimonials
            function renderTestimonials() {
                // Hide loading indicator
                loadingIndicator.style.display = 'none';

                // Insert all generated cards into the container
                container.innerHTML = MOCK_TESTIMONIALS.map(createTestimonialCard).join('');

                // Manually replace Lucide icon placeholders with SVGs
                lucide.createIcons();
            }

            // Simulate loading delay before rendering
            setTimeout(renderTestimonials, 1000);
        });
    </script>

    <!-- Footer -->
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/olasunkanmiarowolo/scholarship.olaarowolo.com/resources/views/testimonials.blade.php ENDPATH**/ ?>