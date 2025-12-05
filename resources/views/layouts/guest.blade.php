<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OA Scholarships') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN (fallback) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#000000',
                        'secondary': '#333333',
                    }
                }
            }
        }
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) <style>
        :root {
            --primary: #000000;
            --secondary: #333333;
            --background: #f8f8f8;
            --text-dark: #1f2937;
            --text-light: #ffffff;
            --accent: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 480px;
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Input styling */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            transition: all 0.2s ease;
            font-size: 16px;
            /* Prevents zoom on mobile */
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1) !important;
        }

        /* Checkbox styling */
        input[type="checkbox"] {
            cursor: pointer;
        }

        input[type="checkbox"]:checked {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        /* Button styling */
        button {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        button:hover {
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(0);
        }

        /* Link styling */
        a {
            cursor: pointer;
            text-decoration: none;
        }

        /* Ensure proper text color inheritance */
        .text-gray-900 {
            color: #111827 !important;
        }

        .text-gray-700 {
            color: #374151 !important;
        }

        .text-gray-600 {
            color: #4b5563 !important;
        }

        .text-gray-500 {
            color: #6b7280 !important;
        }

        .text-gray-400 {
            color: #9ca3af !important;
        }

        .text-white {
            color: #ffffff !important;
        }

        .bg-white {
            background-color: #ffffff !important;
        }

        .bg-black {
            background-color: #000000 !important;
        }

        .bg-gray-50 {
            background-color: #f9fafb !important;
        }

        .bg-gray-800 {
            background-color: #1f2937 !important;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        {{ $slot }}
    </div>
</body>

</html>
