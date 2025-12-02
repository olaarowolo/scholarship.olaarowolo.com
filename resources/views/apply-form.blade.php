<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OA Scholarship Application</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        /* Custom Theme Configuration */
        :root {
            --color-primary: #000000; /* Primary action color - Black */
            --color-secondary: #1f2937; /* Dark Grey for hover/accents */
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
<body class="bg-gray-50 min-h-screen flex flex-col">

    <main class="flex-grow flex justify-center items-start py-16">
        <div class="w-full max-w-4xl bg-white p-8 sm:p-12 rounded-2xl shadow-2xl border border-gray-200">

        <header class="mb-8 text-center">
            <img class="h-10 w-auto mx-auto mb-4"
                src="https://scholarship.olaarowolo.com/assets/img/favicon/olaarowolo.com_logo_black.png"
                alt="OA Scholarship Logo" />
            <h1 class="text-4xl font-extrabold text-primary">
                Scholarship Application
            </h1>
            <p class="text-gray-600 mt-2">
                Complete the following steps to submit your candidacy.
            </p>
        </header>

        <!-- Application Form -->

        <!-- Go Back Home Button -->
        <div class="mb-6 text-left">
            <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Go Back Home
            </a>
        </div>

        <!-- Step Progress Bar -->
        <div class="mb-10">
            <div class="flex justify-between mb-2 text-sm font-medium text-gray-700">
                <span id="step-info">Step 1 of 3</span>
                <span id="progress-percent">0% Complete</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div id="progress-bar" class="bg-primary h-2.5 rounded-full transition-all duration-500 ease-in-out" style="width: 0%;"></div>
            </div>
            <div class="flex justify-between mt-1 text-xs text-gray-500">
                <span id="step-label-1" class="font-semibold text-primary">Personal</span>
                <span id="step-label-2">Academic</span>
                <span id="step-label-3">Documents</span>
                <span id="step-label-4">Review</span>
            </div>
        </div>

        <!-- Submission Status Message Container -->
        <div id="status-message-container"></div>

        <!-- Form Content Container -->
        <div id="form-content-container" class="p-8 border border-gray-300 rounded-xl bg-gray-50">
            <!-- Form steps will be rendered here by JavaScript -->
        </div>

    </div>

    <!-- Application Script -->
    <script type="module">

        // Global State
        const state = {
            step: 1,
            isAuthReady: false,
            userId: null,
            db: null,
            auth: null,
            submissionStatus: null,
            isLoading: false,
            data: {
                personal: {
                    fullName: '',
                    email: '',
                    phone: '',
                    address: '',
                    isIndigene: 'No',
                },
                academic: {
                    jambScore: 0,
                    waecGceYear: '',
                    institution: '',
                    course: '',
                    admissionStatus: 'Awaiting',
                },
                documents: {
                    jambResult: null, // Stores File object
                    waecResult: null, // Stores File object
                    indigeneCert: null, // Stores File object
                },
            }
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
                info: "bg-gray-100 text-gray-700 border border-gray-300",
                success: "bg-green-50 text-green-700 border border-green-300",
                error: "bg-red-50 text-red-700 border border-red-300",
            };

            container.innerHTML = `
                <div class="${baseClasses} ${colorClasses[type]}">
                    ${message}
                </div>
            `;
        }

        /** Updates the progress bar and step labels */
        function updateProgress() {
            const step = state.step;
            const progress = Math.min(100, (step - 1) * 33.33);

            document.getElementById('step-info').textContent = `Step ${step} of 3`;
            document.getElementById('progress-percent').textContent = `${progress.toFixed(0)}% Complete`;
            document.getElementById('progress-bar').style.width = `${progress}%`;

            for (let i = 1; i <= 4; i++) {
                const label = document.getElementById(`step-label-${i}`);
                if (label) {
                    label.classList.toggle('font-semibold', i <= step);
                    label.classList.toggle('text-primary', i <= step);
                }
            }
        }

        // --- Navigation Functions ---

        function nextStep() {
            if (state.step < 4) {
                state.step++;
                renderStep();
            }
        }

        function prevStep() {
            if (state.step > 1) {
                state.step--;
                renderStep();
            }
        }

        // --- Step Rendering Functions ---

        function getStep1HTML() {
            const personal = state.data.personal;
            const isEligible = personal.isIndigene === 'Yes' || personal.isIndigene === 'Pending';
            const isFormValid = personal.fullName && personal.email && personal.phone && isEligible;

            let statusHtml = '';
            if (personal.isIndigene === 'No') {
                statusHtml = `<div class="p-4 rounded-lg font-medium mb-4 text-sm bg-red-50 text-red-700 border border-red-300">
                    Only indigenes of Iba Town are eligible to apply. Please confirm your status.
                </div>`;
            }

            return `
                <form id="step1-form">
                    <h2 class="text-2xl font-extrabold text-primary mb-6">1. Personal & Contact Information</h2>

                    <div class="mb-6">
                        <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Full Name (As per official documents) <span class="text-red-500">*</span></label>
                        <input type="text" id="fullName" value="${personal.fullName}" onchange="updateData('personal', 'fullName', event.target.value)" placeholder="John Olawale Doe" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" id="email" value="${personal.email}" onchange="updateData('personal', 'email', event.target.value)" placeholder="john.doe@example.com" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                    </div>
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" id="phone" value="${personal.phone}" onchange="updateData('personal', 'phone', event.target.value)" placeholder="080 1234 5678" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                    </div>
                    <div class="mb-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Current Residential Address <span class="text-red-500">*</span></label>
                        <input type="text" id="address" value="${personal.address}" onchange="updateData('personal', 'address', event.target.value)" placeholder="No. 12, Iba Road, Ojo, Lagos" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                    </div>
                    <div class="mb-6">
                        <label for="isIndigene" class="block text-sm font-medium text-gray-700 mb-1">Are you an indigene of Iba Town? <span class="text-red-500">*</span></label>
                        <select id="isIndigene" value="${personal.isIndigene}" onchange="updateData('personal', 'isIndigene', event.target.value); renderStep();" required class="w-full px-4 py-3 border border-gray-300 rounded-lg appearance-none bg-white focus:ring-primary focus:border-primary transition duration-150">
                            <option value="No" ${personal.isIndigene === 'No' ? 'selected' : ''}>--- Select Status ---</option>
                            <option value="Yes" ${personal.isIndigene === 'Yes' ? 'selected' : ''}>Yes, I am an Iba Indigene</option>
                            <option value="Pending" ${personal.isIndigene === 'Pending' ? 'selected' : ''}>Verification Pending</option>
                        </select>
                    </div>

                    ${statusHtml}

                    <div class="flex justify-end mt-8">
                        <button
                            type="button"
                            onclick="validateStep(1) && nextStep()"
                            class="bg-primary text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-secondary transition duration-300 ${!isFormValid ? 'opacity-50 cursor-not-allowed' : ''}"
                            ${!isFormValid ? 'disabled' : ''}
                        >
                            Next Step (Academic) &rarr;
                        </button>
                    </div>
                </form>
            `;
        }

        function getStep2HTML() {
            const academic = state.data.academic;
            const isScoreValid = academic.jambScore >= 180;
            const isFormValid = academic.jambScore > 100 && academic.waecGceYear && academic.institution && isScoreValid;

            let statusHtml = '';
            if (academic.jambScore > 0 && academic.jambScore < 180) {
                statusHtml = `<div class="p-4 rounded-lg font-medium mb-4 text-sm bg-red-50 text-red-700 border border-red-300">
                    Your JAMB score must be 180 or above to proceed with the application.
                </div>`;
            }

            return `
                <form id="step2-form">
                    <h2 class="text-2xl font-extrabold text-primary mb-6">2. Academic Information</h2>

                    <div class="mb-6">
                        <label for="jambScore" class="block text-sm font-medium text-gray-700 mb-1">JAMB Score (Minimum 180 required) <span class="text-red-500">*</span></label>
                        <input type="number" id="jambScore" value="${academic.jambScore || ''}" onchange="updateData('academic', 'jambScore', parseInt(event.target.value) || 0); renderStep();" placeholder="280" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" min="0" />
                    </div>
                    <div class="mb-6">
                        <label for="waecGceYear" class="block text-sm font-medium text-gray-700 mb-1">WAEC/GCE Exam Year <span class="text-red-500">*</span></label>
                        <input type="text" id="waecGceYear" value="${academic.waecGceYear}" onchange="updateData('academic', 'waecGceYear', event.target.value)" placeholder="2023" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                    </div>
                    <div class="mb-6">
                        <label for="institution" class="block text-sm font-medium text-gray-700 mb-1">Intended/Current Institution <span class="text-red-500">*</span></label>
                        <input type="text" id="institution" value="${academic.institution}" onchange="updateData('academic', 'institution', event.target.value)" placeholder="University of Lagos (UNILAG)" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                    </div>
                    <div class="mb-6">
                        <label for="course" class="block text-sm font-medium text-gray-700 mb-1">Course of Study <span class="text-red-500">*</span></label>
                        <input type="text" id="course" value="${academic.course}" onchange="updateData('academic', 'course', event.target.value)" placeholder="Medicine and Surgery" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                    </div>
                    <div class="mb-6">
                        <label for="admissionStatus" class="block text-sm font-medium text-gray-700 mb-1">Current Admission Status <span class="text-red-500">*</span></label>
                        <select id="admissionStatus" value="${academic.admissionStatus}" onchange="updateData('academic', 'admissionStatus', event.target.value)" required class="w-full px-4 py-3 border border-gray-300 rounded-lg appearance-none bg-white focus:ring-primary focus:border-primary transition duration-150">
                            <option value="Awaiting" ${academic.admissionStatus === 'Awaiting' ? 'selected' : ''}>Awaiting Admission</option>
                            <option value="Provisional" ${academic.admissionStatus === 'Provisional' ? 'selected' : ''}>Provisional Admission Received</option>
                            <option value="Matriculated" ${academic.admissionStatus === 'Matriculated' ? 'selected' : ''}>Matriculated (Current Student)</option>
                        </select>
                    </div>

                    ${statusHtml}

                    <div class="flex justify-between mt-8">
                        <button
                            type="button"
                            onclick="prevStep()"
                            class="border border-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300"
                        >
                            &larr; Previous
                        </button>
                        <button
                            type="button"
                            onclick="validateStep(2) && nextStep()"
                            class="bg-primary text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-secondary transition duration-300 ${!isFormValid ? 'opacity-50 cursor-not-allowed' : ''}"
                            ${!isFormValid ? 'disabled' : ''}
                        >
                            Next Step (Documents) &rarr;
                        </button>
                    </div>
                </form>
            `;
        }

        function getStep3HTML() {
            const docs = state.data.documents;
            const isFormValid = docs.jambResult && docs.waecResult && docs.indigeneCert;

            const getFileName = (file) => file ? file.name : 'No file selected';

            return `
                <form id="step3-form" onsubmit="event.preventDefault(); handleSubmit();">
                    <h2 class="text-2xl font-extrabold text-primary mb-6">3. Document Upload</h2>

                    <p class="text-gray-600 mb-6 text-sm">
                        Please upload clear copies of the following documents. Max file size: 5MB per file. Accepted formats: PDF, JPG, PNG.
                    </p>

                    <div class="mb-6 border border-dashed border-gray-400 p-6 rounded-lg hover:border-primary transition duration-200">
                        <label for="jambResult" class="block text-sm font-medium text-gray-700 mb-2 cursor-pointer">
                            JAMB Result Slip <span class="text-red-500">*</span>
                        </label>
                        <input type="file" id="jambResult" onchange="updateFile('documents', 'jambResult', event.target.files[0])" required accept=".pdf,image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary" />
                        <p class="mt-2 text-xs text-gray-500">Uploaded: <span class="font-semibold">${getFileName(docs.jambResult)}</span></p>
                    </div>

                    <div class="mb-6 border border-dashed border-gray-400 p-6 rounded-lg hover:border-primary transition duration-200">
                        <label for="waecResult" class="block text-sm font-medium text-gray-700 mb-2 cursor-pointer">
                            WAEC/GCE Result Certificate <span class="text-red-500">*</span>
                        </label>
                        <input type="file" id="waecResult" onchange="updateFile('documents', 'waecResult', event.target.files[0])" required accept=".pdf,image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary" />
                        <p class="mt-2 text-xs text-gray-500">Uploaded: <span class="font-semibold">${getFileName(docs.waecResult)}</span></p>
                    </div>

                    <div class="mb-6 border border-dashed border-gray-400 p-6 rounded-lg hover:border-primary transition duration-200">
                        <label for="indigeneCert" class="block text-sm font-medium text-gray-700 mb-2 cursor-pointer">
                            Indigeneship/Local Government Identification Letter <span class="text-red-500">*</span>
                        </label>
                        <input type="file" id="indigeneCert" onchange="updateFile('documents', 'indigeneCert', event.target.files[0])" required accept=".pdf,image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary" />
                        <p class="mt-2 text-xs text-gray-500">Uploaded: <span class="font-semibold">${getFileName(docs.indigeneCert)}</span></p>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg mt-8 text-sm text-gray-700">
                        <p class="font-semibold mb-2">Review Confirmation</p>
                        <div class="flex items-center">
                            <input type="checkbox" id="declaration" required class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary mr-2" />
                            <label for="declaration">I confirm that all information provided is true and accurate, and all documents are genuine.</label>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button
                            type="button"
                            onclick="prevStep()"
                            class="border border-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300"
                        >
                            &larr; Previous
                        </button>
                        <button
                            type="submit"
                            id="submit-button"
                            class="bg-primary text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-secondary transition duration-300 ${!isFormValid || state.isLoading ? 'opacity-50 cursor-not-allowed' : ''} flex items-center justify-center"
                            ${!isFormValid || state.isLoading ? 'disabled' : ''}
                        >
                            ${state.isLoading ?
                                `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 border-2 rounded-full spinner" viewBox="0 0 24 24"></svg> Submitting...` :
                                'Submit Application'}
                        </button>
                    </div>
                </form>
            `;
        }

        function getReviewHTML() {
            return `
                <div class="text-center py-12">
                    <h2 class="text-3xl font-extrabold text-green-700 mb-4">Application Complete!</h2>
                    <p class="text-lg text-gray-600">
                        Thank you for your submission. Your application is now under review.
                    </p>
                    <p class="mt-4 text-sm text-gray-500">
                        You can track your status on the Scholar Dashboard.
                    </p>
                    <button
                        type="button"
                        onclick="resetForm()"
                        class="mt-8 bg-gray-200 text-gray-800 px-8 py-3 rounded-full font-semibold hover:bg-gray-300 transition duration-300"
                    >
                        Start New Application
                    </button>
                </div>
            `;
        }

        /** Main function to render the current step */
        function renderStep() {
            const container = document.getElementById('form-content-container');
            updateProgress();

            switch (state.step) {
                case 1:
                    container.innerHTML = getStep1HTML();
                    break;
                case 2:
                    container.innerHTML = getStep2HTML();
                    break;
                case 3:
                    container.innerHTML = getStep3HTML();
                    break;
                case 4:
                    container.innerHTML = getReviewHTML();
                    break;
                default:
                    container.innerHTML = '';
            }
        }

        // --- Data Handling & Validation ---

        // Expose to global scope for inline handlers
        window.updateData = (section, field, value) => {
            if (section === 'academic' && field === 'jambScore') {
                state.data.academic.jambScore = parseInt(value) || 0;
            } else {
                state.data[section][field] = value;
            }
            // Re-render to update validation state if needed (e.g., eligibility message)
            if (section === 'personal' && field === 'isIndigene') {
                renderStep();
            }
            if (section === 'academic' && field === 'jambScore') {
                renderStep();
            }
        };

        // Expose to global scope for file input handlers
        window.updateFile = (section, field, file) => {
            state.data[section][field] = file;
            // Re-render step 3 to show file name and update submit button state
            renderStep();
        };

        function validateStep(step) {
            const data = state.data;
            if (step === 1) {
                const p = data.personal;
                const isEligible = p.isIndigene === 'Yes' || p.isIndigene === 'Pending';
                return p.fullName && p.email && p.phone && isEligible;
            } else if (step === 2) {
                const a = data.academic;
                return a.jambScore >= 180 && a.waecGceYear && a.institution;
            }
            // Step 3 validation is handled by the form's 'disabled' state and required checkbox
            return true;
        }

        function resetForm() {
            state.step = 1;
            state.data = {
                personal: { fullName: '', email: '', phone: '', address: '', isIndigene: 'No' },
                academic: { jambScore: 0, waecGceYear: '', institution: '', course: '', admissionStatus: 'Awaiting' },
                documents: { jambResult: null, waecResult: null, indigeneCert: null },
            };
            renderStatusMessage('');
            renderStep();
        }

        // Expose to global scope
        window.nextStep = nextStep;
        window.prevStep = prevStep;
        window.resetForm = resetForm;
        window.validateStep = validateStep;




        // --- SUBMISSION HANDLER ---

        window.handleSubmit = async () => {
            if (!validateStep(3)) return;

            state.isLoading = true;
            renderStep(); // Update button to show loading state
            renderStatusMessage(null);

            try {
                // Prepare FormData for submission
                const formData = new FormData();
                formData.append('fullName', state.data.personal.fullName);
                formData.append('email', state.data.personal.email);
                formData.append('phone', state.data.personal.phone);
                formData.append('address', state.data.personal.address);
                formData.append('isIndigene', state.data.personal.isIndigene);
                formData.append('jambScore', state.data.academic.jambScore);
                formData.append('waecGceYear', state.data.academic.waecGceYear);
                formData.append('institution', state.data.academic.institution);
                formData.append('course', state.data.academic.course);
                formData.append('admissionStatus', state.data.academic.admissionStatus);
                formData.append('jambResult', state.data.documents.jambResult);
                formData.append('waecResult', state.data.documents.waecResult);
                formData.append('indigeneCert', state.data.documents.indigeneCert);

                // CSRF token for Laravel
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (csrfToken) {
                    formData.append('_token', csrfToken);
                }

                const response = await fetch('/apply-form', {
                    method: 'POST',
                    body: formData,
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    renderStatusMessage(`Application submitted successfully! Application ID: ${result.application_id}`, 'success');
                    setTimeout(() => {
                        state.isLoading = false;
                        state.step = 4; // Move to success screen
                        renderStep();
                    }, 2000);
                } else {
                    throw new Error(result.message || 'Submission failed');
                }

            } catch (error) {
                console.error("Error submitting application:", error);
                renderStatusMessage(`Submission failed: ${error.message}. Please check your connection and try again.`, 'error');
                state.isLoading = false;
                renderStep();
            }
        };


        // --- Application Start ---
        window.onload = () => {
            renderStep();
        };
    </script>
</body>
</html>
