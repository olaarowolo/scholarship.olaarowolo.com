<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- TITLE and Favicon -->
    <title>OA Foundation & Local Scholarship Portal</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon_io/site.webmanifest') }}">

    <!-- Optimized Meta Tags for SEO and WhatsApp -->
    <meta name="description"
        content="Apply for the OA Foundation & Scholarship to achieve your educational dreams. Check eligibility, required documents, and the application process.">
    <meta name="keywords"
        content="Scholarship, OA Foundation & Scholarship, Financial Aid, Education Support, University Scholarship, Academic Excellence">
    <meta name="author" content="OA Foundation & Scholarship Foundation">

    <!-- Open Graph Meta Tags (Optimized for WhatsApp Sharing) -->
    <meta property="og:title" content="Apply for the OA Foundation & Scholarship">
    <meta property="og:description"
        content="Achieve your educational dreams with the OA Foundation & Scholarship. Learn about eligibility, required documents, and the application process.">
    @php
        $isApplyPage = request()->is('apply') || request()->is('apply-form') || request()->is('apply-utme-jamb-form');
        $socialImage = $isApplyPage
            ? url('assets/img/2026_UTME_Scholarship_Application_for_Iba_Indigenes -  Web Open.jpg')
            : url('assets/img/favicon/olaarowolo.com_logo_black.png');
        $imageType = $isApplyPage ? 'image/jpeg' : 'image/png';
        $imageWidth = $isApplyPage ? '1200' : '512';
        $imageHeight = $isApplyPage ? '630' : '512';
        $imageAlt = $isApplyPage
            ? 'OA Foundation & Scholarship - 2026 UTME Scholarship Application for Iba Indigenes'
            : 'OA Foundation & Scholarship Logo';
    @endphp
    <meta property="og:image" content="{{ $socialImage }}">
    <meta property="og:image:secure_url" content="{{ $socialImage }}">
    <meta property="og:image:type" content="{{ $imageType }}">
    <meta property="og:image:width" content="{{ $imageWidth }}">
    <meta property="og:image:height" content="{{ $imageHeight }}">
    <meta property="og:image:alt" content="{{ $imageAlt }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="olaarowolo.com">
    <meta property="twitter:url" content="https://www.olaarowolo.com/">
    <meta name="twitter:title" content="Apply for the OA Foundation & Scholarship">
    <meta name="twitter:description"
        content="Achieve your educational dreams with the OA Foundation & Scholarship. Learn about eligibility, required documents, and the application process.">
    <meta name="twitter:image" content="{{ $socialImage }}">
    <meta name="twitter:image:alt" content="{{ $imageAlt }}">

    <!-- WhatsApp Optimization -->
    <meta property="og:site_name" content="OA Foundation & Scholarship">
    <meta property="og:locale" content="en_US">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2367QRTG56"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-2367QRTG56');
    </script>

    @vite('resources/css/app.css')
</head>

<body class="text-gray-900 font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{-- @include('layouts.navigation') --}}

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
            {{ $slot ?? '' }}
        </main>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Consent Popup -->
    @include('components.consent-popup')

    @vite('resources/js/app.js')
</body>

</html>
