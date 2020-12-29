@extends('admin.layouts.auth')

@section('content')
    <div class="col s12">
        <div class="container">
            <div id="forgot-password" class="row">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="col s12 m6 l4 z-depth-4 offset-m4 card-panel border-radius-6 forgot-card bg-opacity-8">
                    <form class="login-form" method="POST" action="{{ route('password.email') }}" >
                        @csrf
{{--                        <input type="hidden" name="token" value="{{ $token }}">--}}
                        <div class="row">
                            <div class="input-field col s12">
                                <h5 class="ml-4">{{ __('Reset Password') }}</h5>
                                <p class="ml-4">You can reset your password</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">person_outline</i>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >
                                <label for="email" class="center-align">{{ __('E-Mail Address') }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6 m6 l6">
                                <p class="margin medium-small"><a href="{{route('customer.login.show')}}">Login</a></p>
                            </div>
                            <div class="input-field col s6 m6 l6">
                                <p class="margin right-align medium-small"><a href="{{route('customer.register')}}">Register</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
@endsection
