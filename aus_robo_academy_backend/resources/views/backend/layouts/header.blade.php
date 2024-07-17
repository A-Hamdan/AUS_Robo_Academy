<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Australian Robo Academy</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('/admin/dist/img/logo.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    @if (session()->get('locale') == 'en' || session()->get('locale') == null)
        <link rel="stylesheet" href="{{ URL::asset('/admin/dist/css/adminlte.css') }}">
    @elseif(session()->get('locale') == 'ar')
        <link id="ar_css" rel="stylesheet" href="{{ URL::asset('/admin/dist/css/adminlte_rtl.css') }}">
    @endif
    <!-- Custom style -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/dist/css/custom.css') }}">
    <!-- Ionic Icons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ URL::asset('/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ URL::asset('/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::asset('/admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Slick Slider -->
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> --}}
</head>
