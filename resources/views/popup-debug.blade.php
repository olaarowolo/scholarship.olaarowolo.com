<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Consent Popup Debug</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .debug-panel {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            margin: 0 auto;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            margin: 5px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .status-box {
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-family: monospace;
        }

        .status-info {
            background: #dbeafe;
            border-left: 4px solid #3b82f6;
        }

        .status-success {
            background: #d1fae5;
            border-left: 4px solid #10b981;
        }

        .status-error {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
        }
    </style>
</head>

<body>
    <div class="debug-panel">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 20px; color: #1f2937;">
            <i class="fas fa-bug"></i> Consent Popup Debug Tool
        </h1>

        <div style="margin-bottom: 30px;">
            <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 15px;">Quick Actions</h2>
            <button onclick="forceShowPopup()" class="btn btn-primary">
                <i class="fas fa-eye"></i> Force Show Popup
            </button>
            <button onclick="clearConsent()" class="btn btn-danger">
                <i class="fas fa-trash"></i> Clear Consent & Reload
            </button>
            <button onclick="checkStatus()" class="btn btn-success">
                <i class="fas fa-check-circle"></i> Check Status
            </button>
        </div>

        <div id="status-display" class="status-box status-info">
            <strong>Status:</strong> Ready for testing
        </div>

        <div style="margin-top: 30px;">
            <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 15px;">Debug Information</h2>
            <div
                style="background: #f9fafb; padding: 15px; border-radius: 8px; font-family: monospace; font-size: 14px;">
                <div><strong>Session ID:</strong> <span id="session-id">{{ session()->getId() }}</span></div>
                <div><strong>Consent Given:</strong> <span id="consent-status">Checking...</span></div>
                <div><strong>Timestamp:</strong> <span id="consent-time">N/A</span></div>
                <div><strong>Popup Element:</strong> <span id="popup-exists">Checking...</span></div>
                <div><strong>Page Load Time:</strong> <span id="load-time">{{ now() }}</span></div>
            </div>
        </div>

        <div
            style="margin-top: 20px; padding: 15px; background: #fffbeb; border-radius: 8px; border-left: 4px solid #f59e0b;">
            <strong>Instructions:</strong>
            <ul style="margin: 10px 0 0 20px; line-height: 1.8;">
                <li>Open browser console (F12) to see detailed logs</li>
                <li>Click "Force Show Popup" to manually trigger the popup</li>
                <li>Click "Clear Consent & Reload" to reset and test fresh visit</li>
                <li>Check console for messages starting with "===" for debug info</li>
            </ul>
        </div>
    </div>

    <!-- Include Consent Popup -->
    @include('components.consent-popup')

    <script>
        // Update status on page load
        window.addEventListener('load', function() {
            updateStatus();

            // Check if popup element exists
            const popup = document.getElementById('consent-popup');
            document.getElementById('popup-exists').textContent = popup ? '✅ Found' : '❌ Not Found';
            document.getElementById('popup-exists').style.color = popup ? 'green' : 'red';

            console.log('=== DEBUG PAGE LOADED ===');
            console.log('Popup element:', popup);
            if (popup) {
                console.log('Popup HTML structure:', popup.innerHTML.substring(0, 200) + '...');
                console.log('Popup computed styles:', {
                    display: window.getComputedStyle(popup).display,
                    visibility: window.getComputedStyle(popup).visibility,
                    zIndex: window.getComputedStyle(popup).zIndex,
                    position: window.getComputedStyle(popup).position
                });
            }
        });

        function updateStatus() {
            const consentGiven = localStorage.getItem('consent_given');
            const consentTime = localStorage.getItem('consent_timestamp');

            document.getElementById('consent-status').textContent = consentGiven === 'true' ? '✅ Yes' : '❌ No';
            document.getElementById('consent-status').style.color = consentGiven === 'true' ? 'green' : 'red';
            document.getElementById('consent-time').textContent = consentTime || 'N/A';
        }

        function forceShowPopup() {
            console.log('=== FORCE SHOWING POPUP ===');
            const popup = document.getElementById('consent-popup');
            if (!popup) {
                alert('❌ Popup element not found!');
                return;
            }

            popup.classList.remove('hidden');
            popup.classList.add('show');
            popup.style.display = 'block';
            document.body.classList.add('consent-popup-open');

            console.log('Popup forced visible with classes:', popup.className);
            document.getElementById('status-display').innerHTML =
                '<strong>Status:</strong> Popup forced to show - check if visible!';
            document.getElementById('status-display').className = 'status-box status-success';
        }

        function clearConsent() {
            localStorage.removeItem('consent_given');
            localStorage.removeItem('consent_timestamp');
            console.log('Consent cleared, reloading...');
            location.reload();
        }

        function checkStatus() {
            updateStatus();
            const consentGiven = localStorage.getItem('consent_given') === 'true';
            const msg = consentGiven ?
                '<strong>Status:</strong> ✅ Consent has been given' :
                '<strong>Status:</strong> ❌ Consent NOT given - popup should show';
            document.getElementById('status-display').innerHTML = msg;
            document.getElementById('status-display').className = 'status-box ' + (consentGiven ? 'status-success' :
                'status-info');
        }
    </script>
</body>

</html>
