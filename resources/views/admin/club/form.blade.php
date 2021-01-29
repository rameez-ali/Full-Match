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
                                    ADD CLUB
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <h2></h2>
                                        <form method="post" action="{{ route('club-form.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">

                                                <div class="input-field col s12">
                                                    <p for="name_en">Add Club Name EN * </p>
                                                    <input id="name_en" name="name_en" type="text"  required data-error=".errorTxt1">
                                                    <small class="errorTxt1"></small>
                                                    @error('name_en')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="name_ar">Add Club Name AR * </p>
                                                    <input id="name_ar" name="name_ar" type="text"  required data-error=".errorTxt2">
                                                    <small class="errorTxt2"></small>
                                                    @error('name_ar')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_en">Add Club Description EN * </p>
                                                    <input id="description_en" name="description_en" type="text"  required data-error=".errorTxt3">
                                                    <small class="errorTxt3"></small>
                                                    @error('description_en')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_ar">Add Club Description AR * </p>
                                                    <input id="description_ar" name="description_ar" type="text"  required data-error=".errorTxt4">
                                                    <small class="errorTxt4"></small>
                                                    @error('description_ar')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="club_banner"> Add Club Banner * </p>
                                                    <input type="file" name="club_banner" id="club_banner" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required data-error=".errorTxt5" />
                                                    <small class="errorTxt5"></small>
                                                    @error('club_banner')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="club_logo"> Add Club Logo * </p>
                                                    <input type="file" name="club_logo" id="club_logo" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required data-error=".errorTxt6" />
                                                    <small class="errorTxt6"></small>
                                                    @error('club_logo')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                     </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="club_sorting">Add Club Sorting </p>
                                                    <input id="club_sorting" name="club_sorting" type="number" min="1">
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
    <script src={{ asset('app-assets/js/scripts/form-file-uploads.js') }}></script>
    <script src={{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}></script>
    <script>
        /*
     * Form Validation
     */
        $("#name_en").keyup(function(){
            $("#name_ar").val(this.value);
        });
        $("#description_en").keyup(function(){
            $("#description_ar").val(this.value);
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
                    club_name: {
                        required: true,
                        minlength: 5
                    },
                    club_description: {
                        required: true,
                        email: true
                    },
                    club_logo: {
                        required: true,
                        minlength: 5
                    },
                    club_banner: {
                        required: true,
                        minlength: 5,
                    },
                    tnc_select: "required",
                },
                //For custom messages
                messages: {
                    uname: {
                        required: "Enter a username",
                        minlength: "Enter at least 5 characters"
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
