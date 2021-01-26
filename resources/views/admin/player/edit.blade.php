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
                                    Edit Player
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <h2></h2>
                                        <form method="post" action="{{ route('player-form.update', $player->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <p for="name_en">Edit Player Name EN * </p>
                                                    <input type="text" name="name_en" value="{{ $player->name_en }}" class="form-control input-lg"  required data-error=".errorTxt1" />
                                                    <small class="errorTxt1"></small>
                                                    @error('name_en')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="name_ar">Edit Player Name AR * </p>
                                                    <input type="text" name="name_ar" value="{{ $player->name_ar }}" class="form-control input-lg"  required data-error=".errorTxt7" />
                                                    <small class="errorTxt7"></small>
                                                    @error('name_ar')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_en"> Edit Player Description EN * </p>
                                                    <input type="text" name="description_en" value="{{ $player->description_en }}" class="form-control input-lg"  required data-error=".errorTxt2" />
                                                    <small class="errorTxt2"></small>
                                                    @error('description_en')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_ar"> Edit Player Description AR * </p>
                                                    <input type="text" name="description_ar" value="{{ $player->description_ar }}" class="form-control input-lg"  required data-error=".errorTxt8" />
                                                    <small class="errorTxt8"></small>
                                                    @error('description_ar')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="player_banner"> Edit Player Banner * </p>
                                                    <input type="file" name="player_banner" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/player/'.$player->player_banner)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                                    <input type="hidden" name="hidden_image1" value="{{ $player->player_banner }}" />
                                                <!-- <small class="errorTxt3"></small>
                                          @error('player_banner')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror -->
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="player_profile_image"> Edit Player Profile Image * </p>
                                                    <input type="file" name="player_profile_image" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/player/'.$player->player_profile_image)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg"/>
                                                    <input type="hidden" name="hidden_image2" value="{{ $player->player_profile_image }}" />
                                                    <small class="errorTxt4"></small>
                                                    @error('player_profile_image')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>


                                                <div class="input-field col s12">
                                                    <p for="category_image"> Edit Player Sorting </p>
                                                    <input type="number" name="player_sorting"  value="{{ $player->player_sorting }}" min="1" class="form-control input-lg" />
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
