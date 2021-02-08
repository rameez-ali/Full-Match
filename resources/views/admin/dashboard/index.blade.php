@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                <!--card stats start-->
                <div id="card-stats" class="pt-0">
                    <div class="row" id="gradient-Analytics">
                        <div class="col s12 m6 l6 card-width">
                            <a @can('view-customer') href="{{ route('customer.index') }}" @endcan>
                                <div class="card row gradient-45deg-purple-deep-purple gradient-shadow white-text padding-4 mt-3 animate fadeLeft">
                                <div class="col s7 m7">
                                    <i class="material-icons background-round mt-5 mb-5">people</i>
                                    <p>{{ __('customer.total_regis_users') }}</p>
                                </div>
                                <div class="col s5 m5 right-align">
                                    <h5 class="mb-0 white-text">{{ $data['all_customers'] }}</h5>
                                </div>
                            </div>
                            </a>
                        </div>
{{--                        <div class="col s12 m6 l6 card-width">--}}
{{--                            <a href="{{ route('order.index') }}">--}}
{{--                                <div class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4 mt-3 animate fadeRight">--}}
{{--                                <div class="col s7 m7">--}}
{{--                                    <i class="material-icons background-round mt-5 mb-5">add_shopping_cart</i>--}}
{{--                                    <p>{{ __('customer.total_sold_plans') }}</p>--}}
{{--                                </div>--}}
{{--                                <div class="col s5 m5 right-align">--}}
{{--                                    <h5 class="mb-0 white-text">{{ $data['sold_plans'] }}</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <div class="col s12 m6 l6 card-width">
                            <a @can('view-player') href="{{ route('player-form.index') }}" @endcan>
                                <div class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4 mt-3 animate fadeLeft">
                                    <div class="col s7 m7">
                                        <i class="material-icons background-round mt-5 mb-5">directions_run</i>
                                        <p>{{ __('customer.total_players') }}</p>
                                    </div>
                                    <div class="col s5 m5 right-align">
                                        <h5 class="mb-0 white-text">{{ $data['all_players'] }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col s12 m6 l6 card-width">
                            <a @can('view-video') href="{{ route('video-form.index') }}" @endcan>
                                <div class="card row gradient-45deg-blue-indigo gradient-shadow white-text padding-4 mt-3 animate fadeLeft">
                                <div class="col s7 m7">
                                    <i class="material-icons background-round mt-5 mb-5">ondemand_video</i>
                                    <p>{{ __('customer.total_videos') }}</p>
                                </div>
                                <div class="col s5 m5 right-align">
                                    <h5 class="mb-0 white-text">{{ $data['all_videos'] }}</h5>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col s12 m6 l6 card-width">
                            <a @can('view-genre') href="{{ route('genre-form.index') }}" @endcan>
                                <div class="card row gradient-45deg-purple-deep-orange gradient-shadow white-text padding-4 mt-3 animate fadeRight">
                                <div class="col s7 m7">
                                    <i class="material-icons background-round mt-5 mb-5">timeline</i>
                                    <p>{{ __('customer.total_genres') }}</p>
                                </div>
                                <div class="col s5 m5 right-align">
                                    <h5 class="mb-0 white-text">{{ $data['all_video_genres'] }}</h5>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="row" id="gradient-Analytics">

                        <div class="col s12 m6 l6 card-width">
                            <a @can('view-club') href="{{ route('club-form.index') }}" @endcan>
                                <div class="card row gradient-45deg-amber-amber gradient-shadow white-text padding-4 mt-3 animate fadeLeft">
                                <div class="col s7 m7">
                                    <i class="material-icons background-round mt-5 mb-5">airplay</i>
                                    <p>{{ __('customer.total_clubs') }}</p>
                                </div>
                                <div class="col s5 m5 right-align">
                                    <h5 class="mb-0 white-text">{{ $data['all_clubs'] }}</h5>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col s12 m6 l6 card-width">
                            <a @can('view-category') href="{{ route('category-form.index') }}" @endcan>
                                <div class="card row gradient-45deg-red-pink gradient-shadow white-text padding-4 mt-3 animate fadeRight">
                                <div class="col s7 m7">
                                    <i class="material-icons background-round mt-5 mb-5">video_library</i>
                                    <p>{{ __('customer.total_categories') }}</p>
                                </div>
                                <div class="col s5 m5 right-align">
                                    <h5 class="mb-0 white-text">{{ $data['all_categories'] }}</h5>
                                </div>
                            </div>
                            </a>
                        </div>
{{--                        <div class="col s12 m6 l6 card-width">--}}
{{--                            <a href="#">--}}
{{--                                <div class="card row gradient-45deg-purple-deep-purple gradient-shadow white-text padding-4 mt-3 animate fadeRight">--}}
{{--                                <div class="col s7 m7">--}}
{{--                                    <i class="material-icons background-round mt-5 mb-5">not_interested</i>--}}
{{--                                    <p>----</p>--}}
{{--                                </div>--}}
{{--                                <div class="col s5 m5 right-align">--}}
{{--                                    <h5 class="mb-0 white-text">---</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!--card stats end-->

                <!--end container-->
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
@endsection
