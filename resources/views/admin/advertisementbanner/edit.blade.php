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
                                        Edit Banner
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" action="{{ route('banner-form.update', $slider->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="row">
                                            <div class="input-field col s12">
                                            <p for="title_en">Edit Video Title EN *  </p>
                                            <input type="text" name="title_en" id="title_en" value="{{ $slider->title_en }}" class="form-control input-lg" required />
                                            </div>

                                            <div class="input-field col s12">
                                                <p for="title_ar">Edit Video Title AR *  </p>
                                                <input type="text" name="title_ar" id="title_ar" value="{{ $slider->title_ar }}" class="form-control input-lg" required />
                                            </div>

                                            <div class="input-field col s12">
                                                <p for="category_image">Edit Video Banner  </p>

                                            <input type="file" name="video_banner" class="dropify mt-3"  value="{{ $slider->video_banner }}"  data-default-file="{{ asset('app-assets/images/advbanner/'.$slider->video_banner)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg"/>

                                             </div>

                                            <div class="input-field col s12">
                                            <p for="category_image">Edit Video Link  </p>
                                            <input type="url" name="video_link" value="{{ $slider->video_link}}" class="form-control input-lg" />
                                            </div>


                                            <div class="input-field col s12">
                                          <label><strong>Edit Genre </strong></label><br/>
                                          <select name="genre">
                                          <option selected> </option>
                                          @foreach($videogenre as $videogenre )
                                          <option value="{{$videogenre->id}}" {{$videogenre->id == $select_genre_id->genre_id ? 'selected' : ''}} >{{$videogenre->name_en}}</option>
                                          @endforeach
                                          </select>
                                          </div>

                                            <div class="input-field col s12">
                                          <label><strong>Edit Videos </strong></label><br/>
                                          <select name="state" class="select browser-default" style="width:250px">
                                          @foreach($video1 as $video )
                                          <option value="{{$video->id}}" {{$video->id == $select_video_id->video_id ? 'selected' : ''}}  >{{$video->title_en}}</option>
                                          @endforeach
                                          </select>
                                          </div>

                                          <div class="input-field col s12">
                                          <p for="category_image">Edit Homepage * </p>
                                          <select name="homepage" id="country" class="form-control" style="width:250px">
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
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
    <script src="app-assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src={{ asset('app-assets/js/scripts/form-file-uploads.js') }}></script>
    <script src={{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}></script>
<script>
    /*
 * Form Validation
 */

    $("#title_en").keyup(function(){
        $("#title_ar").val(this.value);
    });


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
