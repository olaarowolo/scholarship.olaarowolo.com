<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <style>
            /* Reset and base styles */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #ffffff;
                color: #333333;
            }

            .content {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            header, footer {
                background-color: #f8f9fa;
                padding: 10px 20px;
                text-align: center;
                border-bottom: 1px solid #e0e0e0;
            }

            footer {
                border-top: 1px solid #e0e0e0;
            }

            a {
                color: #007bff;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Welcome to Guest Layout</h1>
        </header>
        <div class="content">
            {{ $slot }}
        </div>
        <footer>
            <p>&copy; 2023 Your Application. All rights reserved.</p>
        </footer>
    </body>
</html>
