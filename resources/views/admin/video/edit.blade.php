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
                                        Edit Video
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Details</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" action="{{ route('video-form.update', $video->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                         <div class="form-group">
                                         <label for="exampleInputEmail1">Enter Video Title</label>
                                         <input type="text" name="video_title" value="{{$video->video_title}}" class="form-control input-lg" />
                                         </div>

                            <div class="form-group">
                             <label for="exampleInputEmail1">Enter Description </label>
                             <input type="text" name="video_description" value="{{$video->video_description}}" class="form-control input-lg" />  
                            </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Enter link </label>
                            <input type="text" name="video_link" value="{{$video->video_link}}" class="form-control input-lg" />
                            </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Enter duration </label>
                            <input type="text" name="video_duration" value="{{$video->video_duration}}" class="form-control input-lg" />
                            </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Notify user </label>
                            <input type="text" name="notify_user" value="{{$video->notify_user}}" class="form-control input-lg" />
                            </div>

                             <div class="form-group">
                            <label for="exampleInputEmail1">Video Sorting </label>
                            <input type="text" name="video_sorting" value="{{$video->video_sorting}}" class="form-control input-lg" />
                            </div>


                                        <div class="form-group">
                                       <label class="col-md-4 text-right">Select Player Banner</label>
                                       <div class="col-md-8">
                                       <input type="file" name="video_banner_img" />
                                       <input type="hidden" name="hidden_image1" value="{{ $video->video_banner_img }}" />
                                       </div>
                                       </div>

                                         <div class="form-group">
                                       <label class="col-md-4 text-right">Select Player Banner</label>
                                       <div class="col-md-8">
                                       <input type="file" name="video_img" />
                                       <input type="hidden" name="hidden_image2" value="{{ $video->video_img }}" />
                                       </div>
                                       </div>

                                        <div name="hidden-panel1" id="hidden-panel1">
                                        <label><strong>Select club </strong></label><br/>
                                        <select class="browser-default custom-select" name="Category_id">
                                        @foreach($category as $category )
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                        </select>
                                        </div>

                                         <div name="hidden-panel1" id="hidden-panel1">
                                       <label><strong>Select club </strong></label><br/>
                                       <select class="selectpicker" multiple data-live-search="true" name="club[]">
                                       @foreach($club as $club )
                                       <option value="{{$club->id}}" {{in_array($club->id, $selected_ids) ? 'selected' : ''}} >{{$club->club_name}}</option>
                                       @endforeach
                                       </select>
                                       </div>

                                       <div name="hidden-panel1" id="hidden-panel1">
                                       <label><strong>Select Player </strong></label><br/>
                                       <select class="selectpicker" multiple data-live-search="true" name="player[]">
                                       @foreach($player as $player )
                                       <option value="{{$player->id}}" {{in_array($player->id, $selected_ids1) ? 'selected' : ''}} >{{$player->player_name}}</option>
                                       @endforeach
                                       </select>
                                       </div>

                                           

                                       
                                       <br /><br />
                                       <div class="form-group text-center">
                                       <input type="submit" name="edit" class="btn btn-primary input-lg" value="Edit" />
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

$(document).ready(function() {
        $("#travel").change(function() {
            if ($("#travel").val() == 1) {
                $("#hidden-panel1").hide()
                $("#hidden-panel").show()
            } 
            else if ($("#travel").val() == 2) {
                $("#hidden-panel").hide()
                $("#hidden-panel1").show()
            } 
            else if ($("#travel").val() == 0){
                $("#hidden-panel").hide()
                $("#hidden-panel1").hide()
            }
        })
    }); 


</script>
@endsection
