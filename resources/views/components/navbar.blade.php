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
            <a href="#mission">Our Mission</a>
            <a href="#process">How to Apply</a>
            <a href="#impact">Impact</a>
            <a href="#contact">Contact</a>

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
<div id="mobile-menu" class="mobile-menu">
    <a href="#mission" onclick="toggleMenu()">Our Mission</a>
    <a href="#process" onclick="toggleMenu()">How to Apply</a>
    <a href="#impact" onclick="toggleMenu()">Impact</a>
    <a href="#contact" onclick="toggleMenu()">Contact</a>

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
            <a href="{{ route('apply') }}" class="mobile-get-started mb-2 block text-center"
                onclick="toggleMenu()"><strong>Get Started</strong></a>
            <button onclick="toggleMobileLoginDropdown()"
                class="mobile-apply mb-2 flex items-center justify-center w-full">
                <span>Login</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="mobileLoginDropdown" class="hidden space-y-2">
                <a href="{{ route('login') }}" class="block px-4 py-3 bg-gray-50 rounded-lg" onclick="toggleMenu()">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-black flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Login as Applicant</div>
                            <div class="text-xs text-gray-500">Apply for scholarship</div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('scholar-login') }}" class="block px-4 py-3 bg-gray-50 rounded-lg"
                    onclick="toggleMenu()">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Login as Scholar</div>
                            <div class="text-xs text-gray-500">Access scholar portal</div>
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
        background: rgba(255, 255, 255, 0.90);
        backdrop-filter: blur(12px);
        border: 1px solid #e5e7eb;
        border-radius: 40px;
        padding: 12px 20px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.12);
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
    .mobile-menu {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 30px 20px;
        background: rgba(255, 255, 255, 0.90);
        backdrop-filter: blur(12px);
        border-radius: 30px 30px 0 0;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.12);

        display: flex;
        flex-direction: column;
        gap: 20px;

        transform: translateY(100%);
        transition: transform 0.3s ease;
        z-index: 999;
    }

    .mobile-menu a {
        text-decoration: none;
        text-align: center;
        font-size: 18px;
        font-weight: 500;
        color: #444;
    }

    .mobile-apply {
        margin-top: 10px;
        padding: 15px;
        background: #000;
        color: #fff !important;
        border-radius: 50px;
        font-size: 17px;
        font-weight: 600;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .mobile-get-started {
        margin-top: 10px;
        padding: 15px;
        color: #000 !important;
        font-size: 19px;
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

        .nav-links a {
            text-decoration: none;
            font-size: 15px;
            color: #555;
            font-weight: 500;
            transition: 0.2s;
        }

        .nav-links a:hover {
            color: #000;
        }

        .apply-btn {
            background: #000;
            color: #fff !important;
            padding: 8px 18px;
            border-radius: 40px;
            font-size: 13px;
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
            font-size: 16px;
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
            font-size: 13px;
            font-weight: 600;
        }
    }

    .mobile-admin-badge {
        margin-top: 10px;
        padding: 15px;
        background: #000;
        color: #fff !important;
        border-radius: 50px;
        font-size: 17px;
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
        const toggle = document.querySelector(".nav-toggle");

        // open/close mobile menu
        menu.classList.toggle("active");

        // animate hamburger -> X
        toggle.classList.toggle("active");
    }

    // Toggle desktop login dropdown
    function toggleLoginDropdown() {
        const dropdown = document.getElementById("loginDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Toggle mobile login dropdown
    function toggleMobileLoginDropdown() {
        const dropdown = document.getElementById("mobileLoginDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const loginDropdown = document.getElementById("loginDropdown");
        const mobileLoginDropdown = document.getElementById("mobileLoginDropdown");

        // Check if click is outside the dropdown
        if (loginDropdown && !event.target.closest('.relative.inline-block')) {
            loginDropdown.classList.add("hidden");
        }
    });
</script>
