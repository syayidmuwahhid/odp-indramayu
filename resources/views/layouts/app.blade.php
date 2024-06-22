<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="zxx">

<head>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.png') }}" />
    <!-- theme meta -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <input type="hidden" id="baseL" value="{{ url('') }}" />
    <meta name="theme-name" content="Pinwheel" />
    <meta name="msapplication-TileColor" content="#000000" />
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#fff" />
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#000" />
    <meta name="generator" content="gulp" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />

    <!-- title -->
    <title>@yield('title')</title>

    <!-- noindex robots -->
    <meta name="robots" content="" />

    <!-- meta-description -->
    <meta name="description" content="meta description" />

    <!-- author from config.json -->
    <meta name="author" content="{config.metadata.meta_author}" />

    <!-- og-title -->
    <meta property="og:title" content="" />

    <!-- og-description -->
    <meta property="og:description" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="/" />

    <!-- twitter-title -->
    <meta name="twitter:title" content="" />

    <!-- twitter-description -->
    <meta name="twitter:description" content="" />

    <!-- og-image -->
    <meta property="og:image" content="" />

    <!-- twitter-image -->
    <meta name="twitter:image" content="" />
    <meta name="twitter:card" content="summary_large_image" />

    <!-- google font css -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&display=swap" rel="stylesheet" />

    <!-- styles -->

    <!-- Swiper slider -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/swiper/swiper-bundle.css') }}" />

    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/font-awesome/v6/brands.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/font-awesome/v6/solid.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/font-awesome/v6/fontawesome.css') }}" />

    <!-- Main Stylesheet -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>


    @stack('css')
</head>

<header class="header">
    @include('layouts.partials.navbar')
</header>

<body><!-- Banner -->
    @yield('content')

    @include('layouts.partials.footer')

    <!-- jQuery -->
    <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
    <!-- Swiper JS -->
    <script src="{{ asset('assets/js/plugins/swiper/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/shufflejs/shuffle.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/global.js') }}"></script>

    @stack('js')

</body>

</html>
