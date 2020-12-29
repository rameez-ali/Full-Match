<!-- BEGIN: Head-->
@include('admin.layouts.partials.head')
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('admin.layouts.partials.header')
    <!-- END: Header-->

    <!-- BEGIN: SideNav-->
    @include('admin.layouts.partials.sidenav')
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
           @yield('content')
        </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    @include('admin.layouts.partials.footer')
    <!-- END: Footer-->

    <!-- BEGIN Scripts-->
    @include('admin.layouts.partials.scripts')
    @yield('scripts')
    <!-- END Scripts-->
</body>

</html>
