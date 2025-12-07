<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Consent Popup - OA Scholarship</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-8">
        <div class="max-w-2xl w-full bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Consent Popup Test Page</h1>
            
            <div class="space-y-4">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                    <p class="text-sm text-blue-800">
                        <strong>Current Status:</strong> 
                        <span id="consent-status">Checking...</span>
                    </p>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                    <p class="text-sm text-yellow-800">
                        <strong>Popup Behavior:</strong> The consent popup will automatically show if you haven't accepted the terms yet.
                    </p>
                </div>

                <div class="space-y-3">
                    <button onclick="showPopup()" class="w-full bg-black text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-800 transition-colors">
                        <i class="fas fa-eye mr-2"></i>
                        Force Show Popup
                    </button>

                    <button onclick="clearConsent()" class="w-full bg-red-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-red-700 transition-colors">
                        <i class="fas fa-trash mr-2"></i>
                        Clear Consent & Reload
                    </button>

                    <button onclick="checkStatus()" class="w-full bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-sync mr-2"></i>
                        Check Consent Status
                    </button>

                    <a href="{{ route('home') }}" class="block w-full bg-gray-200 text-gray-700 font-bold py-3 px-6 rounded-lg hover:bg-gray-300 transition-colors text-center">
                        <i class="fas fa-home mr-2"></i>
                        Go to Home Page
                    </a>
                </div>

                <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Debug Information:</h3>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p><strong>localStorage.consent_given:</strong> <code id="ls-consent"></code></p>
                        <p><strong>localStorage.consent_timestamp:</strong> <code id="ls-timestamp"></code></p>
                        <p><strong>Session ID:</strong> <code>{{ session()->getId() }}</code></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Consent Popup -->
    @include('components.consent-popup')

    <script>
        function updateStatus() {
            const consentGiven = localStorage.getItem('consent_given');
            const timestamp = localStorage.getItem('consent_timestamp');
            
            document.getElementById('ls-consent').textContent = consentGiven || 'null';
            document.getElementById('ls-timestamp').textContent = timestamp || 'null';
            
            const statusEl = document.getElementById('consent-status');
            if (consentGiven === 'true') {
                statusEl.innerHTML = '<span class="text-green-600 font-semibold">✓ Consent Given</span>';
            } else {
                statusEl.innerHTML = '<span class="text-red-600 font-semibold">✗ No Consent</span>';
            }
        }

        function showPopup() {
            const popup = document.getElementById('consent-popup');
            const body = document.body;
            
            if (!popup) {
                alert('Popup element not found!');
                return;
            }

            popup.classList.add('show');
            body.classList.add('consent-popup-open');
            
            setTimeout(() => {
                popup.classList.add('slide-up');
            }, 100);
        }

        function clearConsent() {
            localStorage.removeItem('consent_given');
            localStorage.removeItem('consent_timestamp');
            alert('Consent cleared! Reloading page...');
            location.reload();
        }

        async function checkStatus() {
            updateStatus();
            
            try {
                const response = await fetch('{{ route("consent.check") }}');
                const data = await response.json();
                
                alert('Backend Status: ' + (data.has_consent ? 'Consent Recorded' : 'No Consent'));
            } catch (error) {
                console.error('Error checking consent:', error);
                alert('Error checking backend status');
            }
        }

        // Update status on page load
        updateStatus();

        // Update status when popup is closed
        setInterval(updateStatus, 1000);
    </script>
</body>
</html>
