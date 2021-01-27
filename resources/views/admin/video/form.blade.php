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

                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <h2></h2>
                                        <form method="post" class="formValidate" id="formValidate" action="{{route('video-form.store')}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">

                                                <div class="input-field col s12">
                                                    <p for="title_en">Add Video Title EN * </p>
                                                    <input id="title_en" name="title_en" type="text"  required data-error=".errorTxt10">
                                                    <small class="errorTxt10"></small>
                                                    @error('title_en')
                                                    <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="title_ar">Add Video Title AR * </p>
                                                    <input id="title_ar" name="title_ar" type="text"  required data-error=".errorTxt11">
                                                    <small class="errorTxt11"></small>
                                                    @error('title_ar')
                                                    <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_en">Add Video Description EN * </p>
                                                    <input type="text" id="description_en" name="description_en" class="form-control input-lg" required/>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_ar">Add Video Description AR * </p>
                                                    <input type="text" id="description_ar" name="description_ar" class="form-control input-lg" required/>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="video_link">Video Link on Vimeo * </p>
                                                    <input id="video_link" name="video_link" type="url"  required data-error=".errorTxt2">
                                                    <small class="errorTxt2"></small>
                                                    @error('video_link')
                                                    <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="video_sorting">Video Duration * </p>
                                                    <div class="input-field col s1">
                                                        <p for="hour">Hour </p>
                                                        <input type="number" id="hour" name="hour"  min="0" class="form-control input-lg" />
                                                    </div>
                                                    <div class="input-field col s1">
                                                        <p for="Minutes">Minutes </p>
                                                        <input type="number" id="minute" name="minute"  min="0" class="form-control input-lg" />
                                                    </div>
                                                    <div class="input-field col s1">
                                                        <p for="second">Second </p>
                                                        <input type="number" id="second" name="second"  min="0"class="form-control input-lg" required />
                                                    </div>
                                                </div>



                                                <div class="input-field col s12">
                                                    <p for="popularsearches"> Notify User </p>
                                                    <select name="notify_user" class="form-control" style="width:250px">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="video_sorting">Video Sorting </p>
                                                    <input type="number" id="video_sorting" name="video_sorting" min="1" class="form-control input-lg" />
                                                </div>



                                                <div class="input-field col s12">
                                                    <p for="video_banner_img"> Add Video Banner Image </p>
                                                    <input type="file" name="video_banner_img" id="video_banner_img" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                                </div>


                                                <div class="input-field col s12">
                                                    <p for="video_img"> Add Video Image * </p>
                                                    <input type="file" name="video_img" id="video_img" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required data-error=".errorTxt4" />
                                                    <small class="errorTxt4"></small>
                                                    @error('video_img')
                                                    <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                               </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="Category_id"> Select Category * </p>
                                                    <select  class="form-control" name="Category_id" required>
                                                        <option selected> </option>
                                                        @foreach($category as $category)
                                                            <option value="{{$category->id}}">{{$category->name_en}}</option>
                                                        @endforeach
                                                        @error('Category_id')
                                                        <span class="invalid-feedback" role="alert">
                                               <strong class="error">{{ $message }}</strong>
                                               </span>
                                                        @enderror
                                                    </select>
                                                </div>


                                                <div class="input-field col s12">
                                                    <p for="country"> Select League </p>
                                                    <select name="country" id="country" class="form-control" style="width:250px" onclick="ShowHideDiv(this)">
                                                        <option value="">--- Select Leagues ---</option>
                                                        @foreach ($leagues as $leagues)
                                                            <option value="{{$leagues->id}}">{{ $leagues->name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="state">Select Season:</p>
                                                    <select name="state" class="select browser-default" style="width:250px">
                                                    </select>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="genre"> Select Video Genre *</p>
                                                    <select class="selectpicker" multiple data-live-search="true" name="genre[]" required >
                                                        @foreach($videogenres as $videogenre )
                                                            <option value="{{$videogenre->id}}">{{$videogenre->name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('genre')
                                                    <span class="invalid-feedback" role="alert">
                                               <strong class="error">{{ $message }}</strong>
                                               </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="club"> Select Club </p>
                                                    <select class="selectpicker" multiple data-live-search="true" name="club[]">
                                                        @foreach($club as $club )
                                                            <option value="{{$club->id}}">{{$club->name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="player"> Select Player </p>
                                                    <select class="selectpicker" multiple data-live-search="true" name="player[]">
                                                        @foreach($player as $player)
                                                            <option value="{{$player->id}}">{{$player->name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="popularsearches"> Popular Searches </p>
                                                    <select name="popularsearches" class="form-control" style="width:250px">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </div>

                                                <div class="input-field col s12" id="row_dim">
                                                    <p for="promo_video_url">Promo Video URL </p>
                                                    <input type="url" name="video_promo" class="dimension" >
                                                </div>

                                                <div class="input-field col s12" id="row_dim_rquired">
                                                    <p for="promo_video_url">Promo Video URL *</p>
                                                    <input type="url" name="video_promo" class="dimension" required>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light right submit" type="submit" name="action">Submit
                                                    <i class="material-icons right">send</i>
                                                </button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
            jQuery('select[name="country"]').on('change',function(){
                var countryID = jQuery(this).val();
                console.log(countryID);
                if(countryID == '0')
                {

                }
                else
                {
                    jQuery.ajax({
                        url : 'videos/' +countryID,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            jQuery('select[name="state"]').empty();
                            jQuery.each(data, function(key,value){
                                $('select[name="state"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }
            });
        });


    </script>

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
        $(function() {
            $('#row_dim').show();
            $('#row_dim_required').show();
            $('#row_dim').hide();
            $('#row_dim_required').hide();
            $('#country').change(function(){
                // alert($('#country').val());
                if($('#country').val() != '') {
                    $('#row_dim_rquired').hide();
                    $('#row_dim').show();

                } else {
                    $('#row_dim').hide();
                    $('#row_dim_rquired').show();

                }
            });
        });
    </script>


@endsection



