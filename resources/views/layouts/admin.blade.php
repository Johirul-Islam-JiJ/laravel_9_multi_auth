<!DOCTYPE html>
<html class="loading" id="mainHtml" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="">
    <meta name="viewport" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>@yield('page-title','Amer Code') | {{config('app.name')}}</title>
    <link rel="apple-touch-icon" href="{{asset('admin')}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin')}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <!-- start:CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/admin.css')) }}">
    <!-- END:CSS-->
    @stack('styles')
    <script>
        document.getElementById('mainHtml').classList.add(localStorage.getItem('light-layout-current-skin'))
    </script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
@include('admin.inc.header')
<!-- END: Header-->
<!-- BEGIN: Main Menu-->
@include('admin.inc.sidebar')
<!-- END: Main Menu-->
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        @yield('breadcrumb')
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            @yield('content')
            <!-- Dashboard Ecommerce ends -->
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- BEGIN: Footer-->
@include('admin.inc.footer')
<!-- END: Footer-->
<!-- start: Page JS-->
<script src="{{ asset(mix('js/admin.js')) }}"></script>
<!-- END: Page JS-->
{!! Toastr::message() !!}
@stack('scripts')
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{{$error}}', 'Error', {
        closeButton: true,
        progressBar: true,
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut',
        timeOut: 5000,
    });
    @endforeach
    @endif
</script>
</body>
<!-- END: Body-->

</html>
