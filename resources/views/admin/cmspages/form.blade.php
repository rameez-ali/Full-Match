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
                                    @if($edit)
                                        {{ __('customer.cmspage.edit_cmspage') }}
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
                                                    <label for="name">{{ __('customer.name') }} *</label>
                                                    <input id="name" value="{{ old('name',$pages->name) }}" name="name" type="text"  data-error=".errorTxt1">
                                                    <small class="errorTxt1"></small>

                                                </div>
                                                <div class="input-field col s12">
                                                    <label for="slug">{{ __('customer.slug') }}*</label>
                                                    <input id="slug" value="{{ old('slug',$pages->slug) }}" type="text" name="slug" data-error=".errorTxt2">
                                                    <small class="errorTxt2"></small>

                                                    @error('slug')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror

                                                </div>

                                                <div class="input-field col s12">
                                                    <textarea name="content" id="content" value="{{old('content',$pages->content) }}" class="materialize-textarea validate" required>{{ old('content',$pages->content) }}</textarea>
                                                    <label for="page-content" class="active">{{ __('customer.decs') }}</label>

                                                    @error('content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>

                                                <div class="input-field col s12">
                                                    <textarea name="content_ar" id="content_ar" value="{{old('content_ar',$pages->content_ar) }}" class="materialize-textarea validate" required>{{ old('content_ar',$pages->content_ar) }}</textarea>
                                                    <label for="page-content" class="active">{{ __('customer.decs_ar') }}</label>

                                                    @error('content_ar')
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
        $("#content").keyup(function(){
            $("#content_ar").val(this.value);
        });
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
                    },
                    slug: {
                        required: true,
                    },
                    content: {
                        required: true,
                        minlength: 10
                    },
                    content_ar: {
                        required: true,
                        minlength: 10
                    },
                },
                //For custom messages
                messages: {
                    name: {
                        required: "Enter CMS page"
                    },
                    slug: {
                        required: "Enter Slug"
                    },
                    content: {
                        required: "Enter Description",
                        minlength: "Enter at least 10 characters"
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
