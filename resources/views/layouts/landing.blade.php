<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>NACOS Elections - FULafia</title>

    <meta name="description" content="Elections for NACOSites from Federal University of Lafia">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Elections for NACOSites from Federal University of Lafia">
    <meta property="og:site_name" content="NACOS Elections">
    <meta property="og:type" content="School Association">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/android-chrome-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="512x512" href="{{ asset('assets/media/favicons/android-chrome-512x512.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- OneUI framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/oneui.min.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
    <!-- END Stylesheets -->
</head>

<body>

<div id="page-container" class="sidebar-dark side-scroll page-header-fixed page-header-dark main-content-boxed">


    <!-- Header -->
    <header id="page-header" style="background-color: #198906;">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <!-- Logo -->
                <div class="m-2 p-1" style="height: 20%; width: 20%; border-radius: 50%;">
                    <img src="{{ asset('assets/media/nacos/NACOS.png') }}" style="width: 100%; border-radius: 50%;" alt="...">
                </div>
                <a class="fw-semibold fs-5 tracking-wider text-dual me-3" href="#">
                    NACOS<span class="fw-normal"></span>
                </a>
                <!-- END Logo -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->

            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->



        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-primary-lighter">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">

        @yield('content')

    </main>

    <div class="fs-sm text-muted text-center">
        <strong>NACOS Elections 1.0</strong> &copy; <span data-toggle="year-copy"></span>
    </div>

</div>


        <!--
            OneUI JS

            Core libraries and functionality
            webpack is putting everything together at assets/_js/main/app.js
        -->
        <script src="{{ asset('assets/js/oneui.app.min.js') }}"></script>
</body>
</html>
