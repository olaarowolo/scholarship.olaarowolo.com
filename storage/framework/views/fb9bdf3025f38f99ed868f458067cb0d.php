<!-- Terms & Privacy Consent Popup -->
<div id="consent-popup" class="hidden">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" id="consent-overlay" style="z-index: 2147483646;">
    </div>

    <!-- Popup Content Container -->
    <div id="consent-popup-content" class="fixed inset-x-0 bottom-0 transition-transform duration-500 ease-out"
        style="z-index: 2147483647; transform: translateY(100%);">
        <div class="relative bg-white rounded-t-3xl shadow-2xl border-t-4 border-black max-w-4xl mx-auto">
            <div class="p-6 sm:p-8">
                <!-- Header -->
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 w-12 h-12 bg-black rounded-full flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-extrabold text-gray-900">Welcome!</h3>
                            <p class="text-sm text-gray-600">Please review and accept our policies</p>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <p class="text-gray-700 leading-relaxed mb-4">
                        To provide you with the best experience and protect your privacy, we need your consent to our
                        Terms
                        & Conditions and Privacy Policy.
                    </p>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-500 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-800">
                                    <strong>What we collect:</strong> We collect visitor data (IP address, location,
                                    browser
                                    info) for analytics, and personal information only when you apply for the
                                    scholarship.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-shield-alt text-yellow-600 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-800">
                                    <strong>Your data is safe:</strong> We never sell your information to third parties.
                                    Your data is encrypted and securely stored.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkboxes -->
                <div class="space-y-4 mb-6">
                    <div class="flex items-start">
                        <div class="flex items-center h-5 mt-1">
                            <input id="accept-terms" name="accept-terms" type="checkbox"
                                class="w-5 h-5 border-gray-300 rounded text-black focus:ring-black cursor-pointer">
                        </div>
                        <div class="ml-3">
                            <label for="accept-terms" class="text-base text-gray-700 cursor-pointer">
                                I have read and agree to the
                                <a href="<?php echo e(route('terms')); ?>" target="_blank"
                                    class="font-semibold text-black hover:underline">
                                    Terms & Conditions
                                    <i class="fas fa-external-link-alt text-xs ml-1"></i>
                                </a>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5 mt-1">
                            <input id="accept-privacy" name="accept-privacy" type="checkbox"
                                class="w-5 h-5 border-gray-300 rounded text-black focus:ring-black cursor-pointer">
                        </div>
                        <div class="ml-3">
                            <label for="accept-privacy" class="text-base text-gray-700 cursor-pointer">
                                I have read and agree to the
                                <a href="<?php echo e(route('privacy')); ?>" target="_blank"
                                    class="font-semibold text-black hover:underline">
                                    Privacy Policy
                                    <i class="fas fa-external-link-alt text-xs ml-1"></i>
                                </a>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                <div id="consent-error" class="hidden mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-800 font-medium">
                                Please accept both policies to continue using our website.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button id="accept-consent-btn" type="button"
                        class="flex-1 bg-black text-white font-bold py-4 px-6 rounded-xl hover:bg-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-check-circle mr-2"></i>
                        Accept & Continue
                    </button>
                    <a href="https://google.com"
                        class="flex-1 sm:flex-none bg-gray-200 text-gray-700 font-semibold py-4 px-6 rounded-xl hover:bg-gray-300 transition-colors duration-200 text-center">
                        Decline & Leave
                    </a>
                </div>

                <!-- Fine Print -->
                <p class="text-xs text-gray-500 text-center mt-4">
                    By accepting, you allow us to collect anonymous analytics data and process your information as
                    described
                    in our policies. You can withdraw consent anytime by contacting us.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    #consent-popup {
        pointer-events: none;
    }

    #consent-popup.show {
        display: block !important;
        pointer-events: auto !important;
    }

    #consent-popup.show #consent-overlay {
        display: block !important;
    }

    #consent-popup.show #consent-popup-content {
        transform: translateY(0) !important;
    }

    /* Prevent body scroll when popup is open */
    body.consent-popup-open {
        overflow: hidden;
    }

    /* Smooth checkbox animation */
    input[type="checkbox"]:checked {
        animation: checkboxPop 0.3s ease-out;
    }

    @keyframes checkboxPop {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Pulse animation for unchecked required items */
    .checkbox-required {
        animation: checkboxPulse 2s infinite;
    }

    @keyframes checkboxPulse {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.4);
        }

        50% {
            box-shadow: 0 0 0 8px rgba(0, 0, 0, 0);
        }
    }
</style>

