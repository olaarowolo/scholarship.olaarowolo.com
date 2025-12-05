<!-- ============================
     NAVBAR (MOBILE FIRST)
============================= -->
<nav class="navbar">
    <div class="nav-container">

        <!-- Logo -->
        <div class="nav-logo">
            <img src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                 alt="OA Scholarship Logo">
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

            <a href="{{ route('apply') }}" class="apply-btn">Apply Now</a>
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

    <a href="{{ route('apply') }}" class="mobile-apply">Apply Now</a>
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
    box-shadow: 0 10px 35px rgba(0,0,0,0.12);
    z-index: 1000;
}

.nav-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Logo */
.nav-logo img {
    height: 42px;
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
    box-shadow: 0 -10px 30px rgba(0,0,0,0.12);

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
}

.mobile-menu.active {
    transform: translateY(0);
}

/* ============================
   DESKTOP VIEW
============================= */
@media (min-width: 768px) {

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
    }

    .apply-btn:hover {
        background: #333;
    }
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
</script>
