<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="dashboard">
    <meta name="keywords" content="dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Admin Login</title>
    <link rel="apple-touch-icon" href={{ asset('app-assets/images/favicon/f-touch-icon.png') }}>
    <link rel="shortcut icon" type="image/x-icon" href={{ asset('app-assets/images/favicon/favicon2.png') }}>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/vendors/vendors.min.css') }}>
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/themes/vertical-gradient-menu-template/materialize.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/themes/vertical-gradient-menu-template/style.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/pages/login.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/pages/register.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/pages/forgot.css') }}>
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/custom/custom.css') }}>
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-gradient-menu" data-col="1-column">
<div class="row">
    @yield('content')
</div>

<!-- BEGIN VENDOR JS-->
<script src={{ asset('app-assets/js/vendors.min.js') }}></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src={{ asset('app-assets/js/plugins.js') }}></script>
<script src={{ asset('app-assets/js/search.js') }}></script>
<script src={{ asset('app-assets/js/custom/custom-script.js') }}></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
</body>

</html>
