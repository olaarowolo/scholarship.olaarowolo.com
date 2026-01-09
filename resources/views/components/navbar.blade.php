<!-- ============================
     NAVBAR (MOBILE FIRST)
============================= -->
<nav class="navbar">
    <div class="nav-container">

        <!-- Logo -->
        <div class="nav-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                    alt="OA Foundation & Scholarship Logo">
            </a>
        </div>

        <!-- Modern Animated Hamburger -->
        <button class="nav-toggle" onclick="toggleMenu()">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </button>

        <!-- Desktop Links -->
        <div class="nav-links">
            <a href="{{ route('home') }}#mission">Our Mission</a>
            <a href="{{ route('home') }}#process">How to Apply</a>

            <!-- Impact Dropdown -->
            <div class="relative inline-block impact-dropdown">
                <button onclick="toggleImpactDropdown()"
                    class="text-gray-700 hover:text-black transition-colors duration-200 flex items-center space-x-1">
                    <span>Impact</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="impactDropdown"
                    class="hidden absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50">
                    <a href="{{ route('home') }}#impact"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        Our Impact
                    </a>
                    <a href="{{ route('testimonials') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        Testimonials
                    </a>
                </div>
            </div>

            <a href="{{ route('home') }}#contact">Contact</a>

            @if (isset($user) && $user->role === 'admin')
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-700 hover:text-black transition-colors duration-200">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="apply-btn">Sign Out</button>
                    </form>
                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span class="admin-badge ml-2">Administrator</span>
                    </div>
                </div>
            @elseif (isset($user))
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-700 hover:text-black transition-colors duration-200">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="apply-btn">Sign Out</button>
                    </form>
                    <div
                        class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>
            @else
                <a href="{{ route('apply') }}" class="get-started-link"><strong>Get Started</strong></a>
                <div class="relative inline-block">
                    <button onclick="toggleLoginDropdown()" class="apply-btn flex items-center space-x-2">
                        <span>Login</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="loginDropdown"
                        class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50">
                        <a href="{{ route('login') }}"
                            class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-black flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Login as Applicant</div>
                                    <div class="text-xs text-gray-500">Apply for scholarship</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('scholar-login') }}"
                            class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Login as Scholar</div>
                                    <div class="text-xs text-gray-500">Access scholar portal</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>

    </div>
</nav>

<!-- ============================
     MOBILE MENU
============================= -->
<!-- Mobile menu backdrop -->
<div id="mobile-menu-backdrop" class="mobile-menu-backdrop"></div>

<div id="mobile-menu" class="mobile-menu">
    <a href="{{ route('home') }}#mission" onclick="toggleMenu()">Our Mission</a>
    <a href="{{ route('home') }}#process" onclick="toggleMenu()">How to Apply</a>

    <!-- Mobile Impact Submenu -->
    <div>
        <button onclick="toggleMobileImpactDropdown()"
            class="w-full text-center font-medium text-gray-700 flex items-center justify-center py-2">
            <span>Impact</span>
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="mobileImpactDropdown" class="hidden space-y-2">
            <a href="{{ route('home') }}#impact" class="block py-2 text-gray-600 text-center"
                onclick="toggleMenu()">Our
                Impact</a>
            <a href="{{ route('testimonials') }}" class="block py-2 text-gray-600 text-center"
                onclick="toggleMenu()">Testimonials</a>
        </div>
    </div>

    <a href="{{ route('home') }}#contact" onclick="toggleMenu()">Contact</a>

    @if (isset($user) && $user->role === 'admin')
        <div class="px-4 py-3 border-t border-gray-200 mt-2">
            <a href="{{ route('dashboard') }}" class="mobile-apply mb-2 block text-center"
                onclick="toggleMenu()">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="mb-3">
                @csrf
                <button type="submit" class="mobile-apply">Sign Out</button>
            </form>
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center font-bold text-base">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                    <span class="mobile-admin-badge">Administrator</span>
                </div>
            </div>
        </div>
    @elseif (isset($user))
        <div class="px-4 py-3 border-t border-gray-200 mt-2">
            <a href="{{ route('dashboard') }}" class="mobile-apply mb-2 block text-center"
                onclick="toggleMenu()">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="mb-3">
                @csrf
                <button type="submit" class="mobile-apply">Sign Out</button>
            </form>
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center font-bold text-base">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
            </div>
        </div>
    @else
        <div class="px-4 py-3 border-t border-gray-200 mt-2">
            <a href="{{ route('apply') }}" class="mobile-get-started mb-3 block text-center"
                onclick="toggleMenu()"><strong>Get Started</strong></a>
            <button onclick="toggleMobileLoginDropdown()"
                class="mobile-apply mb-3 flex items-center justify-center w-full transition-all duration-200">
                <span>Login</span>
            </button>
            <div id="mobileLoginDropdown" class="hidden space-y-2.5 mt-2 text-center">
                <a href="{{ route('login') }}"
                    class="block px-3.5 py-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-md transition-all duration-200"
                    onclick="toggleMenu()">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-9 h-9 rounded-full bg-black flex items-center justify-center shadow-md">
                            <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-gray-900 text-sm">Login as Applicant</div>
                            <div class="text-xs text-gray-600 mt-0.5">Apply for scholarship</div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('scholar-login') }}"
                    class="block px-3.5 py-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-md transition-all duration-200"
                    onclick="toggleMenu()">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-9 h-9 rounded-full bg-gray-800 flex items-center justify-center shadow-md">
                            <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-gray-900 text-sm">Login as Scholar</div>
                            <div class="text-xs text-gray-600 mt-0.5">Access scholar portal</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endif
