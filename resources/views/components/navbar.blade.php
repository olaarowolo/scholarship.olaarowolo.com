<!-- Navigation Bar (Island Floating Design) -->
<nav
    class="fixed top-4 left-1/2 transform -translate-x-1/2 w-4/5 bg-white/80 backdrop-blur-md shadow-2xl rounded-full px-6 py-3 z-50 border border-accent">
    <div class="flex justify-between items-center h-10">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
            <img class="h-12 w-auto" src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                alt="OA Scholarship Logo">
        </div>

        <!-- Desktop Links -->
        <div class="hidden sm:ml-6 sm:flex sm:space-x-6 items-center">
            <a href="#mission"
                class="text-gray-600 hover:text-primary px-2 py-1 text-sm font-medium transition duration-200">Our
                Mission</a>
            <a href="#process"
                class="text-gray-600 hover:text-primary px-2 py-1 text-sm font-medium transition duration-200">How to
                Apply</a>
            <a href="#impact"
                class="text-gray-600 hover:text-primary px-2 py-1 text-sm font-medium transition duration-200">Impact</a>
            <a href="#contact"
                class="text-gray-600 hover:text-primary px-2 py-1 text-sm font-medium transition duration-200">Contact</a>
            <!-- CTA Button -->
            <a href="{{ route('apply') }}"
                class="bg-primary text-white hover:bg-secondary text-xs font-semibold px-4 py-1.5 rounded-full ml-2 transition duration-200">
                Apply Now
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="flex items-center sm:hidden">
            <button type="button"
                class="inline-flex items-center justify-center p-1.5 rounded-md text-gray-700 hover:text-primary hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary"
                aria-expanded="false" onclick="toggleMenu()">
                <span class="sr-only">Open main menu</span>
                <svg class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu (Island Design - Floating from bottom) -->
<div class="fixed bottom-0 left-0 w-full bg-white/80 backdrop-blur-md shadow-2xl rounded-t-3xl p-6 translate-y-full transition-transform duration-300 ease-out z-50"
    id="mobile-menu">
    <div class="flex flex-col space-y-4">
        <a href="#mission"
            class="text-gray-600 hover:text-primary py-3 text-center text-lg font-medium transition duration-200"
            onclick="toggleMenu()">Our Mission</a>
        <a href="#process"
            class="text-gray-600 hover:text-primary py-3 text-center text-lg font-medium transition duration-200"
            onclick="toggleMenu()">How to Apply</a>
        <a href="#impact"
            class="text-gray-600 hover:text-primary py-3 text-center text-lg font-medium transition duration-200"
            onclick="toggleMenu()">Impact</a>
        <a href="#contact"
            class="text-gray-600 hover:text-primary py-3 text-center text-lg font-medium transition duration-200"
            onclick="toggleMenu()">Contact</a>
        <a href="{{ route('apply') }}"
            class="bg-primary text-white hover:bg-secondary text-center mt-6 px-6 py-3 rounded-full text-lg font-semibold shadow-lg transition duration-200">Apply
            Now</a>
    </div>
</div>

<!-- Greyed-out Apply Buttons -->
<style>
    .btn-disabled {
        background-color: #d1d5db;
        /* Gray */
        color: #9ca3af;
        /* Darker Gray */
        cursor: not-allowed;
        pointer-events: none;
    }
</style>

<script>
    // Function to toggle mobile menu visibility
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        if (menu) {
            menu.classList.toggle('translate-y-full');
        }
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('mobile-menu');
        const menuButton = event.target.closest('[onclick="toggleMenu()"]');
        
        if (menu && !menu.contains(event.target) && !menuButton) {
            if (!menu.classList.contains('translate-y-full')) {
                menu.classList.add('translate-y-full');
            }
        }
    });

    // Function for smooth scrolling on hash links
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Close mobile menu after clicking a link
                    const menu = document.getElementById('mobile-menu');
                    if (menu && !menu.classList.contains('translate-y-full')) {
                        menu.classList.add('translate-y-full');
                    }
                }
            });
        });
    });
</script>
