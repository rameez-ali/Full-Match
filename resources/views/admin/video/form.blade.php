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
                                                    <p for="description_en">Add Video Description EN  </p>
                                                    <input type="text" id="description_en" name="description_en" class="form-control input-lg" />
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_ar">Add Video Description AR  </p>
                                                    <input type="text" id="description_ar" name="description_ar" class="form-control input-lg" />
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
                                                    <p for="video_id">Video Id * </p>
                                                        <input type="number" id="video_id" name="video_id"  class="form-control input-lg" required />
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
                                                </div>


                                                <div class="input-field col s12">
                                                    <p for="category_id"> Select Category </p>
                                                    <select name="category_id" id="category_id" class="form-control" style="width:250px">
                                                        <option value="">--- Select Category ---</option>
                                                        @foreach ($category as $category)
                                                            <option value="{{$category->id}}">{{ $category->name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-field col s12">
                                                <p for="category_id">Select Genres </p>
                                                <select name="genre_id[]" id="category_id"  class="max-length browser-default" multiple="multiple" style="width:250px">
                                                </select>
                                                </div>


                                                <div class="input-field col s12">
                                                    <p for="league_id"> Select League </p>
                                                    <select name="league_id" id="league_id" class="form-control" style="width:250px" onclick="ShowHideDiv(this)">
                                                        <option value="">--- Select Leagues ---</option>
                                                        @foreach ($leagues as $leagues)
                                                            <option value="{{$leagues->id}}">{{ $leagues->name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="season_id">Select Season:</p>
                                                    <select name="season_id" class="select browser-default" style="width:250px">
                                                    </select>
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
                                                        <option value="1">No</option>
                                                        <option value="2">Yes</option>
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
            jQuery('select[name="league_id"]').on('change',function(){
                var league_id = jQuery(this).val();
                console.log(league_id);
                if(league_id == '0')
                {

                }
                else
                {
                    jQuery.ajax({
                        url : 'seasons/' +league_id,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            jQuery('select[name="season_id"]').empty();
                            jQuery.each(data, function(key,value){
                                $('select[name="season_id"]').append('<option value="'+ key +'">'+ value +'</option>');
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
            $('#league_id').change(function(){
                // alert($('#country').val());
                if($('#league_id').val() != '') {
                    $('#row_dim_rquired').hide();
                    $('#row_dim').show();

                } else {
                    $('#row_dim').hide();
                    $('#row_dim_rquired').show();

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

<script type="text/javascript">

jQuery(document).ready(function ()
{
        jQuery('select[name="genre_id[]"]').empty();
        jQuery('select[name="category_id"]').on('change',function(){
            jQuery('select[name="genre_id[]"]').empty();
           var category_id = jQuery(this).val();
           console.log(category_id);
           jQuery('select[name="genre_id[]"]').empty();
              jQuery.ajax({
                 url : 'getgenres/' +category_id,
                 type : "GET",
                 dataType : "json",
                 success:function(data) {
                     console.log(data);
                     jQuery('select[name="genre_id[]"]').empty();
                     jQuery.each(data, function (key, value) {
                         $('select[name="genre_id[]"]').append('<option value="' + key + '">' + value + '</option>');
                     });
                    
                 }
              });
        });
});
 </script>



@endsection



