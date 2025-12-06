<!-- 1. Hero Section -->
<header class="hero-bg relative overflow-hidden pt-24 pb-28 sm:pt-32 lg:pt-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-7 lg:text-left">
                <div class="text-sm font-semibold uppercase tracking-widest text-primary">
                    Empowering Local Excellence
                </div>
                <h1
                    class="mt-4 text-5xl tracking-tight font-extrabold text-gray-900 sm:text-6xl lg:text-5xl xl:text-7xl">
                    The <span class="text-primary block lg:inline">Scholarship</span> for Iba Town's Brightest
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-xl mx-auto lg:mx-0">
                    Providing financial and mentorship support to emerging leaders to access and excel in quality
                    university education.
                </p>

                <!-- Countdown Timer -->
                <div class="mt-8 max-w-xl mx-auto lg:mx-0">
                    <div
                        class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-2xl p-6 backdrop-blur-sm border border-primary/20">
                        <p id="countdown-label"
                            class="text-sm font-semibold text-gray-700 text-center lg:text-left mb-3">
                            🎓 Next Application Opens In:
                        </p>
                        <div id="countdown" class="grid grid-cols-4 gap-3 text-center">
                            <div class="bg-white rounded-lg p-3 shadow-md">
                                <div id="days" class="text-3xl font-bold text-primary">00</div>
                                <div class="text-xs text-gray-600 font-medium mt-1">Days</div>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-md">
                                <div id="hours" class="text-3xl font-bold text-primary">00</div>
                                <div class="text-xs text-gray-600 font-medium mt-1">Hours</div>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-md">
                                <div id="minutes" class="text-3xl font-bold text-primary">00</div>
                                <div class="text-xs text-gray-600 font-medium mt-1">Minutes</div>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-md">
                                <div id="seconds" class="text-3xl font-bold text-primary">00</div>
                                <div class="text-xs text-gray-600 font-medium mt-1">Seconds</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-4">
                    @auth
                        <a id="apply-btn-auth" href="{{ route('apply-form') }}"
                            class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center transition-all duration-300"
                            style="display: none;">
                            <span id="apply-btn-text-auth">Start Application &rarr;</span>
                        </a>
                    @else
                        <a id="apply-btn-guest" href="{{ route('register') }}"
                            class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center transition-all duration-300"
                            style="display: none;">
                            <span id="apply-btn-text-guest">Start Application &rarr;</span>
                        </a>
                    @endauth
                    <a href="#process"
                        class="inline-flex items-center justify-center px-10 py-4 border border-secondary text-base font-medium rounded-full text-primary bg-white hover:bg-gray-100 transition duration-300 shadow-md">
                        View Process
                    </a>
                </div>
            </div>

            <!-- Mockup Image/Illustration Placeholder -->
            <div class="mt-16 lg:mt-0 lg:col-span-5">
                <div
                    class="aspect-w-4 aspect-h-3 rounded-3xl overflow-hidden shadow-2xl card transform hover:scale-[1.01]">
                    <img class="w-full object-cover h-auto rounded-3xl"
                        src="{{ asset('assets/img/2025_UTME_Scholarship_Application_for_Iba_Indigenes -  Web Open.jpg') }}"
                        alt="Students studying together">
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Countdown Timer and Button Control
    let formSettings = null;

    // Fetch form settings from API
    async function fetchFormSettings() {
        try {
            const response = await fetch('/api/form-settings/application_form');
            const data = await response.json();
            formSettings = data;
            updateCountdown();
        } catch (error) {
            console.error('Error fetching form settings:', error);
            // Fallback to default behavior if API fails
            updateCountdown();
        }
    }

    function updateCountdown() {
        // Use API data if available, otherwise use fallback dates
        let openDate, closeDate;

        if (formSettings && formSettings.opens_at) {
            openDate = new Date(formSettings.opens_at).getTime();
        } else {
            openDate = new Date('2025-12-08T00:00:00').getTime();
        }

        if (formSettings && formSettings.closes_at) {
            closeDate = new Date(formSettings.closes_at).getTime();
        } else {
            closeDate = new Date('2026-01-16T23:59:59').getTime();
        }

        const now = new Date().getTime();
        const distanceToOpen = openDate - now;
        const distanceToClose = closeDate - now;

        const label = document.getElementById('countdown-label');
        const countdownEl = document.getElementById('countdown');

        // Get button elements
        const applyBtnAuth = document.getElementById('apply-btn-auth');
        const applyBtnGuest = document.getElementById('apply-btn-guest');
        const applyBtnTextAuth = document.getElementById('apply-btn-text-auth');
        const applyBtnTextGuest = document.getElementById('apply-btn-text-guest');

        // Check if form is manually disabled via admin
        const isFormOpen = formSettings ? formSettings.is_open : true;
        const isCurrentlyOpen = formSettings ? formSettings.is_currently_open : true;

        // If form is manually closed by admin but has a future opening date
        if ((!isFormOpen || !isCurrentlyOpen) && distanceToOpen > 0) {
            // Show countdown to opening date with closed message
            const days = Math.floor(distanceToOpen / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distanceToOpen % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distanceToOpen % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distanceToOpen % (1000 * 60)) / 1000);

            const closedMessage = formSettings?.closed_message || 'Application Period Has Ended';
            label.innerHTML =
                `<span class="text-red-600">⚠️ ${closedMessage}</span><br><span class="text-sm text-gray-600 mt-2">Opens in:</span>`;

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

            // Hide application button
            if (applyBtnAuth) applyBtnAuth.style.display = 'none';
            if (applyBtnGuest) applyBtnGuest.style.display = 'none';
            return;
        }

        // If form is closed and no future opening date
        if (!isFormOpen || !isCurrentlyOpen) {
            const closedMessage = formSettings?.closed_message || 'Application Period Has Ended';
            countdownEl.innerHTML =
                `<div class="col-span-4 text-center"><p class="text-xl font-bold text-red-600">❌ ${closedMessage}</p></div>`;
            label.innerHTML = '';

            // Show but disable application button
            if (applyBtnAuth) {
                applyBtnAuth.style.display = 'inline-flex';
                applyBtnAuth.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                applyBtnTextAuth.innerHTML = 'Applications Closed';
            }
            if (applyBtnGuest) {
                applyBtnGuest.style.display = 'inline-flex';
                applyBtnGuest.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                applyBtnTextGuest.innerHTML = 'Applications Closed';
            }
            return;
        }

        // Before opening date - HIDE BUTTON
        if (distanceToOpen > 0) {
            // Calculate time until opening
            const days = Math.floor(distanceToOpen / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distanceToOpen % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distanceToOpen % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distanceToOpen % (1000 * 60)) / 1000);

            label.innerHTML = '🎓 Next Application Opens In:';
            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

            // Hide application button
            if (applyBtnAuth) applyBtnAuth.style.display = 'none';
            if (applyBtnGuest) applyBtnGuest.style.display = 'none';
        }
        // After opening, before closing - SHOW BUTTON WITH "NOW"
        else if (distanceToClose > 0) {
            // Calculate time until closing
            const days = Math.floor(distanceToClose / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distanceToClose % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distanceToClose % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distanceToClose % (1000 * 60)) / 1000);

            label.innerHTML = '⏰ Application Closes In:';
            label.classList.remove('text-gray-700');
            label.classList.add('text-orange-700');
            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

            // Show and enable application button with "NOW"
            if (applyBtnAuth) {
                applyBtnAuth.style.display = 'inline-flex';
                applyBtnAuth.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                applyBtnTextAuth.innerHTML = 'Start Application NOW &rarr;';
            }
            if (applyBtnGuest) {
                applyBtnGuest.style.display = 'inline-flex';
                applyBtnGuest.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                applyBtnTextGuest.innerHTML = 'Start Application NOW &rarr;';
            }
        }
        // After closing date - SHOW DISABLED BUTTON
        else {
            countdownEl.innerHTML =
                '<div class="col-span-4 text-center"><p class="text-xl font-bold text-red-600">❌ Application Period Has Ended</p></div>';
            label.innerHTML = '';

            // Show but disable application button
            if (applyBtnAuth) {
                applyBtnAuth.style.display = 'inline-flex';
                applyBtnAuth.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                applyBtnTextAuth.innerHTML = 'Applications Closed';
            }
            if (applyBtnGuest) {
                applyBtnGuest.style.display = 'inline-flex';
                applyBtnGuest.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                applyBtnTextGuest.innerHTML = 'Applications Closed';
            }
        }
    }

    // Initialize: Fetch form settings and start countdown
    fetchFormSettings();
    // Update countdown every second
    setInterval(updateCountdown, 1000);
</script>
