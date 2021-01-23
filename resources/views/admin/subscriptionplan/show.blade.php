@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                            {{ __('customer.notification.notifi_show') }}
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h5>{{ __('customer.id') }} : {{ $subscription->id }}</h5>

                                            <h5>{{ __('customer.title') }}</h5>
                                            <p>{{ $subscription->plan_title }}</p>

                                            <h5>{{ __('customer.title_ar') }}</h5>
                                            <p>{{ $subscription->plan_title_ar }}</p>

                                            <h5>{{ __('customer.decs') }}</h5>
                                            <p>{{ $subscription->plan_Description }}</p>

                                            <h5>{{ __('customer.decs_ar') }}</h5>
                                            <p>{{ $subscription->plan_Description_ar }}</p>

                                            <h5>{{ __('customer.subsplan.subsplan_price') }}</h5>
                                            <p>{{ $subscription->plan_price }}</p>

                                            <h5>{{ __('customer.duration') }}</h5>
                                            <p>@if($subscription->duration_type == 'day')
                                                {{ __('customer.days') }}
                                            @elseif($subscription->duration_type == 'week')
                                                {{ __('customer.weeks') }}
                                            @elseif($subscription->duration_type == 'month')
                                                {{ __('customer.months') }}
                                                @endif</p>

                                            <h5>{{ __('customer.value') }}</h5>
                                            <p>{{ $subscription->duration_value }}</p>

                                            <h5>{{ __('customer.subsplan.subsplan_sort') }}</h5>
                                            <p>{{ $subscription->sort_by }}</p>

                                            <a class="mb-5 btn waves-effect waves-light gradient-45deg-purple-deep-orange right" href="{{ route('subscriptionplans.index') }}">{{ __('customer.back') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
@endsection
