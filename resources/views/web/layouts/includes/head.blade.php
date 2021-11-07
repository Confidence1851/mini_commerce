<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="{{ $metaData['description'] ?? '' }}">
    <meta name="keywords" content="{{ $metaData['keywords'] ?? '' }}">
    <meta name="author" content="{{ $metaData['author'] ?? '' }}">
    <meta name="publisher" content="{{ $metaData['publisher'] ?? '' }}">
    <meta name="copyright" content="{{ $metaData['copyright'] ?? '' }}">
    <meta name="page-topic" content="{{ $metaData['page_topic'] ?? '' }}">
    <meta name="page-type" content="{{ $metaData['page_type'] ?? '' }}">
    <meta name="audience" content="{{ $metaData['audience'] ?? '' }}">

    <!--  Essential META Tags -->
    <meta property="og:title" content="{{ $metaData['og_title'] ?? '' }}">
    <meta property="og:description" content="{{ $metaData['og_description'] ?? '' }}">
    <meta property="og:image" itemprop="image" content="{{ $metaData['og_image'] ?? '' }}">
    <meta property="og:image:secure_url" itemprop="image" content="{{ $metaData['og_image'] ?? '' }}">
    <!-- MS Tile - for Microsoft apps-->
    <meta name="msapplication-TileImage" content="{{ $metaData['og_image'] ?? '' }}">

    <meta property="og:url" content="{{ $metaData['og_url'] ?? '' }}">
    <meta name="twitter:card" content="{{ $metaData['twitter_card'] ?? '' }}">

    <!--  Non-Essential, But Recommended -->
    <meta property="og:site_name" content="{{ $metaData['og_site_name'] ?? '' }}">
    <meta name="twitter:image:alt" content="{{ $metaData['twitter_image_alt'] ?? '' }}">

    <meta property="og:image:width" content="{{ $metaData['og_image_width'] ?? '300' }}">
    <meta property="og:image:width" content="{{ $metaData['og_image_height'] ?? '300' }}">
    <meta property="og:type" content="{{ $metaData['og_type'] ?? 'blog' }}">





    <title>{{ $metaData['title'] ?? '' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ $logo_icon_image }}">

    <!-- CSS
    ============================================ -->
    @livewireStyles

    <!-- Bootstrap CSS -->
    @include("web.layouts.includes.style")

    <style>
        .auth_button {
            background: var(--color-primary);
            color: var(--color-white);
            font-weight: var(--p-medium);
            font-size: var(--font-size-b2);
            display: inline-block;
            border: 2px solid var(--color-primary);
            padding: 0 30px;
            height: 35px;
            line-height: 30px;
            border-radius: 500px;
        }

        .auth_button:hover,
        .auth_button:focus,
        .auth_button:active {
            background: var(--color-white);
        }

        .bg_image {}

        .avatar-rounded {
            border-radius: 100%;
        }

        .rounded_edge {
            border-radius: 10px;
        }

        .checkout_btn {
            background-color: #e32222;
            display: block;
            cursor: pointer;
            padding: 17px 50px 18 px;
            text-transform: uppercase;
            font-weight: 700;
            width: 100%;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
        }

        .login_btn {
            background-color: #e32222;
            display: block;
            cursor: pointer;
            padding: 17px 50px 18 px;
            margin: 0px 20px;
            text-transform: uppercase;
            font-weight: 700;
            width: 60%;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
        }

        .header_login_text {
            font-size: 20px !important;
            margin-left: 10px;
            color: #e32222;
        }

    </style>

</head>
