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
                                    Edit Contact US
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <h2></h2>
                                        <form method="post" action="{{ route('Contactus-form.update', $fullmatchcontact->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <p for="email_us">Edit Email Details * </p>
                                                    <input type="email" name="email_us" id="email_us" value="{{ $fullmatchcontact->email_us }}" class="form-control input-lg" required />
                                                    <small class="errorTxt1"></small>
                                                    @error('email_en')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="call_us">Edit Call Details * </p>
                                                    <input type="number" min="0" name="call_us" id="call_us" value="{{ $fullmatchcontact->call_us }}" class="form-control input-lg" required />
                                                    <small class="errorTxt2"></small>
                                                    @error('call_us')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="address_en"> Edit Address Details EN * </p>
                                                    <input type="text" name="address_en" id="address_en"  value="{{ $fullmatchcontact->address_en }}" class="form-control input-lg" required />
                                                    <small class="errorTxt3"></small>
                                                    @error('address_en')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="address_ar"> Edit Address Details AR * </p>
                                                    <input type="text" name="address_ar" id="address_ar"  value="{{ $fullmatchcontact->address_ar }}" class="form-control input-lg" required />
                                                    <small class="errorTxt4"></small>
                                                    @error('address_ar')
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
    <script src={{ asset('app-assets/js/scripts/form-file-uploads.js') }}></script>
    <script src={{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}></script>
    <script>
        /*
     * Form Validation
     */

        $("#address_en").keyup(function(){
            $("#address_ar").val(this.value);
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
                    uname: {
                        required: true,
                        minlength: 5
                    },
                    cemail: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    cpassword: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    crole: {
                        required: true,
                    },
                    curl: {
                        required: true,
                        url: true
                    },
                    ccomment: {
                        required: true,
                        minlength: 15
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
