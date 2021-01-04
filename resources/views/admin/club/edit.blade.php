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
                                        Edit Club
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" action="{{ route('club-form.update', $club->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                       <div class="form-group">
                                       <label class="col-md-4 text-right">Add Category Name</label>
                                       <div class="col-md-8">
                                       <input type="text" name="club_name" value="{{ $club->club_name }}" class="form-control input-lg" />
                                       </div>
                                       </div>
                                       <div class="form-group">
                                       <label class="col-md-4 text-right">Enter Description Name</label>
                                       <div class="col-md-8">
                                       <input type="text" name="club_description" value="{{ $club->club_description }}" class="form-control input-lg" />
                                       </div>
                                       </div>
                                       <div class="form-group">
                                       <label class="col-md-4 text-right">Select Player Banner</label>
                                       <div class="col-md-8">
                                       <input type="file" name="club_banner" />
                                       <input type="hidden" name="hidden_image1" value="{{ $club->club_banner }}" />
                                       </div>
                                       </div>
                                       <div class="form-group">
                                       <label class="col-md-4 text-right">Select Club Logo</label>
                                       <div class="col-md-8">
                                       <input type="file" name="club_logo" />
                                       <input type="hidden" name="hidden_image2" value="{{ $club->club_logo }}" />
                                       </div>
                                       </div>
                                       <div class="form-group">
                                       <label class="col-md-4 text-right">Add Category Sorting</label>
                                       <div class="col-md-8">
                                       <input type="text" name="club_name" value="{{ $club->club_sorting }}" class="form-control input-lg" />
                                       </div>
                                       </div>
                                       <br /><br />
                                       <div class="form-group text-center">
                                       <input type="submit" name="edit" class="btn btn-primary input-lg" value="Submit" />
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
