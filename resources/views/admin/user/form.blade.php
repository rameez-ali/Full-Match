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
                                        @if(!$edit)
                                        {{ __('customer.sysusers.add') }}
                                        @else
                                        {{ __('customer.sysusers.edit') }}
                                        @endif

                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <form class="formValidate" id="formValidate" method="POST" action="{{ $route }}">
                                                @csrf
                                                @if($edit)
                                                    @method('PUT')
                                                @endif

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <label for="uname">{{ __('customer.customer.name') }} *</label>
                                                        <input id="uname" value="{{ old('name',$user->name) }}" name="name" type="text"  data-error=".errorTxt1">
                                                        <small class="errorTxt1"></small>

                                                            @error('uname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="cemail">{{ __('customer.customer.email') }}*</label>
                                                        <input id="cemail" value="{{ old('email',$user->email) }}" type="email" name="email" data-error=".errorTxt2">
                                                        <small class="errorTxt2"></small>

                                                            @error('cemail')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                    </div>

                                                        <div class="input-field col s12">
                                                            <label for="password">{{ __('customer.customer.password') }} *</label>
                                                            <input id="password" type="password" name="password" data-error=".errorTxt3" @if(!$edit) required @endif>
                                                            <small class="errorTxt3"></small>

                                                                @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                        </div>
                                                        <div class="input-field col s12">
                                                        <label for="cpassword">{{ __('customer.customer.confirm_password') }} *</label>
                                                        <input id="cpassword" type="password" name="cpassword" data-error=".errorTxt4" @if(!$edit) required @endif>
                                                        <small class="errorTxt4"></small>
                                                    </div>


                                                    <div class="input-field col s12">
                                                        <p for="roles">{{ __('customer.role.roles') }}</p>
                                                        <select id="roles" class="select2 browser-default" name="roles" required>
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->id}}" {{ $role->name == $user->getRoles()->first() ? 'selected' : '' }} >{{ $role->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    @if($edit)
                                                    <div class="input-field col s6">
                                                        <label>
                                                            <input type="checkbox" {{ $user->status == 1 ? 'checked' : '' }} name="status" id="customer-status" />
                                                            <span for="customer-status" >{{ __('customer.customer.block_customer') }}</span>
                                                        </label>
                                                    </div>
                                                    @endif
                                                    <div class="input-field col s12">
                                                        <button class="btn waves-effect waves-light right submit" type="submit" name="action">Submit
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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
@section('scripts')
    <script src={{ asset('app-assets/vendors/jquery-validation/jquery.validate.min.js') }}></script>
    <script>
        /*
     * Form Validation
     */
        $(function () {

            $('select[required]').css({
                position: 'absolute',
                display: 'inline',
                height: 0,
                padding: 0,
                border: '1px solid rgba(255,255,255,0)',
                width: 0
            });

            $("#formValidate").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 8
                    },
                    cpassword: {
                        minlength: 8,
                        equalTo: "#password"
                    },

                },
                //For custom messages
                messages: {
                    name: {
                        required: "Enter a username",
                        minlength: "Enter at least 3 characters"
                    },
                    email: {
                        required: "Enter a Email",
                        email: "invalid Email"
                    },
                    curl: "Enter your website",
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
@endsection
