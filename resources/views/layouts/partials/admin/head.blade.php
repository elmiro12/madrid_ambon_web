<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicon icon-->
<link rel="icon" href="@cachebust('assets/img/logo/'.getSetting('site_logo'))" type="image/png">
<meta name="description" content="{{ getSetting('site_description') }}">
<meta name="keywords" content="{{ getSetting('site_keywords') }}">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- Theme CSS -->
<link rel="stylesheet" href="@cachebust('assets/dashui/css/theme.css')">
<link rel="stylesheet" href="@cachebust('assets/css/custom.css')">

<title>@yield('title') - {{ getSetting('site_name') }}</title>
<!-- endbuild -->

@yield('custom-css')
</head>
