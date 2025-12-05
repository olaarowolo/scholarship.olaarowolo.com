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

        <!-- Mobile Toggle -->
        <button class="nav-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
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

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu">
    <a href="#mission" onclick="toggleMenu()">Our Mission</a>
    <a href="#process" onclick="toggleMenu()">How to Apply</a>
    <a href="#impact" onclick="toggleMenu()">Impact</a>
    <a href="#contact" onclick="toggleMenu()">Contact</a>

    <a href="{{ route('apply') }}" class="mobile-apply">Apply Now</a>
</div>


<style>
/* ============================
   MOBILE FIRST NAV STYLES
============================ */

/* Floating container */
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

/* MOBILE: hide desktop links */
.nav-links {
    display: none;
}

/* Hamburger button */
.nav-toggle {
    display: flex;
    flex-direction: column;
    gap: 4px;
    background: none;
    border: none;
    cursor: pointer;
}

.nav-toggle span {
    width: 26px;
    height: 3px;
    background: #444;
    border-radius: 3px;
}

/* Mobile slide-up menu */
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

/* Active mobile menu */
.mobile-menu.active {
    transform: translateY(0);
}

/* ============================
   DESKTOP VIEW
============================ */

@media (min-width: 768px) {

    /* Hide toggle */
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
        transition: 0.2s ease;
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
        transition: 0.2s ease;
    }

    .apply-btn:hover {
        background: #333;
    }
}
</style>



<script>
function toggleMenu() {
    document.getElementById("mobile-menu").classList.toggle("active");
}
</script>
