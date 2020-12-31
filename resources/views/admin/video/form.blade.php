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
                                        ADD VIDEO
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">ADD</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                            <form method="post" action="{{route('video-form.store')}}" enctype="multipart/form-data">
                            @csrf
                            
                            
                            <div class="form-group">
                             <label for="exampleInputEmail1">Enter Video Title</label>
                             <input type="text" name="video_title" class="form-control input-lg" />
                            </div>

                            <div class="form-group">
                             <label for="exampleInputEmail1">Enter Description </label>
                             <input type="text" name="video_description" class="form-control input-lg" />  
                            </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Enter link </label>
                            <input type="text" name="video_link" class="form-control input-lg" />
                            </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Enter duration </label>
                            <input type="text" name="video_duration" class="form-control input-lg" />
                            </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Notify user </label>
                            <input type="text" name="notify_user" class="form-control input-lg" />
                            </div>


                  <div class="form-group">
                   <label for="exampleInputFile">Select Banner Image</label>
                    <div class="input-group">
                    <div class="custom-file">
                    <input type="file" name="video_banner_img" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Select Image</label>
                    </div>
                    </div>
                   </div>

                   <div class="form-group">
                   <label for="exampleInputFile1">Select  Image</label>
                    <div class="input-group">
                    <div class="custom-file">
                    <input type="file" name="video_img" id="exampleInputFile1">
                    <label class="custom-file-label" for="exampleInputFile1">Select Image</label>
                    </div>
                    </div>
                   </div>

                              <div class="form-group">
                              <label for="exampleInputEmail1">Select Category</label>
                              <select  class="browser-default custom-select" name="Category_id">
                              <option selected> Select Category </option>
                              @foreach($category as $category)
                              <option value="{{$category->id}}">{{$category->category_name}}</option>
                              @endforeach
                              </div>

                              <div class="form-group">
                              <label for="exampleInputEmail2"></label>
                              <select  class="browser-default custom-select" name="">
                              <option selected></option>
                              </div>

                            <div class="form-group">
                              <label><strong>Select Club </strong></label><br/>
                              <select class="selectpicker" multiple data-live-search="true" name="club[]">
                              @foreach($club as $club )
                              <option value="{{$club->id}}">{{$club->club_name}}</option>
                              @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label><strong>Select Player </strong></label><br/>
                              <select class="selectpicker" multiple data-live-search="true" name="player[]">
                              @foreach($player as $player)
                              <option value="{{$player->id}}">{{$player->player_name}}</option>
                              @endforeach
                              </select>
                            </div>


                            
                            <div class="text-center" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success">Save</button>
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
