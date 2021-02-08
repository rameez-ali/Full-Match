<!-- BEGIN: SideNav-->

<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-deep-purple-blue sidenav-gradient sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('dashboard') }}"><img class="hide-on-med-and-down " src={{ asset('app-assets/images/logo/fm-logo.png') }} alt="materializelogo" /><img class="show-on-medium-and-down hide-on-med-and-up" src={{ asset('app-assets/images/logo/fm-logo.png') }} alt="materializelogo" /><span class="logo-text hide-on-med-and-down">Full Match</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
          @php
              $menu = [
                    [  'icon' => 'people' , 'label'  => __('customer.customer.customer_head') , 'route' => 'customer.index' , 'children' => [], 'permission' => 'view-customer' ],
                    [  'icon' => 'settings' , 'label'  => __('customer.cmspage.cmspage') , 'route' => 'page.index' , 'children' => [], 'permission' => 'view-cmspage' ],
                    [  'icon' => 'add_location' , 'label'  => 'Contact Us' , 'route' => 'Contactus-form.index' , 'children' => [], 'permission' => 'view-contactus' ],
                    [  'icon' => 'question_answer' , 'label'  => 'Contact Queries' , 'route' => 'contact-form.index' , 'children' => [], 'permission' => 'view-contactqueries' ],
                    [  'icon' => 'domain' , 'label'  => 'Category' , 'route' => 'category-form.index' , 'children' => [], 'permission' => 'view-category' ],
                    [  'icon' => 'video_library' , 'label'  => 'Genre' , 'route' => 'genre-form.index' , 'children' => [], 'permission' => 'view-genre' ],
                    [  'icon' => 'border_all' , 'label'  => 'Club' , 'route' => 'club-form.index' , 'children' => [], 'permission' => 'view-club' ],
                    [  'icon' => 'directions_walk' , 'label'  => 'Player' , 'route' => 'player-form.index' , 'children' => [], 'permission' => 'view-player' ],
                    [  'icon' => 'event' , 'label'  => 'League' , 'route' => 'league-form.index' , 'children' => [], 'permission' => 'view-league' ],
                    [  'icon' => 'ondemand_video' , 'label'  => 'Video' , 'route' => 'video-form.index' , 'children' => [], 'permission' => 'view-video' ],
                    [  'icon' => 'slideshow' , 'label'  => 'Slider' , 'route' => 'slider-form.index' , 'children' => [], 'permission' => 'view-slider' ],
                    [  'icon' => 'announcement' , 'label'  => 'Advertisement Banner' , 'route' => 'banner-form.index' , 'children' => [], 'permission' => 'view-advbanner' ],
                    [  'icon' => 'ac_unit' , 'label'  => 'Season Part Sorting' , 'route' => 'seasonpart-form.index' , 'children' => [], 'permission' => 'view-seasonpart' ],
                    [  'icon' => 'settings' , 'label'  => __('customer.homepgmanage.homepg') , 'route' => 'home-page-manage.index' , 'children' => [], 'permission' => 'view-homepg-manage' ],
                    [  'icon' => 'notifications_active' , 'label'  => __('customer.notification.notification') , 'route' => 'notification.index' , 'children' => [], 'permission' => 'view-notify' ],
                    [  'icon' => 'people' , 'label'  => __('customer.syst_users') , 'route' => 'user.index' , 'children' => [], 'permission' => 'view-system-user' ],
                    [  'icon' => 'people' , 'label'  => __('customer.role.roles') , 'route' => 'role.index' , 'children' => [], 'permission' => 'view-role' ],

                ];
          @endphp



    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        @foreach($menu as $item)
            @php
                $route = count($item['children']) > 0 ? 'JavaScript:void(0)' : route($item['route']);
                $li_class = (Route::current()->getName() == $item['route']) ? 'active' : '';
                $anchor_class = $li_class == 'active' ? 'active' : '';

                if($li_class == '' && count($item['children']) > 0)
                {
                    $children_routes = array_column($item['children'],'route');

                    if(in_array(Route::current()->getName(),$children_routes)){
                        $li_class = 'active';
                    }
                }

                $handler = '';

                if(isset($item['handler'])){
                    $handler = "onclick=";
                    $handler .= $item['handler'];
                    $route = 'JavaScript:void(0)';
                }

            @endphp

            @if(!isset($item['permission']) || (isset($item['permission']) && Bouncer::can($item['permission'])))
                <li class="bold {{ $li_class }}">
                    <a class="{{ count($item['children']) > 0 ? 'collapsible-header' : '' }} waves-effect waves-cyan {{ $anchor_class }}" href="{{ $route }}" {{ $handler }}   >
                        <i class="material-icons">{{ $item['icon'] }}</i>
                        <span class="menu-title" data-i18n="Dashboard">{{ $item['label'] }}</span>
                    </a>

                    @if(count($item['children']) > 0)

                        <div class="collapsible-body">
                            <ul class="collapsible collapsible-sub" data-collapsible="accordion">

                                @foreach($item['children'] as $child)
                                    @php
                                        $sub_li_class = (Route::current()->getName() == $child['route']) ? 'active' : '';
                                    @endphp

                                    @if(!isset($child['permission']) || (isset($child['permission']) && Bouncer::can($child['permission'])))
                                        <li class="{{ $sub_li_class }}" >
                                            <a href="{{ route($child['route']) }}" class="{{ $sub_li_class }}" >
                                                <i class="material-icons">{{ $child['icon'] }}</i>
                                                <span data-i18n="List">{{ $child['label'] }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    @endif
                </li>
            @endif

        @endforeach


        <li  class="bold"><a class="waves-effect waves-cyan " href="{{ route('customer.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i>{{ __('Logout') }}</a></li>
        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </ul>

    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->
