<!-- BEGIN: SideNav-->

<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-deep-purple-blue sidenav-gradient sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('dashboard') }}"><img class="hide-on-med-and-down " src={{ asset('app-assets/images/logo/materialize-logo.png') }} alt="materializelogo" /><img class="show-on-medium-and-down hide-on-med-and-up" src={{ asset('app-assets/images/logo/materialize-logo-color.png') }} alt="materializelogo" /><span class="logo-text hide-on-med-and-down">Full Match</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('customer.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.customer.customer_head') }}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('subscriptionplans.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.subsplan.subsplan_head') }}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('page.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.cmspage.cmspage') }}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('order.all') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">{{ __('customer.order.orders') }}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('category-form.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">Category</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('player-form.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">Players</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('club-form.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">Club</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('league-form.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">League</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('video-form.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">Videos</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('slider-form.index') }}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="User Profile">Slider</span></a>
        </li>

        <li class="navigation-header"><a class="navigation-header-text">Charts</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>

    </ul>

    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->
