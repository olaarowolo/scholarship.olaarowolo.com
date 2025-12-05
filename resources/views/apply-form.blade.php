<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OA Scholarship Application</title>
    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
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
                <a href="{{ url('/') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Go Back Home
                </a>
            </div>

            <!-- Step Progress Bar -->
            <div class="mb-10" id="progress-container">
                <div class="flex justify-between mb-2 text-sm font-medium text-gray-700">
                    <span id="step-info">Screening</span>
                    <span id="progress-percent">0% Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div id="progress-bar" class="bg-primary h-2.5 rounded-full transition-all duration-500 ease-in-out"
                        style="width: 0%;"></div>
                </div>
                <div class="flex justify-between mt-1 text-xs text-gray-500">
                    <span id="step-label-0" class="font-semibold text-primary">Screening</span>
                    <span id="step-label-1">Personal</span>
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
            // Global State - v2.0 (JAMB Screening Added)
            const state = {
                step: 0, // Start at step 0 for JAMB screening
                isAuthReady: false,
                userId: null,
                db: null,
                auth: null,
                submissionStatus: null,
                isLoading: false,
                data: {
                    screening: {
                        hasTakenJamb: '', // 'Yes' or 'No'
                        needsJambSupport: '', // 'Yes' or 'No' (only if hasTakenJamb is 'No')
                    },
                    personal: {
                        firstName: '',
                        lastName: '',
                        dateOfBirth: '',
                        email: '',
                        phone: '',
                        address: '',
                        lga: '',
                        town: '',
                        isIndigene: 'No',
                    },
                    academic: {
                        jambRegNumber: '',
                        jambScore: 0,
                        waecGceYear: '',
                        institution: '',
                        course: '',
                        admissionStatus: 'Awaiting',
                    },
                    documents: {
                        jambResult: null, // Stores File object
                        waecResult: null, // Stores File object (or academic performance if no JAMB)
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
                const progressContainer = document.getElementById('progress-container');

                // Always show progress bar now that screening is step 0
                progressContainer.style.display = 'block';

                // Calculate progress based on 5 main steps (0-4) before success screen (5)
                const totalSteps = 5; // Screening, Personal, Academic, Documents, Review
                const progress = step >= 5 ? 100 : Math.min(100, (step / totalSteps) * 100);

                // Step labels
                const stepLabels = ['Screening', 'Personal Info', 'Academic Info', 'Documents', 'Review'];
                const stepText = step >= 5 ? 'Complete' : stepLabels[step] || 'Step ' + step;

                document.getElementById('step-info').textContent = stepText;
                document.getElementById('progress-percent').textContent = `${progress.toFixed(0)}% Complete`;
                document.getElementById('progress-bar').style.width = `${progress}%`;

                // Update step label styling (0-4)
                for (let i = 0; i <= 4; i++) {
                    const label = document.getElementById(`step-label-${i}`);
                    if (label) {
                        label.classList.toggle('font-semibold', i <= step);
                        label.classList.toggle('text-primary', i <= step);
                    }
                }
            }

            // --- Navigation Functions ---

            function nextStep() {
                if (state.step < 6) { // Now goes up to 6 (0-6 instead of 1-5)
                    state.step++;
                    renderStep();
                }
            }

            function prevStep() {
                if (state.step > 0) { // Can go back to step 0
                    state.step--;
                    renderStep();
                }
            }

            // --- Step Rendering Functions ---

            function getStep0HTML() {
                console.log('Rendering Step 0 - JAMB Screening');
                const screening = state.data.screening;
                const canProceed = screening.hasTakenJamb === 'Yes' ||
                    (screening.hasTakenJamb === 'No' && screening.needsJambSupport !== '');

                return `
                <div>
                    <h2 class="text-2xl font-extrabold text-primary mb-6">JAMB Status Screening</h2>

                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                        <p class="text-sm text-blue-700">
                            <strong>Important:</strong> We need to understand your JAMB status to process your application appropriately.
                        </p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-800 mb-4">
                            Have you taken JAMB (Joint Admissions and Matriculation Board) examination before?
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all ${screening.hasTakenJamb === 'Yes' ? 'border-primary bg-blue-50' : 'border-gray-300 hover:border-gray-400'}">
                                <input
                                    type="radio"
                                    name="hasTakenJamb"
                                    value="Yes"
                                    ${screening.hasTakenJamb === 'Yes' ? 'checked' : ''}
                                    onchange="updateData('screening', 'hasTakenJamb', 'Yes'); renderStep();"
                                    class="h-5 w-5 text-primary focus:ring-primary"
                                />
                                <span class="ml-3 text-gray-900 font-medium">Yes, I have taken JAMB</span>
                            </label>
                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all ${screening.hasTakenJamb === 'No' ? 'border-primary bg-blue-50' : 'border-gray-300 hover:border-gray-400'}">
                                <input
                                    type="radio"
                                    name="hasTakenJamb"
                                    value="No"
                                    ${screening.hasTakenJamb === 'No' ? 'checked' : ''}
                                    onchange="updateData('screening', 'hasTakenJamb', 'No'); updateData('screening', 'needsJambSupport', ''); renderStep();"
                                    class="h-5 w-5 text-primary focus:ring-primary"
                                />
                                <span class="ml-3 text-gray-900 font-medium">No, I have not taken JAMB</span>
                            </label>
                        </div>
                    </div>

                    ${screening.hasTakenJamb === 'No' ? `
                                                                                        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                                                                            <label class="block text-lg font-semibold text-gray-800 mb-4">
                                                                                                Do you need support to register and prepare for JAMB?
                                                                                                <span class="text-red-500">*</span>
                                                                                            </label>
                                                                                            <div class="space-y-3">
                                                                                                <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all ${screening.needsJambSupport === 'Yes' ? 'border-primary bg-blue-50' : 'border-gray-300 hover:border-gray-400'}">
                                                                                                    <input
                                                                                                        type="radio"
                                                                                                        name="needsJambSupport"
                                                                                                        value="Yes"
                                                                                                        ${screening.needsJambSupport === 'Yes' ? 'checked' : ''}
                                                                                                        onchange="updateData('screening', 'needsJambSupport', 'Yes'); renderStep();"
                                                                                                        class="h-5 w-5 text-primary focus:ring-primary"
                                                                                                    />
                                                                                                    <span class="ml-3 text-gray-900 font-medium">Yes, I need JAMB registration and preparation support</span>
                                                                                                </label>
                                                                                                <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all ${screening.needsJambSupport === 'No' ? 'border-primary bg-blue-50' : 'border-gray-300 hover:border-gray-400'}">
                                                                                                    <input
                                                                                                        type="radio"
                                                                                                        name="needsJambSupport"
                                                                                                        value="No"
                                                                                                        ${screening.needsJambSupport === 'No' ? 'checked' : ''}
                                                                                                        onchange="updateData('screening', 'needsJambSupport', 'No'); renderStep();"
                                                                                                        class="h-5 w-5 text-primary focus:ring-primary"
                                                                                                    />
                                                                                                    <span class="ml-3 text-gray-900 font-medium">No, I will handle JAMB registration myself</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    ` : ''}

                    <div class="flex justify-between mt-8">
                        <a href="{{ url('/') }}" class="border border-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300">
                            &larr; Cancel
                        </a>
                        <button
                            type="button"
                            onclick="nextStep()"
                            class="bg-primary text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-secondary transition duration-300 ${!canProceed ? 'opacity-50 cursor-not-allowed' : ''}"
                            ${!canProceed ? 'disabled' : ''}
                        >
                            Continue to Application &rarr;
                        </button>
                    </div>
                </div>
            `;
            }

            function getStep1HTML() {
                const personal = state.data.personal;
                const isEligible = personal.isIndigene === 'Yes' || personal.isIndigene === 'Pending';
                const isFormValid = personal.firstName && personal.lastName && personal.dateOfBirth &&
                    personal.email && personal.phone && personal.address &&
                    personal.lga && personal.town && isEligible;

                let statusHtml = '';
                if (personal.isIndigene === 'No') {
                    statusHtml = `<div class="p-4 rounded-lg font-medium mb-4 text-sm bg-red-50 text-red-700 border border-red-300">
                    Only indigenes of Iba Town are eligible to apply. Please confirm your status.
                </div>`;
                }

                return `
                <form id="step1-form">
                    <h2 class="text-2xl font-extrabold text-primary mb-6">1. Personal & Contact Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                            <input type="text" id="firstName" value="${personal.firstName}" onchange="updateData('personal', 'firstName', event.target.value)" placeholder="John" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" id="lastName" value="${personal.lastName}" onchange="updateData('personal', 'lastName', event.target.value)" placeholder="Doe" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="dateOfBirth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                        <input type="date" id="dateOfBirth" value="${personal.dateOfBirth}" onchange="updateData('personal', 'dateOfBirth', event.target.value)" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="lga" class="block text-sm font-medium text-gray-700 mb-1">Local Government Area (LGA) <span class="text-red-500">*</span></label>
                            <input type="text" id="lga" value="${personal.lga}" onchange="updateData('personal', 'lga', event.target.value)" placeholder="Ojo" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                        </div>
                        <div>
                            <label for="town" class="block text-sm font-medium text-gray-700 mb-1">Town/City <span class="text-red-500">*</span></label>
                            <input type="text" id="town" value="${personal.town}" onchange="updateData('personal', 'town', event.target.value)" placeholder="Iba" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                        </div>
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
                const screening = state.data.screening;
                const hasTakenJamb = screening.hasTakenJamb === 'Yes';

                // Validation logic changes based on JAMB status
                let isFormValid;
                if (hasTakenJamb) {
                    const isScoreValid = academic.jambScore >= 180;
                    isFormValid = academic.jambRegNumber && academic.jambScore > 100 &&
                        academic.waecGceYear && academic.institution &&
                        academic.course && isScoreValid;
                } else {
                    // No JAMB: only need waec year, institution, and course
                    isFormValid = academic.waecGceYear && academic.institution && academic.course;
                }

                let statusHtml = '';
                if (hasTakenJamb && academic.jambScore > 0 && academic.jambScore < 180) {
                    statusHtml = `<div class="p-4 rounded-lg font-medium mb-4 text-sm bg-red-50 text-red-700 border border-red-300">
                    Your JAMB score must be 180 or above to proceed with the application.
                </div>`;
                }

                return `
                <form id="step2-form">
                    <h2 class="text-2xl font-extrabold text-primary mb-6">2. Academic Information</h2>

                    ${hasTakenJamb ? `
                                                                                        <div class="mb-6">
                                                                                            <label for="jambRegNumber" class="block text-sm font-medium text-gray-700 mb-1">JAMB Registration Number <span class="text-red-500">*</span></label>
                                                                                            <input type="text" id="jambRegNumber" value="${academic.jambRegNumber}" onchange="updateData('academic', 'jambRegNumber', event.target.value)" placeholder="12345678AB" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" />
                                                                                        </div>

                                                                                        <div class="mb-6">
                                                                                            <label for="jambScore" class="block text-sm font-medium text-gray-700 mb-1">JAMB Score (Minimum 180 required) <span class="text-red-500">*</span></label>
                                                                                            <input type="number" id="jambScore" value="${academic.jambScore || ''}" onchange="updateData('academic', 'jambScore', parseInt(event.target.value) || 0); renderStep();" placeholder="280" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition duration-150" min="0" />
                                                                                        </div>
                                                                                    ` : `
                                                                                        <div class="p-4 rounded-lg font-medium mb-6 text-sm bg-blue-50 text-blue-700 border border-blue-300">
                                                                                            <strong>Note:</strong> Since you have not taken JAMB, JAMB score and registration number are not required.
                                                                                            ${screening.needsJambSupport === 'Yes' ? 'We will provide support for your JAMB registration and preparation.' : ''}
                                                                                        </div>
                                                                                    `}

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
                const screening = state.data.screening;
                const hasTakenJamb = screening.hasTakenJamb === 'Yes';
                const isFormValid = docs.jambResult && docs.waecResult && docs.indigeneCert;

                // Update label based on JAMB status
                const jambResultLabel = hasTakenJamb ? 'JAMB Result Slip' : 'Academic Performance Record/Transcript';

                const getFileUploadHTML = (id, label, file, field) => {
                    if (file) {
                        return `
                        <div class="mb-6 border border-green-500 bg-green-50 p-6 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                ${label} <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-gray-700">${file.name}</span>
                                </div>
                                <button
                                    type="button"
                                    onclick="document.getElementById('${id}').click()"
                                    class="text-xs text-primary hover:text-secondary underline"
                                >
                                    Change File
                                </button>
                            </div>
                            <input
                                type="file"
                                id="${id}"
                                onchange="updateFile('documents', '${field}', event.target.files[0])"
                                accept=".pdf,image/*"
                                class="hidden"
                            />
                        </div>
                    `;
                    } else {
                        return `
                        <div class="mb-6 border border-dashed border-gray-400 p-6 rounded-lg hover:border-primary transition duration-200">
                            <label for="${id}" class="block text-sm font-medium text-gray-700 mb-2 cursor-pointer">
                                ${label} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="file"
                                id="${id}"
                                onchange="updateFile('documents', '${field}', event.target.files[0])"
                                accept=".pdf,image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary"
                            />
                            <p class="mt-2 text-xs text-gray-500">Max file size: 5MB. Accepted: PDF, JPG, PNG</p>
                        </div>
                    `;
                    }
                };

                return `
                <form id="step3-form" onsubmit="event.preventDefault(); handleSubmit();">
                    <h2 class="text-2xl font-extrabold text-primary mb-6">3. Document Upload</h2>

                    <p class="text-gray-600 mb-6 text-sm">
                        Please upload clear copies of the following documents. Max file size: 5MB per file. Accepted formats: PDF, JPG, PNG.
                    </p>

                    ${!hasTakenJamb ? `
                                                                                        <div class="p-4 rounded-lg font-medium mb-6 text-sm bg-blue-50 text-blue-700 border border-blue-300">
                                                                                            <strong>Note:</strong> Since you have not taken JAMB, please upload your secondary school academic performance record or transcript instead of JAMB result.
                                                                                        </div>
                                                                                    ` : ''}

                    ${getFileUploadHTML('jambResult', jambResultLabel, docs.jambResult, 'jambResult')}
                    ${getFileUploadHTML('waecResult', 'WAEC/GCE Result Certificate', docs.waecResult, 'waecResult')}
                    ${getFileUploadHTML('indigeneCert', 'Indigeneship/Local Government Identification Letter', docs.indigeneCert, 'indigeneCert')}

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
                            type="button"
                            onclick="nextStep()"
                            id="review-button"
                            class="bg-primary text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-secondary transition duration-300 ${!isFormValid ? 'opacity-50 cursor-not-allowed' : ''}"
                            ${!isFormValid ? 'disabled' : ''}
                        >
                            Review Application &rarr;
                        </button>
                    </div>
                </form>
            `;
            }

            function getStep4HTML() {
                const p = state.data.personal;
                const a = state.data.academic;
                const d = state.data.documents;

                return `
                <div>
                    <h2 class="text-2xl font-extrabold text-primary mb-6">4. Review Your Application</h2>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <p class="text-sm text-yellow-700">
                            <strong>Important:</strong> Please review all information carefully before submitting.
                            You will not be able to edit your application after submission.
                        </p>
                    </div>

                    <!-- Personal Information -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">1</span>
                            Personal Information
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div><span class="font-semibold">First Name:</span> ${p.firstName}</div>
                            <div><span class="font-semibold">Last Name:</span> ${p.lastName}</div>
                            <div><span class="font-semibold">Date of Birth:</span> ${p.dateOfBirth}</div>
                            <div><span class="font-semibold">Email:</span> ${p.email}</div>
                            <div><span class="font-semibold">Phone:</span> ${p.phone}</div>
                            <div><span class="font-semibold">LGA:</span> ${p.lga}</div>
                            <div><span class="font-semibold">Town:</span> ${p.town}</div>
                            <div><span class="font-semibold">Indigene Status:</span> ${p.isIndigene}</div>
                            <div class="md:col-span-2"><span class="font-semibold">Address:</span> ${p.address}</div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">2</span>
                            Academic Information
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div><span class="font-semibold">JAMB Reg Number:</span> ${a.jambRegNumber}</div>
                            <div><span class="font-semibold">JAMB Score:</span> ${a.jambScore}</div>
                            <div><span class="font-semibold">WAEC/GCE Year:</span> ${a.waecGceYear}</div>
                            <div><span class="font-semibold">Institution:</span> ${a.institution}</div>
                            <div><span class="font-semibold">Course:</span> ${a.course}</div>
                            <div class="md:col-span-2"><span class="font-semibold">Admission Status:</span> ${a.admissionStatus}</div>
                        </div>
                    </div>

                    <!-- Documents -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">3</span>
                            Uploaded Documents
                        </h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>JAMB Result:</strong> ${d.jambResult?.name}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>WAEC/GCE Result:</strong> ${d.waecResult?.name}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Indigene Certificate:</strong> ${d.indigeneCert?.name}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg mb-6 text-sm text-gray-700">
                        <div class="flex items-center">
                            <input type="checkbox" id="final-declaration" required class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary mr-2" />
                            <label for="final-declaration">I confirm that all information provided is true and accurate, and all documents are genuine.</label>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button
                            type="button"
                            onclick="prevStep()"
                            class="border border-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300"
                        >
                            &larr; Edit Application
                        </button>
                        <button
                            type="button"
                            onclick="handleSubmit()"
                            id="submit-button"
                            class="bg-primary text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-secondary transition duration-300 ${state.isLoading ? 'opacity-50 cursor-not-allowed' : ''} flex items-center justify-center"
                            ${state.isLoading ? 'disabled' : ''}
                        >
                            ${state.isLoading ?
                                `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 border-2 rounded-full spinner" viewBox="0 0 24 24"></svg> Submitting...` :
                                'Submit Application'}
                        </button>
                    </div>
                </div>
            `;
            }

            function getStep5HTML() {
                return `
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-green-700 mb-4">Application Submitted Successfully!</h2>
                    <p class="text-lg text-gray-600 mb-2">
                        Thank you for your submission. Your application is now under review.
                    </p>
                    <p class="text-sm text-gray-500 mb-8">
                        You will receive updates via email regarding your application status.
                    </p>
                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg max-w-md mx-auto mb-8">
                        <p class="text-sm text-blue-800">
                            <strong>What's Next?</strong><br>
                            Our team will review your application and documents. You'll be notified within 2-4 weeks.
                        </p>
                    </div>
                    <button
                        type="button"
                        onclick="window.location.href='{{ route('home') }}'"
                        class="bg-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-secondary transition duration-300"
                    >
                        Return to Home
                    </button>
                </div>
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
                    case 0:
                        container.innerHTML = getStep0HTML();
                        break;
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
                        container.innerHTML = getStep4HTML();
                        break;
                    case 5:
                        container.innerHTML = getStep5HTML();
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
                    return p.firstName && p.lastName && p.dateOfBirth && p.email && p.phone && p.address && p.lga && p.town &&
                        isEligible;
                } else if (step === 2) {
                    const a = data.academic;
                    const screening = data.screening;
                    const hasTakenJamb = screening.hasTakenJamb === 'Yes';

                    if (hasTakenJamb) {
                        return a.jambRegNumber && a.jambScore >= 180 && a.waecGceYear && a.institution && a.course;
                    } else {
                        // No JAMB required
                        return a.waecGceYear && a.institution && a.course;
                    }
                }
                // Step 3 validation is handled by the form's 'disabled' state and required checkbox
                return true;
            }

            function resetForm() {
                state.step = 0;
                state.data = {
                    screening: {
                        hasTakenJamb: '',
                        needsJambSupport: '',
                    },
                    personal: {
                        firstName: '',
                        lastName: '',
                        dateOfBirth: '',
                        email: '',
                        phone: '',
                        address: '',
                        lga: '',
                        town: '',
                        isIndigene: 'No'
                    },
                    academic: {
                        jambRegNumber: '',
                        jambScore: 0,
                        waecGceYear: '',
                        institution: '',
                        course: '',
                        admissionStatus: 'Awaiting'
                    },
                    documents: {
                        jambResult: null,
                        waecResult: null,
                        indigeneCert: null
                    },
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

                    // Screening data
                    formData.append('hasTakenJamb', state.data.screening.hasTakenJamb);
                    formData.append('needsJambSupport', state.data.screening.needsJambSupport || '');

                    // Personal data
                    formData.append('firstName', state.data.personal.firstName);
                    formData.append('lastName', state.data.personal.lastName);
                    formData.append('dateOfBirth', state.data.personal.dateOfBirth);
                    formData.append('email', state.data.personal.email);
                    formData.append('phone', state.data.personal.phone);
                    formData.append('address', state.data.personal.address);
                    formData.append('lga', state.data.personal.lga);
                    formData.append('town', state.data.personal.town);
                    formData.append('isIndigene', state.data.personal.isIndigene);

                    // Academic data (JAMB fields may be empty)
                    formData.append('jambRegNumber', state.data.academic.jambRegNumber || '');
                    formData.append('jambScore', state.data.academic.jambScore || '');
                    formData.append('waecGceYear', state.data.academic.waecGceYear);
                    formData.append('institution', state.data.academic.institution);
                    formData.append('course', state.data.academic.course);
                    formData.append('admissionStatus', state.data.academic.admissionStatus);

                    // Documents
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

                    // Check if response is JSON
                    const contentType = response.headers.get("content-type");
                    if (!contentType || !contentType.includes("application/json")) {
                        const text = await response.text();
                        console.error("Server returned non-JSON response:", text);
                        console.error("Response status:", response.status);
                        console.error("Response headers:", Object.fromEntries(response.headers));

                        // Check if it's a validation error (422)
                        if (response.status === 422) {
                            throw new Error("Validation error: Please check all fields are filled correctly.");
                        }
                        // Check if it's a server error (500)
                        if (response.status === 500) {
                            throw new Error("Server error: There was a problem processing your application.");
                        }
                        throw new Error(
                            `Server returned ${response.status} status. Please try again or contact support.`);
                    }

                    const result = await response.json();

                    if (response.ok && result.success) {
                        renderStatusMessage(
                            `Application submitted successfully! Application ID: ${result.application_id}`,
                            'success');
                        setTimeout(() => {
                            state.isLoading = false;
                            state.step = 5; // Move to success screen
                            renderStep();
                        }, 2000);
                    } else {
                        throw new Error(result.message || 'Submission failed');
                    }

                } catch (error) {
                    console.error("Error submitting application:", error);
                    renderStatusMessage(
                        `Submission failed: ${error.message}. Please check your connection and try again.`, 'error');
                    state.isLoading = false;
                    renderStep();
                }
            };


            // --- Application Start ---
            window.onload = () => {
                console.log('=== APPLICATION LOADED v2.0 ===');
                console.log('Starting at step:', state.step);
                console.log('Screening data:', state.data.screening);

                // Force clear any cached state
                if (state.step !== 0) {
                    console.warn('Step was not 0, resetting to 0');
                    state.step = 0;
                }

                renderStep();
            };
        </script>
</body>

</html>