<script>
    (function() {
        console.log('Consent popup script loaded');

        // Check if consent has already been given
        const consentGiven = localStorage.getItem('consent_given') === 'true';
        console.log('Consent status:', consentGiven ? 'Already given' : 'Not given - will show popup');

        if (!consentGiven) {
            // Show popup after DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', showConsentPopup);
            } else {
                showConsentPopup();
            }
        }

        function showConsentPopup() {
            setTimeout(() => {
                console.log('=== SHOWING CONSENT POPUP ===');
                const popup = document.getElementById('consent-popup');
                const popupContent = document.getElementById('consent-popup-content');
                const body = document.body;

                if (!popup) {
                    console.error('❌ Consent popup element not found!');
                    return;
                }

                console.log('✓ Popup element found:', popup);
                console.log('✓ Popup content found:', popupContent);
                console.log('Before - Popup classes:', popup.className);
                console.log('Before - Content transform:', popupContent ? window.getComputedStyle(
                    popupContent).transform : 'N/A');

                popup.classList.remove('hidden');
                popup.classList.add('show');
                body.classList.add('consent-popup-open');

                console.log('After - Popup classes:', popup.className);
                console.log('After - Popup display:', window.getComputedStyle(popup).display);
                console.log('After - Content transform:', popupContent ? window.getComputedStyle(
                    popupContent).transform : 'N/A');

                const overlay = document.getElementById('consent-overlay');
                console.log('✓ Overlay found:', overlay !== null);
                console.log('✓ Overlay display:', overlay ? window.getComputedStyle(overlay).display :
                    'N/A');
                console.log('=== POPUP DISPLAY COMPLETE ===');
            }, 300);
        }

        // Wait for DOM to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Handle checkbox changes
            const termsCheckbox = document.getElementById('accept-terms');
            const privacyCheckbox = document.getElementById('accept-privacy');
            const acceptButton = document.getElementById('accept-consent-btn');
            const errorMessage = document.getElementById('consent-error');

            if (!termsCheckbox || !privacyCheckbox || !acceptButton) {
                console.error('Consent popup elements not found');
                return;
            }

            function updateButtonState() {
                const bothChecked = termsCheckbox.checked && privacyCheckbox.checked;
                acceptButton.disabled = !bothChecked;

                if (errorMessage && !errorMessage.classList.contains('hidden')) {
                    errorMessage.classList.add('hidden');
                }
            }

            termsCheckbox.addEventListener('change', updateButtonState);
            privacyCheckbox.addEventListener('change', updateButtonState);

            // Handle accept button click
            acceptButton.addEventListener('click', async function() {
                if (!termsCheckbox.checked || !privacyCheckbox.checked) {
                    errorMessage.classList.remove('hidden');

                    // Add pulse effect to unchecked boxes
                    if (!termsCheckbox.checked) {
                        termsCheckbox.classList.add('checkbox-required');
                        setTimeout(() => termsCheckbox.classList.remove('checkbox-required'),
                            2000);
                    }
                    if (!privacyCheckbox.checked) {
                        privacyCheckbox.classList.add('checkbox-required');
                        setTimeout(() => privacyCheckbox.classList.remove('checkbox-required'),
                            2000);
                    }
                    return;
                }

                // Show loading state
                acceptButton.disabled = true;
                acceptButton.innerHTML =
                    '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';

                try {
                    // Send consent to backend
                    const response = await fetch('<?php echo e(route('consent.store')); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]')
                                ?.content || '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            terms_accepted: true,
                            privacy_accepted: true
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Store consent in localStorage
                        localStorage.setItem('consent_given', 'true');
                        localStorage.setItem('consent_timestamp', new Date().toISOString());
                        console.log('Consent recorded successfully');

                        // Success feedback
                        acceptButton.innerHTML = '<i class="fas fa-check mr-2"></i>Thank you!';
                        acceptButton.classList.add('bg-green-600', 'hover:bg-green-700');
                        acceptButton.classList.remove('bg-black', 'hover:bg-gray-800');

                        // Hide popup
                        setTimeout(() => {
                            const popup = document.getElementById('consent-popup');
                            document.body.classList.remove('consent-popup-open');
                            popup.classList.remove('show');
                            popup.classList.add('hidden');
                        }, 800);
                    } else {
                        throw new Error('Failed to record consent');
                    }
                } catch (error) {
                    console.error('Error recording consent:', error);
                    acceptButton.disabled = false;
                    acceptButton.innerHTML =
                        '<i class="fas fa-check-circle mr-2"></i>Accept & Continue';

                    errorMessage.querySelector('p').textContent =
                        'An error occurred. Please try again.';
                    errorMessage.classList.remove('hidden');
                }
            });

            // Prevent closing popup by clicking overlay
            document.getElementById('consent-overlay')?.addEventListener('click', function(e) {
                e.preventDefault();
                // Add a shake animation to indicate it can't be closed
                const popupContent = document.querySelector('#consent-popup .bg-white');
                if (popupContent) {
                    popupContent.classList.add('animate-shake');
                    setTimeout(() => popupContent.classList.remove('animate-shake'), 500);
                }
            });
        });

        // Debug helper: Add to browser console to reset consent
        // localStorage.removeItem('consent_given');
        // localStorage.removeItem('consent_timestamp');
        // then refresh page
    })();
</script>

<style>
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        10%,
        30%,
        50%,
        70%,
        90% {
            transform: translateX(-10px);
        }

        20%,
        40%,
        60%,
        80% {
            transform: translateX(10px);
        }
    }

    .animate-shake {
        animation: shake 0.5s;
    }
</style>
<?php /**PATH /Users/olasunkanmiarowolo/scholarship.olaarowolo.com/resources/views/components/consent-popup.blade.php ENDPATH**/ ?>