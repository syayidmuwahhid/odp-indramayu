<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <!-- favicon -->
    <link rel="shortcut icon" href="" id="appIcon"/>
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

    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('') }}">

    <meta property="og:title" content="Your Page Title">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="{{ url('') }}">

    <!-- title -->
    <title>@yield('title')</title>

    <!-- noindex robots -->
    <meta name="robots" content="" />


    <!-- google font css -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&display=swap" rel="stylesheet" />

    <!-- styles -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

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


    <style>
        /* body {
            color: black;
        } */
        #loading-bar-spinner.spinner {
            left: 50%;
            margin-left: -20px;
            top: 50%;
            margin-top: -20px;
            position: absolute;
            z-index: 59 !important;
            animation: loading-bar-spinner 400ms linear infinite;
        }

        #loading-bar-spinner.spinner .spinner-icon {
            width: 40px;
            height: 40px;
            border:  solid 4px transparent;
            border-top-color:  #00C8B1 !important;
            border-left-color: #00C8B1 !important;
            border-radius: 50%;
        }

        @keyframes loading-bar-spinner {
        0%   { transform: rotate(0deg);   transform: rotate(0deg); }
        100% { transform: rotate(360deg); transform: rotate(360deg); }
        }
    </style>

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
    
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Main Script -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/global.js') }}"></script>

    <script>
        let appData;
        $(document).ready(async function() {
            appData = await getAppData();
            $('.appName').html(appData.app_name);
            $('.appDescription').html(appData.description);
            $('#appIcon').attr('href', baseL + '/' + appData.icon);
            $('.appLogo').attr('src', baseL + '/' + appData.icon);
            $('meta[name="description"]').attr('content', appData.description);
            $('meta[property="og:description"]').attr('content', appData.description);
            $('meta[property="og:title"]').attr('content', appData.description);
            $('meta[property="og:image"]').attr('content', baseL + '/' + appData.icon);
            $('#appFacebook').attr('href', appData.facebook);
            $('#appX').attr('href', appData.x);
            $('#appYoutube').attr('href', appData.youtube);
            $('#appInstagram').attr('href', appData.instagram);
            let keywords = '';
            JSON.parse(appData.keywords).forEach(element => {
                keywords += element.value + ', ';
            });
            $('meta[name="keywords"]').attr('content', keywords);
        });
    </script>

    @stack('js')

</body>

</html>
