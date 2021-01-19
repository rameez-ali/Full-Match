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
                                        ADD PLAYER
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                            <form method="post" action="{{ route('player-form.store') }}" enctype="multipart/form-data">
                                            @csrf
                                              <div class="row">
                                            
                                                    <div class="input-field col s12">
                                                    <p for="player_name">Add Player Name * </p>
                                                    <input id="player_name" name="player_name" type="text"  required data-error=".errorTxt1">
                                                    <small class="errorTxt1"></small>
                                                    @error('player_name')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    </div>


                                                    <div class="input-field col s12">
                                                    <p for="player_description">Add Player Description * </p>
                                                    <input id="player_description" name="player_description" type="text"  required data-error=".errorTxt2">
                                                    <small class="errorTxt2"></small>
                                                    @error('player_description')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    </div>

 
                                                    <div class="input-field col s12">
                                                    <p for="player_banner"> Add Player Banner * </p>
                                                    <input type="file" name="player_banner" id="player_banner" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required data-error=".errorTxt3" />
                                                    <small class="errorTxt3"></small>
                                                    @error('player_banner')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    </div>
                 
                                             
                                                    <div class="input-field col s12">
                                                    <p for="player_profile_image"> Add Player Profile Image * </p>
                                                    <input type="file" name="player_profile_image" id="player_profile_image" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required data-error=".errorTxt4" />
                                                    <small class="errorTxt4"></small>
                                                    @error('player_profile_image')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    </div>

                                                    <div class="input-field col s12">
                                                    <p for="player_sorting">Add Player Sorting * </p>
                                                    <input id="player_sorting" name="player_sorting" type="number" >
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
                player_name: {
                    required: true,
                    minlength: 5
                },
                player_description: {
                    required: true,
                    email: true
                },
                player_banner: {
                    required: true,
                    minlength: 5
                },
                player_profile_image: {
                    required: true,
                    minlength: 5
                },
                player_sorting: {
                    required: true,
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
