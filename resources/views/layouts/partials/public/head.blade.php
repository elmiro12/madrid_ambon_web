<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="@cachebust('assets/img/logo/'.getSetting('site_logo'))" type="image/png">
    <meta name="description" content="{{ getSetting('site_description') }}">
    <meta name="keywords" content="@yield('keywords')">

    <!-- Link CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />
    <!-- CSS Files -->
    <link id="pagestyle" href="@cachebust('assets/material-kit/css/material-kit.css')" rel="stylesheet" />
    <link rel="stylesheet" href="@cachebust('assets/css/custom.css')">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title>@yield('title') - {{ getSetting('site_name') }}</title>

    @yield('custom-css')
</head>
