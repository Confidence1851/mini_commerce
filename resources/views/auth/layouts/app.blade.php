<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{-- <title>@yield("title")</title> --}}
    <title> {{ $meta_title ?? '' }} - {{ env("APP_NAME") }} </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ $logo_icon_image }}">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ $web_assets }}/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/vendor/slick.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/vendor/base.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/plugins/plugins.css">
    <link rel="stylesheet" href="{{ $web_assets }}/css/style.css">

    <style>
        .maintanence-area .content .subscription-form .form-group {
            max-width: 100% !important;
        }

        .subscription-form .form-group input {
            padding-right: 30px;
        }

        select.form-control {
            border: 0 none;
            border-radius: 100px;
            height: 50px;
            font-size: var(--font-size-b2);
            padding: 0 20px;
            background-color: var(--color-lightest);
            border: 1px solid transparent;
        }

        .subscription-form .form-group select {
            padding-right: 30px;
        }

    </style>


</head>

<body>
    <div class="main-wrapper">
        {{-- <div id="my_switcher" class="my_switcher">
            <ul>
                <li>
                    <a href="javascript: void(0);" data-theme="light" class="setColor light">
                        <span title="Light Mode">Light</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" data-theme="dark" class="setColor dark">
                        <span title="Dark Mode">Dark</span>
                    </a>
                </li>
            </ul>
        </div> --}}

        <div class="maintanence-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="order-2 order-lg-1 col-lg-6 mt_md--40 ">
                        <div class="content">
                            @include("web.layouts.includes.logo_section")
                            @yield("content")
                        </div>
                    </div>
                    <div class="order-1 order-lg-2 col-lg-5 offset-lg-1  d-none d-md-block">
                        <div class="thumbnail">
                            <img src="{{ $web_assets }}/images/others/maintenence.png" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Maintanence Area  -->
        <!-- Start Back To Top  -->
        <a id="backto-top"></a>
        <!-- End Back To Top  -->
    </div>


    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="{{ $web_assets }}/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="{{ $web_assets }}/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ $web_assets }}/js/vendor/bootstrap.min.js"></script>
    <script src="{{ $web_assets }}/js/vendor/slick.min.js"></script>
    <script src="{{ $web_assets }}/js/vendor/tweenmax.min.js"></script>
    <script src="{{ $web_assets }}/js/vendor/js.cookie.js"></script>
    <script src="{{ $web_assets }}/js/vendor/jquery.style.switcher.js"></script>


    <!-- Main JS -->
    <script src="{{ $web_assets }}/js/main.js"></script>

</body>


</html>
