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
                                            <div class="card-body">
                                            
                                            <div class="form-group">
                                            <input type="text" name="player_name" Placeholder="Player Name *" class="form-control input-lg" />
                                            <small class="errorTxt1"></small>
                                            @error('player_name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div>

                                            <div class="form-group">
                                            <input type="text" name="player_description" Placeholder="Description * " class="form-control input-lg" />
                                            <small class="errorTxt1"></small>
                                            @error('player_description')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div><br>
 
                                            <div class="form-group">
                                            <div class="input-group">
                                            <div class="custom-file">
                                            <label>Player Banner * </label>
                                            <input type="file" name="player_banner" Placeholder="Player Banner *" id="exampleInputFile">
                                            <small class="errorTxt1"></small>
                                            @error('player_banner')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div>
                                            </div>
                                            </div><br>
                 
                                             <div class="form-group">
                                             <div class="input-group">
                                             <div class="custom-file">
                                            <label>Player Profile Image * </label>
                                             <input type="file" name="player_profile_image" Placeholder="Player Profile Image" id="exampleInputFile1">
                                             <small class="errorTxt1"></small>
                                            @error('player_profile_image')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                             </div>
                                             </div>
                                            </div><br>

                                            <div class="form-group">
                                            <input type="text" name="player_sorting" Placeholder="Player Sorting" class="form-control input-lg" />
                                            </div><br>
                 
                
                                             <div class="input-field col s12">
                                                    <button class="btn waves-effect waves-light right submit" type="submit" name="action">Submit
                                                        <i class="material-icons right">send</i>
                                                    </button>
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
    <script src="app-assets/vendors/jquery-validation/jquery.validate.min.js"></script>
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
