<!-- BEGIN: SideNav-->

<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-deep-purple-blue sidenav-gradient sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('dashboard') }}"><img class="hide-on-med-and-down " src={{ asset('app-assets/images/logo/fm-logo.png') }} alt="materializelogo" /><img class="show-on-medium-and-down hide-on-med-and-up" src={{ asset('app-assets/images/logo/fm-logo.png') }} alt="materializelogo" /><span class="logo-text hide-on-med-and-down">Full Match</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('customer.index') }}"><i class="material-icons dp48">people</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.customer.customer_head') }}</span></a>
        </li>

{{--        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('subscriptionplans.index') }}"><i class="material-icons dp48">subscriptions</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.subsplan.subsplan_head') }}</span></a>--}}
{{--        </li>--}}

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('page.index') }}"><i class="material-icons dp48">settings</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.cmspage.cmspage') }}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('home-page-manage.index') }}"><i class="material-icons dp48">settings</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.homepgmanage.homepg') }}</span></a>
        </li>

{{--        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('order.index') }}"><i class="material-icons dp48">shopping_cart</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.order.orders') }}</span></a>--}}
{{--        </li>--}}

{{--        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('discount.index') }}"><i class="material-icons dp48">local_offer</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.discount.discount') }}</span></a>--}}
{{--        </li>--}}

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('notification.index') }}"><i class="material-icons dp48">notifications_active</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.notification.notification') }}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('Contactus-form.index') }}"><i class="material-icons">add_location</i><span class="menu-title" data-i18n="User Profile">Contact Us</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('contact-form.index') }}"><i class="material-icons">question_answer
                </i><span class="menu-title" data-i18n="User Profile">Contact Queries</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('category-form.index') }}"><i class="material-icons">domain</i><span class="menu-title" data-i18n="User Profile">Category</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('genre-form.index') }}"><i class="material-icons">video_library</i><span class="menu-title" data-i18n="User Profile">Genre</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('player-form.index') }}"><i class="material-icons">directions_walk
                </i><span class="menu-title" data-i18n="User Profile">Players</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('club-form.index') }}"><i class="material-icons">border_all</i><span class="menu-title" data-i18n="User Profile">Club</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('league-form.index') }}"><i class="material-icons">event</i><span class="menu-title" data-i18n="User Profile">League</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('video-form.index') }}"><i class="material-icons">ondemand_video
                </i><span class="menu-title" data-i18n="User Profile">Videos</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('slider-form.index') }}"><i class="material-icons">slideshow</i><span class="menu-title" data-i18n="User Profile">Category Slider</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('banner-form.index') }}"><i class="material-icons">announcement</i><span class="menu-title" data-i18n="User Profile">Advertisement Banner</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('seasonpart-form.index') }}"><i class="material-icons">ac_unit</i><span class="menu-title" data-i18n="User Profile">Season Part Sorting</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('user.index') }}"><i class="material-icons">people</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.syst_users') }}</span></a>
        </li>

        <li  class="bold"><a class="waves-effect waves-cyan " href="{{ route('customer.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i>{{ __('Logout') }}</a></li>
        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </ul>

    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->
