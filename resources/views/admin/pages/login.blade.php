@extends('admin.layouts.auth')

@section('content')
<div class="col s12">
    <div class="container">
        <div id="login-page" class="row">
            <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                <form class="login-form" method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <h5 class="ml-4">Sign in</h5>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">person_outline</i>
                            <input id="email" type="email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                            <label for="email" class="center-align">{{ __('E-Mail Address') }}</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">lock_outline</i>
                            <input id="password" type="password" @error('password') is-invalid @enderror name="password" required autocomplete="current-password">
                            <label for="password">{{ __('Password') }}</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 ml-2 mt-1">
                            <p>
                                <label>
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <span> {{ __('Remember Me') }}</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">  {{ __('Login') }}</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                        </div>
                        <div class="input-field col s6 m6 l6">
{{--                            <p class="margin right-align medium-small"><a href="user-forgot-password.html">Forgot password ?</a></p>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="content-overlay"></div>
</div>

@endsection
