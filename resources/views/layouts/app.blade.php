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
    @php
        $pageDescriptions = [
            'home' =>
                'OA Foundation Scholarship for Iba Town\'s brightest students. Financial support and mentorship for university education. Apply now for the 2026 UTME Scholarship.',
            'apply' =>
                'Apply for the OA Foundation Scholarship - Financial aid and mentorship support for Iba indigenes pursuing university education. Check eligibility and submit your application.',
            'how-it-works' =>
                'Learn how the OA Foundation Scholarship application process works. From eligibility criteria to selection, understand each step of your journey to receiving support.',
            'resources' =>
                'Access study guides, JAMB prep materials, and promotional assets for the OA Foundation Scholarship. Download flyers, social media kits, and application resources.',
            'testimonials' =>
                'Read success stories from OA Foundation Scholarship beneficiaries. Discover how the scholarship has transformed lives and enabled academic excellence.',
            'our-story' =>
                'Learn about the OA Foundation\'s mission to empower Iba Town\'s brightest minds through education. Discover our vision, values, and commitment to academic excellence.',
            'contact' =>
                'Get in touch with the OA Foundation Scholarship team. Have questions about eligibility, application process, or scholarship benefits? Contact us today.',
            'terms' =>
                'Terms and Conditions for the OA Foundation Scholarship. Read the complete terms of service, privacy policy, and legal agreements.',
            'privacy' =>
                'Privacy Policy for OA Foundation Scholarship Portal. Learn how we collect, use, and protect your personal information and application data.',
            'press' =>
                'Latest news and press releases from OA Foundation. Media coverage, announcements, and updates about scholarship programs and beneficiaries.',
            'sponsor-information' =>
                'Information for sponsors and partners of OA Foundation. Learn how to support education and empower Iba Town\'s youth through scholarship sponsorship.',
        ];

        $currentPath = request()->path();
        $currentRoute = request()->route() ? request()->route()->getName() : null;

        // Determine page key
        $pageKey = 'home';
        if (str_contains($currentPath, 'apply')) {
            $pageKey = 'apply';
        } elseif (str_contains($currentPath, 'how-it-works')) {
            $pageKey = 'how-it-works';
        } elseif (str_contains($currentPath, 'resources')) {
            $pageKey = 'resources';
        } elseif (str_contains($currentPath, 'testimonials')) {
            $pageKey = 'testimonials';
        } elseif (str_contains($currentPath, 'our-story')) {
            $pageKey = 'our-story';
        } elseif (str_contains($currentPath, 'contact')) {
            $pageKey = 'contact';
        } elseif (str_contains($currentPath, 'terms')) {
            $pageKey = 'terms';
        } elseif (str_contains($currentPath, 'privacy')) {
            $pageKey = 'privacy';
        } elseif (str_contains($currentPath, 'press')) {
            $pageKey = 'press';
        } elseif (str_contains($currentPath, 'sponsor')) {
            $pageKey = 'sponsor-information';
        }

        $metaDescription = $pageDescriptions[$pageKey] ?? $pageDescriptions['home'];
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords"
        content="Scholarship, OA Foundation Scholarship, Financial Aid, Education Support, University Scholarship, Academic Excellence, Iba Town, UTME Scholarship, JAMB Scholarship">
    <meta name="author" content="OA Foundation Scholarship Foundation">

    <!-- Open Graph Meta Tags (Optimized for WhatsApp Sharing) -->
    @php
        $ogTitles = [
            'home' => 'OA Foundation Scholarship - Empowering Iba Town\'s Brightest',
            'apply' => '2026 UTME Scholarship Application - OA Foundation',
            'how-it-works' => 'How the Scholarship Process Works - OA Foundation',
            'resources' => 'Scholarship Resources & Study Materials - OA Foundation',
            'testimonials' => 'Success Stories & Testimonials - OA Foundation Scholars',
            'our-story' => 'Our Story & Mission - OA Foundation',
            'contact' => 'Contact Us - OA Foundation Scholarship',
        ];
        $ogTitle = $ogTitles[$pageKey] ?? $ogTitles['home'];
    @endphp
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
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

        {{-- Admin menu (visible to admin users) --}}
        @if(auth()->check() && auth()->user()->role === 'admin')
            <style>
                @media (max-width: 640px) {
                    main { padding-top: 0.5rem; }
                }
            </style>
        @endif

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
