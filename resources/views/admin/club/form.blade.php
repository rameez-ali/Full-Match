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
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Details</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                            <form method="post" action="{{ route('player-form.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Enter Club Name</label>
                                            <input type="text" name="player_name" class="form-control input-lg" />
                                            </div>

                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Enter Description</label>
                                            <input type="text" name="player_description" class="form-control input-lg" />
                                            </div>
 
                                            <div class="form-group">
                                            <label for="exampleInputFile">Select Category Image</label>
                                            <div class="input-group">
                                            <div class="custom-file">
                                            <input type="file" name="player_banner" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Select Image</label>
                                            </div>
                                            </div>
                                            </div>
                 
                                             <div class="form-group">
                                             <label for="exampleInputFile1">Select Category Image</label>
                                             <div class="input-group">
                                             <div class="custom-file">
                                             <input type="file" name="player_profile_image" id="exampleInputFile1">
                                             <label class="custom-file-label1" for="exampleInputFile1">Select Image</label>
                                             </div>
                                             </div>
                                            </div>
                 
                
                                             <div class="card-footer">
                                             <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" />
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
