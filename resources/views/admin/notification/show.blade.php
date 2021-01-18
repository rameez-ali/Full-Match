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
                                            <h5>{{ __('customer.id') }} : {{ $notification->id }}</h5>

                                            <h5>{{ __('customer.title') }}</h5>
                                            <p>{{ $notification->notify_title }}</p>

                                            <h5>{{ __('customer.decs') }}</h5>
                                            <p>{{ $notification->notify_text }}</p>

                                            <h5>{{ __('customer.notification.notification_type') }}</h5>
                                            <p>@if($notification->notify_type == 1)
                                                {{ __('customer.notification.all_user') }}
                                            @elseif($notification->notify_type == 2)
                                                {{ __('customer.notification.guest_user') }}
                                            @elseif($notification->notify_type == 3)
                                                {{ __('customer.notification.registered_user') }}
                                                @endif</p>

                                            <h5>{{ __('customer.notification.notifi_date_time') }}</h5>
                                            <p>{{ $notification->created_at }}</p>

                                            <a class="mb-5 btn waves-effect waves-light gradient-45deg-purple-deep-orange right" href="{{ route('notification.index') }}">{{ __('customer.back') }}</a>
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
