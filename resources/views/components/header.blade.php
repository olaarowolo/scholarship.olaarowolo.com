<!-- 1. Hero Section -->
<header class="hero-bg relative overflow-hidden pt-32 pb-28 sm:pt-40 lg:pt-48">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-7 lg:text-left">
                <div
                    class="text-sm font-semibold uppercase tracking-widest text-primary flex items-center gap-2 justify-center lg:justify-start animate-fade-in-down">
                    <span>Empowering Local Excellence</span>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-black text-white shadow-md animate-pulse-slow">
                        Since 2022
                    </span>
                </div>
                <h1
                    class="mt-4 text-5xl tracking-tight font-extrabold text-gray-900 sm:text-6xl lg:text-5xl xl:text-7xl animate-fade-in-up animation-delay-200">
                    The <span class="text-primary block lg:inline">Scholarship</span> for Iba Town's Brightest
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-xl mx-auto lg:mx-0 animate-fade-in-up animation-delay-400">
                    Providing financial and mentorship support to emerging leaders to access and excel in quality
                    university education.
                </p>

                <!-- Countdown Timer -->
                <div class="mt-8 max-w-xl mx-auto lg:mx-0 animate-fade-in-up animation-delay-600">
                    <div
                        class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-2xl p-6 backdrop-blur-sm border border-primary/20 hover:shadow-xl transition-shadow duration-300">
                        <p id="countdown-label"
                            class="text-sm font-semibold text-gray-700 text-center lg:text-left mb-3">
                            🎓 Next Application Opens In:
                        </p>
                        <div id="countdown" class="grid grid-cols-4 gap-3 text-center">
                            <div
                                class="bg-white rounded-lg p-3 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                                <div id="days" class="text-3xl font-bold text-primary">00</div>
                                <div class="text-xs text-gray-600 font-medium mt-1">Days</div>
                            </div>
                            <div
                                class="bg-white rounded-lg p-3 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                                <div id="hours" class="text-3xl font-bold text-primary">00</div>
                                <div class="text-xs text-gray-600 font-medium mt-1">Hours</div>
                            </div>
                            <div
                                class="bg-white rounded-lg p-3 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                                <div id="minutes" class="text-3xl font-bold text-primary">00</div>
                                <div class="text-xs text-gray-600 font-medium mt-1">Minutes</div>
                            </div>
                            <div
                                class="bg-white rounded-lg p-3 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                                <div id="seconds" class="text-3xl font-bold text-primary">00</div>
                                <div class="text-xs text-gray-600 font-medium mt-1">Seconds</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="mt-10 flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-4 animate-fade-in-up animation-delay-800">
                    @auth
                        <a id="apply-btn-auth" href="{{ route('apply-form') }}"
                            class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                            style="display: none;">
                            <span id="apply-btn-text-auth">Start Application &rarr;</span>
                        </a>
                    @else
                        <a id="apply-btn-guest" href="{{ route('register') }}"
                            class="btn-primary text-lg font-bold px-10 py-4 rounded-full shadow-lg inline-flex items-center justify-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                            style="display: none;">
                            <span id="apply-btn-text-guest">Start Application &rarr;</span>
                        </a>
                    @endauth
                    <a href="#process"
                        class="inline-flex items-center justify-center px-10 py-4 border border-secondary text-base font-medium rounded-full text-primary bg-white hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                        View Process
                    </a>
                </div>
            </div>

            <!-- Mockup Image/Illustration Placeholder -->
            <div class="mt-16 lg:mt-0 lg:col-span-5 animate-fade-in-right animation-delay-400">
                <div
                    class="rounded-3xl overflow-hidden shadow-2xl card transform hover:scale-[1.02] transition-all duration-500 animate-float">
                    <img class="w-full h-auto rounded-3xl"
                        src="{{ asset('assets/img/2025_UTME_Scholarship_Application_for_Iba_Indigenes -  Web Open.jpg') }}"
                        alt="Students studying together">
                </div>
                <!-- Share Buttons -->
                <div class="mt-4 flex flex-col items-center gap-3">
                    <!-- Main Share Button -->
                    <button onclick="shareApplyPage()"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-full shadow-lg hover:from-blue-700 hover:to-blue-800 hover:scale-105 transition-all duration-300 hover:shadow-xl">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                        </svg>
                        <span class="text-xs text-gray-600 font-medium">Share Opportunity</span>
                    </button>

                    <!-- Quick Share Icons -->
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-600 font-medium">Quick share:</span>
                        <a href="javascript:void(0)" onclick="shareToWhatsApp()"
                            class="flex items-center justify-center w-10 h-10 bg-green-500 hover:bg-green-600 rounded-full shadow-md hover:shadow-lg transition-all duration-200 hover:scale-110"
                            title="Share on WhatsApp">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                        </a>
                        <a href="javascript:void(0)" onclick="shareToFacebook()"
                            class="flex items-center justify-center w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full shadow-md hover:shadow-lg transition-all duration-200 hover:scale-110"
                            title="Share on Facebook">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                    </div>
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

    // Share functionality for apply page
    function shareApplyPage() {
        const applyUrl = '{{ route('apply') }}';
        const title = '2026 UTME Scholarship - OA Foundation';
        const text =
            '🎓 Apply for the OA Foundation Scholarship for Iba Indigenes! Financial support and mentorship for university education. Check eligibility and apply now!';

        // Check if the Web Share API is supported
        if (navigator.share) {
            navigator.share({
                    title: title,
                    text: text,
                    url: applyUrl
                })
                .then(() => console.log('Successful share'))
                .catch((error) => console.log('Error sharing:', error));
        } else {
            // Fallback: Show modal with sharing options
            showShareModalHero(applyUrl, title, text);
        }
    }

    function showShareModalHero(url, title, text) {
        const encodedUrl = encodeURIComponent(url);
        const encodedTitle = encodeURIComponent(title);
        const encodedText = encodeURIComponent(text);

        const shareLinks = {
            whatsapp: `https://wa.me/?text=${encodedText}%20${encodedUrl}`,
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
            twitter: `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedText}`,
            linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`,
            telegram: `https://t.me/share/url?url=${encodedUrl}&text=${encodedText}`,
            email: `mailto:?subject=${encodedTitle}&body=${encodedText}%20${encodedUrl}`
        };

        // Create modal HTML
        const modalHTML = `
            <div id="shareModalHero" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" onclick="closeShareModalHero(event)">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6" onclick="event.stopPropagation()">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Share Scholarship Opportunity</h3>
                        <button onclick="closeShareModalHero()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <p class="text-gray-600 text-sm mb-6">Help spread the word about this scholarship opportunity:</p>
                    <div class="grid grid-cols-3 gap-4">
                        <a href="${shareLinks.whatsapp}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-colors">
                            <svg class="w-8 h-8 text-green-600 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            <span class="text-xs font-semibold text-gray-700">WhatsApp</span>
                        </a>
                        <a href="${shareLinks.facebook}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                            <svg class="w-8 h-8 text-blue-600 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="text-xs font-semibold text-gray-700">Facebook</span>
                        </a>
                        <a href="${shareLinks.twitter}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-sky-50 hover:bg-sky-100 rounded-xl transition-colors">
                            <svg class="w-8 h-8 text-sky-600 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                            <span class="text-xs font-semibold text-gray-700">Twitter</span>
                        </a>
                        <a href="${shareLinks.linkedin}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                            <svg class="w-8 h-8 text-blue-700 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                            <span class="text-xs font-semibold text-gray-700">LinkedIn</span>
                        </a>
                        <a href="${shareLinks.telegram}" target="_blank" class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                            <svg class="w-8 h-8 text-blue-500 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                            <span class="text-xs font-semibold text-gray-700">Telegram</span>
                        </a>
                        <a href="${shareLinks.email}" class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition-colors">
                            <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs font-semibold text-gray-700">Email</span>
                        </a>
                    </div>
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <label class="text-xs font-semibold text-gray-700 mb-2 block">Or copy link:</label>
                        <div class="flex items-center gap-2">
                            <input type="text" value="${url}" readonly class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg bg-white" id="shareUrlHero">
                            <button onclick="copyToClipboardHero()" class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-lg hover:bg-gray-700 transition-colors">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML);
        document.body.style.overflow = 'hidden';
    }

    function closeShareModalHero(event) {
        if (event && event.target.id !== 'shareModalHero') return;
        const modal = document.getElementById('shareModalHero');
        if (modal) {
            modal.remove();
            document.body.style.overflow = '';
        }
    }

    function copyToClipboardHero() {
        const input = document.getElementById('shareUrlHero');
        input.select();
        document.execCommand('copy');

        // Show feedback
        const button = event.target;
        const originalText = button.textContent;
        button.textContent = 'Copied!';
        button.classList.add('bg-green-600');
        button.classList.remove('bg-gray-800');

        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('bg-green-600');
            button.classList.add('bg-gray-800');
        }, 2000);
    }

    // Quick share functions
    function shareToWhatsApp() {
        const applyUrl = '{{ route('apply') }}';
        const text =
            '🎓 Apply for the OA Foundation Scholarship for Iba Indigenes! Financial support and mentorship for university education. Check eligibility and apply now!';
        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + applyUrl)}`;
        window.open(whatsappUrl, '_blank');
    }

    function shareToFacebook() {
        const applyUrl = '{{ route('apply') }}';
        const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(applyUrl)}`;
        window.open(facebookUrl, '_blank', 'width=600,height=400');
    }
</script>
