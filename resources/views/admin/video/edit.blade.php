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
                                           <p for="title_en">Edit Video Title EN * </p>
                                           <input type="text" name="title_en" id="title_en" value="{{ old('title_en',$video->title_en) }}" class="form-control input-lg" required data-error=".errorTxt10" />
                                           <small class="errorTxt10"></small>
                                           @error('title_en')
                                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                           </div>

                                            <div class="input-field col s12">
                                                <p for="title_ar">Edit Video Title AR * </p>
                                                <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar',$video->title_ar) }}" class="form-control input-lg" required data-error=".errorTxt11" />
                                                <small class="errorTxt11"></small>
                                                @error('title_ar')
                                                <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                                @enderror
                                            </div>

                                           <div class="input-field col s12">
                                           <p for="description_en">Edit Video Description EN  </p>
                                           <input type="text" name="description_en" id="description_en" value="{{ old('description_en',$video->description_en) }}" class="form-control input-lg"  />
                                           </div>

                                            <div class="input-field col s12">
                                                <p for="description_ar">Edit Video Description AR  </p>
                                                <input type="text" name="description_ar" id="description_ar" value="{{ old('description_ar',$video->description_ar) }}" class="form-control input-lg"  />
                                            </div>

                                           <div class="input-field col s12">
                                           <p for="video_link">Edit Video Link on Vimeo * </p>
                                           <input type="url" name="video_link" value="{{ old('video_link',$video->video_link) }}" required data-error=".errorTxt2" />
                                           <small class="errorTxt2"></small>
                                           @error('video_link')
                                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                           </div>

                                           <div class="input-field col s12">
                                              <p for="video_id">Edit Video Id * </p>
                                              <input type="number" id="video_id"  name="video_id" value="{{ old('video_id',$video->video_id) }}" class="form-control input-lg" required/>
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

                                           @if($select_category_id!=null)
                                            <div class="input-field col s12">
                                                  <label><strong>Edit Category </strong></label><br/>
                                                  <select class="selectpicker" name="Category_id" required>
                                                      @foreach($category as $category )
                                                          <option value="{{$category->id}}" {{$category->id == $select_category_id->category_id ? 'selected' : ''}} >{{$category->name_en}}</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                        @else
                                            <div class="input-field col s12">
                                                <label><strong>Edit Category </strong></label><br/>
                                                <select class="selectpicker" name="Category_id" required>
                                                        <option SELECTED value="" >Home</option>
                                                </select>
                                            </div>
                                        @endif


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
                                         @foreach($all_genres as $videogenre )
                                         <option value="{{$videogenre->id}}" {{in_array($videogenre->id, $selected_ids3) ? 'selected' : ''}} >{{$videogenre->name_en}}</option>
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
                                                <label><strong>Edit Popular Searches </strong></label><br/>
                                                <select class="selectpicker" name="popularsearches">
                                                    @foreach($popular_searches as $popular_search )
                                                        <option value="{{$popular_search->id}}" {{$popular_search->id == $selected_popular_search->popular_searches ? 'selected' : ''}} >{{$popular_search->status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                         <div name="hidden-panel1" id="hidden-panel1">
                                         <label><strong>Edit club </strong></label><br/>
                                         <select class="selectpicker" multiple data-live-search="true" name="club[]">
                                         @foreach($club as $club)
                                         <option value="{{$club->id}}" {{in_array($club->id, $selected_ids) ? 'selected' : ''}} >{{$club->name_en}}</option>
                                          @endforeach
                                         </select>
                                         </div>

                                         <div name="hidden-panel1" id="hidden-panel1">
                                         <label><strong>Edit Player </strong></label><br/>
                                         <select class="selectpicker" multiple data-live-search="true" name="player[]">
                                         @foreach($player as $player )
                                         <option value="{{$player->id}}" {{in_array($player->id, $selected_ids1) ? 'selected' : ''}} >{{$player->name_en}}</option>
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

    <script>
        $("#title_en").keyup(function(){
            $("#title_ar").val(this.value);
        });
        $("#description_en").keyup(function(){
            $("#description_ar").val(this.value);
        });
    </script>

@endsection
