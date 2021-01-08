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
                                       <div class="form-group">
                                       <div class="col-md-8">
                                       <input type="text" name="player_name" Placeholder="Player Name" value="{{ $player->player_name }}" class="form-control input-lg" />
                                       </div>
                                       </div>
                                       <div class="form-group">
                                       <div class="col-md-8">
                                       <input type="text" name="player_description" Placeholder="Description" value="{{ $player->player_description }}" class="form-control input-lg" />
                                       </div><br>
                                       </div>
                                       <div class="form-group">
                                       <div class="col-md-8">
                                       <input type="file" name="player_banner" />
                                       <input type="hidden" name="hidden_image1" value="{{ $player->player_banner }}" />
                                       </div><br>
                                       </div>
                                       <div class="form-group">
                                       <div class="col-md-8">
                                       <input type="file" name="player_profile_image" />
                                       <input type="hidden" name="hidden_image2" value="{{ $player->player_profile_image }}" Placeholder="Player Profile Image" value="{{ $player->player_profile_image }}" />
                                       </div><br>
                                       </div>
                                       <div class="form-group">
                                       <div class="col-md-8">
                                       <input type="text" name="player_sorting" Placeholder="Player sorting" value="{{ $player->player_sorting }}" class="form-control input-lg" />
                                       </div>
                                       </div>
                                       <br /><br />
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