</div>


<!-- ============================
     CUSTOM CSS
============================= -->
<style>
    /* ============================
   MOBILE FIRST NAV STYLES
============================= */

    /* Floating nav container */
    .navbar {
        position: fixed;
        top: 16px;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        max-width: 1400px;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(229, 231, 235, 0.5);
        border-radius: 40px 40px 20px 20px;
        padding: 12px 20px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(255, 255, 255, 0.5) inset;
        z-index: 1000;
    }

    .nav-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Logo */
    .nav-logo a {
        display: flex;
        align-items: center;
        transition: opacity 0.2s ease;
    }

    .nav-logo a:hover {
        opacity: 0.8;
    }

    .nav-logo img {
        height: 52px;
        width: auto;
    }

    /* Hide desktop links on mobile */
    .nav-links {
        display: none;
    }

    /* ============================
   MODERN HAMBURGER ICON
============================= */
    .nav-toggle {
        width: 32px;
        height: 26px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
    }

    .nav-toggle .line {
        width: 100%;
        height: 3px;
        background: #222;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    /* Hamburger → X animation */
    .nav-toggle.active .line1 {
        transform: translateY(11px) rotate(45deg);
    }

    .nav-toggle.active .line2 {
        opacity: 0;
    }

    .nav-toggle.active .line3 {
        transform: translateY(-11px) rotate(-45deg);
    }

    /* ============================
   MOBILE SLIDE-UP MENU
============================= */
    /* Mobile menu backdrop */
    .mobile-menu-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(59, 130, 246, 0.15);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(1px);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        z-index: 998;
    }

    .mobile-menu-backdrop.active {
        opacity: 1;
        visibility: visible;
    }

    .mobile-menu {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 30px 20px;
        background: rgba(240, 245, 255, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 30px 30px 0 0;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.15);

        display: flex;
        flex-direction: column;
        gap: 20px;

        transform: translateY(100%);
        transition: transform 0.3s ease;
        z-index: 999;
        z-index: 999;
    }

    .mobile-menu a,
    .mobile-menu>div>button {
        text-decoration: none;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
        color: #444;
    }

    .mobile-apply {
        margin-top: 10px;
        padding: 12px 20px;
        background: linear-gradient(135deg, #000 0%, #2d2d2d 100%);
        color: #fff !important;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: block;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .mobile-get-started {
        margin-top: 10px;
        padding: 15px;
        color: #000 !important;
        font-size: 16px;
        font-weight: 800;
        text-decoration: none;
        text-align: center;
        letter-spacing: 0.5px;
        transition: color 0.2s ease;
    }

    .mobile-get-started:active {
        color: #10b981 !important;
    }

    .mobile-menu.active {
        transform: translateY(0);
    }

    /* ============================
   DESKTOP VIEW
============================= */
    @media (min-width: 768px) {

        /* Logo larger on desktop */
        .nav-logo img {
            height: 62px;
        }

        /* Hide toggle button */
        .nav-toggle {
            display: none;
        }

        /* Show desktop links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links a,
        .nav-links button {
            text-decoration: none;
            font-size: 13px;
            color: #555;
            font-weight: 500;
            transition: 0.2s;
        }

        .nav-links a:hover,
        .nav-links button:hover {
            color: #000;
        }

        .apply-btn {
            background: #000;
            color: #fff !important;
            padding: 8px 18px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            transition: 0.2s;
            border: none;
            cursor: pointer;
        }

        .apply-btn:hover {
            background: #333;
        }

        .get-started-link {
            text-decoration: none;
            font-size: 14px;
            color: #000;
            font-weight: 800;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }

        .get-started-link:hover {
            color: #10b981;
            transform: translateX(2px);
        }

        .admin-badge {
            padding: 8px 18px;
            background: #000;
            color: #fff;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
        }
    }

    .mobile-admin-badge {
        margin-top: 10px;
        padding: 15px;
        background: #000;
        color: #fff !important;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        text-align: center;
        display: block;
    }

    .mobile-apply button {
        width: 100%;
        background: none;
        border: none;
        font: inherit;
        color: inherit;
        cursor: pointer;
    }
</style>


<!-- ============================
     JAVASCRIPT
============================= -->
<script>
    function toggleMenu() {
        const menu = document.getElementById("mobile-menu");
        const backdrop = document.getElementById("mobile-menu-backdrop");
        const toggle = document.querySelector(".nav-toggle");

        // open/close mobile menu
        menu.classList.toggle("active");
        backdrop.classList.toggle("active");

        // animate hamburger -> X
        toggle.classList.toggle("active");
    }

    // Toggle desktop login dropdown
    function toggleLoginDropdown() {
        const dropdown = document.getElementById("loginDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Toggle desktop impact dropdown
    function toggleImpactDropdown() {
        const dropdown = document.getElementById("impactDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Toggle mobile login dropdown
    function toggleMobileLoginDropdown() {
        const dropdown = document.getElementById("mobileLoginDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Toggle mobile impact dropdown
    function toggleMobileImpactDropdown() {
        const dropdown = document.getElementById("mobileImpactDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Close mobile menu when clicking backdrop
    document.addEventListener('DOMContentLoaded', function() {
        const backdrop = document.getElementById("mobile-menu-backdrop");
        if (backdrop) {
            backdrop.addEventListener('click', toggleMenu);
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const loginDropdown = document.getElementById("loginDropdown");
        const mobileLoginDropdown = document.getElementById("mobileLoginDropdown");
        const impactDropdown = document.getElementById("impactDropdown");

        // Check if click is outside the dropdown
        if (loginDropdown && !event.target.closest('.relative.inline-block')) {
            loginDropdown.classList.add("hidden");
        }

        // Close impact dropdown when clicking outside
        if (impactDropdown && !event.target.closest('.impact-dropdown')) {
            impactDropdown.classList.add("hidden");
        }
    });

    // Smooth scroll handling for anchor links (only on same page)
    document.addEventListener('DOMContentLoaded', function() {
        // Get all anchor links in navbar
        const navLinks = document.querySelectorAll('.navbar a[href*="#"], .mobile-menu a[href*="#"]');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                const url = new URL(href, window.location.origin);

                // Check if the link is to the current page (only hash changes)
                if (url.pathname === window.location.pathname && url.hash) {
                    const targetId = url.hash.substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        e.preventDefault();
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                        // Close mobile menu if open
                        const menu = document.getElementById('mobile-menu');
                        const toggle = document.querySelector(".nav-toggle");
                        if (menu && menu.classList.contains('active')) {
                            menu.classList.remove('active');
                            if (toggle) toggle.classList.remove('active');
                        }

                        // Update URL without page reload
                        history.pushState(null, null, href);
                    }
                }
                // Otherwise, let the browser handle the navigation normally
            });
        });
    });
</script>
