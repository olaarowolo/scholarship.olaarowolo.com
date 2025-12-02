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
    <title>OA Local Scholarship</title>
    <link rel="apple-touch-icon" sizes="180x180" href="https://scholarship.olaarowolo.com/assets/img/favicon/olaarowolo.com_logo_black.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://scholarship.olaarowolo.com/assets/img/favicon/olaarowolo.com_logo_black.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://scholarship.olaarowolo.com/assets/img/favicon/olaarowolo.com_logo_black.png">

    <!-- HTML Meta Tags -->
    <title>OA Local Scholarship</title>
    <meta name="description" content="High-level experience in nuclear safety analysis and multinational nuclear project development.">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://www.olaarowolo.com/scholarship">
    <meta property="og:type" content="website">
    <meta property="og:title" content="OA Local Scholarship">
    <meta property="og:description" content="Explore the professional profile of Olasunkanmi Arowolo, a Lecturer in Journalism, Media & Development Communication Expert, and enthusiastic DevOps. Discover his academic achievements, creative skills, publications, and contact information. Connect with Ola to bring ideas to life.">
    <meta property="og:image" content="{{ asset('assets/favicon_io/oa-logo-yellow-bgrd-480x480.png') }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="olaarowolo.com">
    <meta property="twitter:url" content="https://www.olaarowolo.com/">
    <meta name="twitter:title" content="Ola Arowolo's Portfolio ðŸ‘‹">
    <meta name="twitter:description" content="Explore the professional profile of Olasunkanmi Arowolo, a Lecturer in Journalism, Media & Development Communication Expert, and enthusiastic DevOps. Discover his academic achievements, creative skills, publications, and contact information. Connect with Ola to bring ideas to life.">
    <meta name="twitter:image" content="{{ asset('assets/favicon_io/oa-logo-yellow-bgrd-480x480.png') }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2367QRTG56"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-2367QRTG56');
    </script>

    @vite('resources/css/app.css')
</head>

<body class="text-gray-900">
    @yield('content')

    @vite('resources/js/app.js')
</body>

</html>
