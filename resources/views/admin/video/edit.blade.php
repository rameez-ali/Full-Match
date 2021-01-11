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
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" action="{{ route('video-form.update', $video->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                           <div class="input-field col s12">
                                           <p for="category_image">Add League Name * </p>
                                           <input type="text" name="video_title" value="{{ $video->video_title }}" class="form-control input-lg" required data-error=".errorTxt1" />
                                           <small class="errorTxt1"></small>
                                           @error('video_title')
                                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                           </div>

                                           <div class="input-field col s12">
                                           <p for="category_image">Add Video Description * </p>
                                           <input type="text" name="video_description" value="{{ $video->video_description }}" class="form-control input-lg" />
                                           </div>

                                           <div class="input-field col s12">
                                           <p for="video_link">Add Video Link * </p>
                                           <input type="text" name="video_link" value="{{ $video->video_link }}" class="form-control input-lg" required data-error=".errorTxt2" />
                                           <small class="errorTxt2"></small>
                                           @error('video_link')
                                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                           </div>

                                           <div class="input-field col s12">
                                           <p for="video_duration">Add Video Duration * </p>
                                           <input type="time" name="video_duration" value="{{ $video->video_duration }}" class="form-control input-lg" required data-error=".errorTxt3" />
                                           <small class="errorTxt3"></small>
                                           @error('video_duration')
                                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                           </div>

                                           <div class="input-field col s12">
                                           <p for="category_image"> Notify user * </p>
                                           <input type="text" name="notify_user" value="{{$video->notify_user}}" class="form-control input-lg" />
                                           </div>
                                          
                                           <div class="input-field col s12">
                                           <p for="category_image"> Add Video Sorting * </p>
                                           <input type="text" name="video_sorting" value="{{$video->video_sorting}}" class="form-control input-lg" />
                                           </div>


                                          <div class="input-field col s12">
                                          <p for="category_image"> Add Video Banner * </p>
                                          <input type="file" name="video_banner_img" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/video/'.$video->video_banner_img)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                          <input type="hidden" name="hidden_image1" value="{{ $video->video_banner_img }}" />
                                          </div>
                                        
                                          <div class="input-field col s12">
                                          <p for="category_image"> Add Video Image * </p>
                                          <input type="file" name="video_img" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/video/'.$video->video_img)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                          <input type="hidden" name="hidden_image2" value="{{ $video->video_img }}" />
                                          <!-- <small class="errorTxt4"></small>
                                          @error('video_img')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror -->
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
                                         <label><strong>Select Genre </strong></label><br/>
                                         <select class="selectpicker" multiple data-live-search="true" name="genre[]">
                                         @foreach($video_genres as $videogenre )
                                         <option value="{{$videogenre->id}}" {{in_array($videogenre->id, $selected_ids3) ? 'selected' : ''}} >{{$videogenre->genre_name}}</option>
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
