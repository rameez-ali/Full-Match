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
                                           <p for="category_image">Edit League Name * </p>
                                           <input type="text" name="video_title" value="{{ old('video_title',$video->video_title) }}" class="form-control input-lg" required data-error=".errorTxt1" />
                                           <small class="errorTxt1"></small>
                                           @error('video_title')
                                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                           </div>

                                           <div class="input-field col s12">
                                           <p for="category_image">Edit Video Description </p>
                                           <input type="text" name="video_description" value="{{ old('video_description',$video->video_description) }}" class="form-control input-lg" />
                                           </div>

                                           <div class="input-field col s12">
                                           <p for="video_link">Edit Video Link on Vimeo * </p>
                                           <input type="url" name="video_link" value="{{ old('video_link',$video->video_link) }}" class="form-control input-lg" required data-error=".errorTxt2" />
                                           <small class="errorTxt2"></small>
                                           @error('video_link')
                                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                           </div>

                                           <div class="input-field col s12">
                                              <p for="video_sorting">Edit Video Duration * </p>
                                              <div class="input-field col s1">
                                              <p for="hour">Hour </p>
                                              <input type="number" id="hour"  min="0" name="hour" value="{{ old('hour',$video->hour) }}" min="0" class="form-control input-lg"/>
                                              </div>
                                              <div class="input-field col s1">
                                              <p for="Minutes">Minutes </p>
                                              <input type="number" id="minute"  min="0" name="minute" value="{{ old('minute',$video->minute) }}" min="1" class="form-control input-lg"  />
                                              </div>
                                              <div class="input-field col s1">
                                              <p for="second">Second </p>
                                              <input type="number" id="second"  min="0" name="second" value="{{ old('second',$video->second) }}" min="0" class="form-control input-lg" required />
                                              </div>
                                           </div>
                                        

                            
                                          
                                           <div class="input-field col s12">
                                           <p for="category_image"> Edit Video Sorting </p>
                                           <input type="number" name="video_sorting" value="{{ old('video_sorting',$video->video_sorting) }}" min="1" class="form-control input-lg" />
                                           </div>


                                          <div class="input-field col s12">
                                          <p for="category_image"> Edit Video Banner </p>
                                          <input type="file" name="video_banner_img" value="{{ old('video_banner_img',$video->video_banner_img) }}" class="dropify mt-3"  data-default-file="{{ asset('app-assets/images/video/'.$video->video_banner_img)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />

                                          </div>
                                        
                                          <div class="input-field col s12">
                                          <p for="category_image"> Edit Video Image * </p>
                                          <input type="file" name="video_img" value="{{ old('video_img',$video->video_img) }}" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/video/'.$video->video_img)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg"/>
                                          </div>

                                          <div name="hidden-panel1" id="hidden-panel1">
                                          <label><strong>Edit Category * </strong></label><br/>
                                          <select class="form-control input-lg" name="Category_id"  required>
                                          @foreach($category as $category )
                                          <option value="{{$category->id}}">{{$category->category_name}}</option>
                                          @endforeach
                      
                                          @error('Category_id')
                                          <small class="errorTxt7"></small>
                                          <span class="invalid-feedback" role="alert">
                                          <strong class="error">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                         </select>
                                         </div>

                                         <div name="hidden-panel1" id="hidden-panel1">
                                         <label><strong>Edit Genre * </strong></label><br/>
                                         <select class="form-control input-lg" multiple data-live-search="true" name="genre[]"  required>
                                         @foreach($video_genres as $videogenre )
                                         <option value="{{$videogenre->id}}" {{in_array($videogenre->id, $selected_ids3) ? 'selected' : ''}} >{{$videogenre->genre_name}}</option>
                                         @endforeach
                                         </select>
                                         
                                         @error('genre')
                                          <small class="errorTxt8"></small>
                                          <span class="invalid-feedback" role="alert">
                                          <strong class="error">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                         </div>


                                         <div name="hidden-panel1" id="hidden-panel1">
                                         <label><strong>Edit club </strong></label><br/>
                                         <select class="selectpicker" multiple data-live-search="true" name="club[]">
                                         @foreach($club as $club)
                                         <option value="{{$club->id}}" {{in_array($club->id, $selected_ids) ? 'selected' : ''}} >{{$club->club_name}}</option>
                                          @endforeach
                                         </select>
                                         </div>

                                         <div name="hidden-panel1" id="hidden-panel1">
                                         <label><strong>Edit Player </strong></label><br/>
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
                genre: {
                    required: true,
                    minlength: 5 ,
                },
                tnc_select: "required",
            },
            //For custom messages
            messages: {
                genre: {
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
