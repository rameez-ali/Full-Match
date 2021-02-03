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
                                        {{ __('customer.role.add') }}
                                        @else
                                        {{ __('customer.role.edit') }}
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
                                                        <label for="name">{{ __('customer.customer.name') }} *</label>
                                                        <input id="name" value="{{ old('name',$role->name) }}" name="name" type="text"  data-error=".errorTxt1">
                                                        <small class="errorTxt1"></small>

                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="title">{{ __('customer.title') }}*</label>
                                                        <input id="title" value="{{ old('name',$role->title) }}" name="title" type="text"  data-error=".errorTxt2">
                                                        <small class="errorTxt2"></small>

                                                            @error('title')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                    </div>

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
                    title: {
                        required: true,
                        minlength: 3
                    },

                },
                //For custom messages
                messages: {
                    name: {
                        required: "Enter a username",
                        minlength: "Enter at least 3 characters"
                    },
                    title: {
                        required: "Enter a title",
                        minlength: "Enter at least 3 characters"
                    },
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
