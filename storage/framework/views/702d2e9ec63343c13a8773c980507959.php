<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free UTME JAMB Form Application</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        /* Custom Theme Configuration */
        :root {
            --color-primary: #1D4ED8; /* Blue for JAMB/UTME theme */
            --color-secondary: #0c3395; /* Darker blue for hover/accents */
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Configure Tailwind to use our custom primary color */
        .bg-primary { background-color: var(--color-primary); }
        .text-primary { color: var(--color-primary); }
        .border-primary { border-color: var(--color-primary); }
        .focus\:ring-primary:focus { --tw-ring-color: var(--color-primary); }
        .focus\:border-primary:focus { border-color: var(--color-primary); }
        .hover\:bg-secondary:hover { background-color: var(--color-secondary); }
        
        /* Custom spinner for submission button */
        .spinner {
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-bottom-color: transparent;
            border-right-color: transparent;
        }
    </style>
</head>
<body class="bg-blue-50 flex justify-center items-start min-h-screen py-16">

    <div class="w-full max-w-2xl bg-white p-8 sm:p-10 rounded-2xl shadow-2xl border border-blue-200">
        
        <header class="mb-8 text-center">
            <h1 class="text-3xl font-extrabold text-primary">
                Free UTME JAMB Form Application
            </h1>
            <p class="text-gray-600 mt-2">
                Register below to get a fully sponsored 2024/2025 JAMB Form.
            </p>
        </header>

        <!-- Authentication & User ID Display -->
        <div class="text-xs text-right text-gray-400 mb-6">
            <span id="auth-status">Authenticating...</span>
        </div>

        <!-- Submission Status Message Container -->
        <div id="status-message-container"></div>

        <!-- Form Content Container -->
        <div id="form-content-container" class="p-6 border border-blue-300 rounded-xl bg-white">
            <form id="jamb-form" onsubmit="event.preventDefault(); handleSubmit();">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Applicant Details</h2>
                
                <!-- Full Name -->
                <div class="mb-5">
                    <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" id="fullName" value="" placeholder="Olawale John Doe" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                </div>

                <!-- Email Address -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" id="email" value="" placeholder="your.email@example.com" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                </div>

                <!-- Phone Number -->
                <div class="mb-5">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                    <input type="tel" id="phone" value="" placeholder="080XXXXXXXX" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                </div>
                
                <!-- State of Origin -->
                <div class="mb-5">
                    <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State of Origin <span class="text-red-500">*</span></label>
                    <input type="text" id="state" value="" placeholder="Lagos" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                </div>
                
                <!-- LGA -->
                <div class="mb-5">
                    <label for="lga" class="block text-sm font-medium text-gray-700 mb-1">Local Government Area (LGA) <span class="text-red-500">*</span></label>
                    <input type="text" id="lga" value="" placeholder="Ojo" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                </div>

                <!-- JAMB Registration Number (Optional) -->
                <div class="mb-8">
                    <label for="jambRegNo" class="block text-sm font-medium text-gray-700 mb-1">Existing JAMB Registration No. (Optional)</label>
                    <input type="text" id="jambRegNo" value="" placeholder="A1234567" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                </div>

                <!-- Terms and Consent -->
                <div class="bg-blue-50 p-4 rounded-lg mt-6 text-sm text-gray-700 border border-blue-200">
                    <div class="flex items-center">
                        <input type="checkbox" id="consent" required class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary mr-2" />
                        <label for="consent">I consent to providing my details for the scholarship application and agree to the terms.</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-8">
                    <button 
                        type="submit" 
                        id="submit-button"
                        class="bg-primary text-white px-10 py-3 rounded-full font-bold text-lg shadow-xl hover:bg-secondary transition duration-300 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled
                    >
                        <span id="submit-text">Apply for Free Form</span>
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Firebase SDK Imports -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, doc, setDoc } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // Global State
        const state = {
            isAuthReady: false,
            userId: null,
            db: null,
            auth: null,
            isLoading: false,
        };

        // --- Utility Functions ---
        
        /** Renders a status message in the dedicated container */
        function renderStatusMessage(message, type = 'info') {
            const container = document.getElementById('status-message-container');
            if (!message) {
                container.innerHTML = '';
                return;
            }

            const baseClasses = "p-4 rounded-lg font-medium mb-4 text-sm";
            const colorClasses = {
                info: "bg-blue-100 text-blue-700 border border-blue-300",
                success: "bg-green-50 text-green-700 border border-green-300",
                error: "bg-red-50 text-red-700 border border-red-300",
            };
            
            container.innerHTML = `
                <div class="${baseClasses} ${colorClasses[type]}">
                    ${message}
                </div>
            `;
        }
        
        /** Updates the submit button state (loading/enabled/disabled) */
        function updateSubmitButton(form) {
            const button = document.getElementById('submit-button');
            const submitText = document.getElementById('submit-text');
            const consentCheckbox = document.getElementById('consent');
            
            const isFormValid = form.checkValidity() && consentCheckbox?.checked;

            if (state.isLoading) {
                button.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 border-2 rounded-full spinner" viewBox="0 0 24 24"></svg> Submitting...';
                button.disabled = true;
            } else {
                button.innerHTML = '<span id="submit-text">Apply for Free Form</span>';
                button.disabled = !isFormValid;
            }
        }

        // --- FIREBASE INITIALIZATION ---

        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : undefined;

        async function initializeFirebase() {
            try {
                if (Object.keys(firebaseConfig).length === 0) {
                    console.error("Firebase config is missing.");
                    document.getElementById('auth-status').textContent = 'Error: Firebase Config Missing';
                    state.isAuthReady = true; 
                    return;
                }

                const firebaseApp = initializeApp(firebaseConfig);
                state.db = getFirestore(firebaseApp);
                state.auth = getAuth(firebaseApp);

                // Auth Listener and Sign-In
                onAuthStateChanged(state.auth, async (user) => {
                    if (user) {
                        state.userId = user.uid;
                    } else {
                        if (initialAuthToken) {
                            await signInWithCustomToken(state.auth, initialAuthToken);
                        } else {
                            await signInAnonymously(state.auth);
                        }
                    }
                    state.isAuthReady = true;
                    document.getElementById('auth-status').textContent = `Logged in as: ${state.userId}`;
                    // Initial check to enable button if form is valid and auth is ready
                    const form = document.getElementById('jamb-form');
                    if (form) updateSubmitButton(form); 
                });

            } catch (error) {
                console.error("Error initializing Firebase:", error);
                document.getElementById('auth-status').textContent = 'Error: Initialization Failed';
                state.isAuthReady = true;
            }
        }
        
        // --- SUBMISSION HANDLER ---
        
        window.handleSubmit = async () => {
            const form = document.getElementById('jamb-form');
            if (!form.checkValidity() || !document.getElementById('consent').checked) return;

            state.isLoading = true;
            updateSubmitButton(form); // Show loading state
            renderStatusMessage(null);
            
            if (!state.db || !state.userId) {
                renderStatusMessage('System error: Authentication or database connection failed.', 'error');
                state.isLoading = false;
                updateSubmitButton(form);
                return;
            }

            try {
                // Collect and structure data from the form
                const applicationData = {
                    fullName: document.getElementById('fullName').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    stateOfOrigin: document.getElementById('state').value,
                    lga: document.getElementById('lga').value,
                    jambRegNo: document.getElementById('jambRegNo').value || null,
                    submissionDate: new Date().toISOString(),
                    status: 'Applied',
                    applicantId: state.userId,
                };
                
                // Define the private collection path for the JAMB form applications
                const applicationDocRef = doc(state.db, 
                    `artifacts/${appId}/users/${state.userId}/jamb_scholarship_forms`, 
                    'latest_jamb_form'
                );
                
                await setDoc(applicationDocRef, applicationData, { merge: true });

                renderStatusMessage('Application for Free JAMB Form submitted successfully! We will contact you shortly.', 'success');
                
                // Clear form and display success
                form.reset();
                state.isLoading = false;
                updateSubmitButton(form);

            } catch (error) {
                console.error("Error submitting application:", error);
                renderStatusMessage(`Submission failed: ${error.message}. Please check your connection and try again.`, 'error');
                state.isLoading = false;
                updateSubmitButton(form);
            }
        };

        // --- Event Listeners and Initialization ---
        
        function setupListeners() {
            const form = document.getElementById('jamb-form');
            // Listen for any input changes to update the validation/button state
            form.addEventListener('input', () => {
                // Only update button if auth is ready
                if (state.isAuthReady) {
                    updateSubmitButton(form);
                }
            });
        }

        window.onload = () => {
            initializeFirebase();
            setupListeners();
        };
    </script>
</body>
</html><?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/apply-utme-jamb-form.blade.php ENDPATH**/ ?>