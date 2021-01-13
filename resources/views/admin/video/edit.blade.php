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
                                        <form method="post" action="{{ route('video-form.update', $video->id) }}" class="formValidate" id="formValidate" enctype="multipart/form-data">
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
                                           <p for="category_image">Add Video Description </p>
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
                                           <p for="category_image"> Add Video Sorting * </p>
                                           <input type="text" name="video_sorting" value="{{$video->video_sorting}}" class="form-control input-lg" />
                                           </div>


                                          <div class="input-field col s12">
                                          <p for="category_image"> Add Video Banner </p>
                                          <input type="file" name="video_banner_img" value="{{ $video->video_banner_img }}" class="dropify mt-3"  data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />

                                          </div>
                                        
                                          <div class="input-field col s12">
                                          <p for="category_image"> Add Video Image * </p>
                                          <input type="file" name="video_img" value="{{ $video->video_img }}" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required/>
                                          </div>

                                          <div name="hidden-panel1" id="hidden-panel1">
                                          <label><strong>Select Category </strong></label><br/>
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
                video_img: {
                    required: true,
                    minlength: 5
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
