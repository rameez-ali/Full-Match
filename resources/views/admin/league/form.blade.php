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
                                        ADD LEAGUE
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">ADD</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                       <h2></h2>
                                       <form method="post" action="{{ route('league-form.store') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-body">
                                       <div class="form-group">
                                       <label for="exampleInputEmail1">Enter League Name</label>
                                       <input type="text" name="league_name" class="form-control input-lg"></textarea>
                                       </div>
                                       <br/>
                
                                      
                
                                        <div class="form-group">
                                        <label for="exampleInputFile">Insert League Banner</label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name="filename1" multiple id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Select Image</label>
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                         <div class="form-group">
                                        <label for="exampleInputFile">Insert League Promovideo</label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name="filename2" multiple id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Select Image</label>
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                         <div class="form-group">
                                        <label for="exampleInputFile">Insert Profile Image</label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name="filename3" multiple id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Select Image</label>
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                         

                                        <div class="card-body">
                                       <div class="form-group">
                                       <label for="exampleInputEmail1">Enter Description </label>
                                       <input type="text" name="league_description" class="form-control input-lg"></textarea>
                                       </div>
                                       <br/>

                  
                                        <div class="form-group">
                                        <label for="exampleInputFile">Insert Season 1 Videos </label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name=filename4[] multiple id="exampleInputFile10">
                                        <label class="custom-file-label10" for="exampleInputFile10">Select Image</label>
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                          <div class="form-group">
                                        <label for="exampleInputFile">Insert Season 2 Videos </label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name=filename5[] multiple id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Select Image</label>
                                        </div>
                                        </div>
                                        </div>
                                         <br/>
             </div>
                <br />
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
