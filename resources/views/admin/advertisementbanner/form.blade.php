<!-- dropdown.blade.php -->
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
                                        ADD ADVERTISEMENT BANNER
                                    </h4>
                                     <div class="row">
                                        <div class="col s12">
                                          <form method="post" action="{{route('banner-form.store')}}" enctype="multipart/form-data">
                                          @csrf

                                          <div class="row">

                                             <div class="input-field col s12">
                                             <p for="title_en">Add Video Title EN * </p>
                                             <input id="title_en" name="title_en" id="title_en" type="text" required>
                                             </div>

                                              <div class="input-field col s12">
                                                  <p for="title_ar">Add Video Title AR * </p>
                                                  <input id="title_ar" name="title_ar" id="title_ar" type="text" required>
                                              </div>

                                              <div class="input-field col s12">
                                              <p for="video_banner"> Add Video Banner </p>
                                              <input type="file" name="video_banner" id="video_banner" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg"  />
                                              </div>

                                             <div class="input-field col s12">
                                             <p for="video_link">Add Video Link </p>
                                             <input id="video_link" name="video_link" type="url">
                                             </div>



                                            <div class="input-field col s12">
                                            <p for="country">Select Category:</p>
                                            <select name="country" id="country" class="form-control" style="width:250px">
                                            <option selected> </option>
                                            @foreach ($video as $video)
                                            <option value="{{$video->id}}">{{ $video->name_en }}</option>
                                            @endforeach
                                            </select>
                                            </div>

                                              <div class="input-field col s12">
                                                  <p for="state">Select Video:</p>
                                                  <select name="state" class="select browser-default" style="width:250px">
                                                  </select>
                                              </div>

                                            <div class="input-field col s12">
                                            <p for="genre">Add Video Genre </p>
                                            <select name="genre" class="form-control" style="width:250px">
                                            <option selected value="0">All Genres </option>
                                            @foreach ($videogenre as $videogenre)
                                            <option value="{{$videogenre->id}}">{{ $videogenre->name_en }}</option>
                                            @endforeach
                                            </select>
                                            </div>




                                             <div class="input-field col s12">
                                             <p for="homepage">Home Page </p>
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
        <div class="content-overlay"></div>
    </div>

@endsection
@section('scripts')
    <script src={{ asset('app-assets/vendors/jquery-validation/jquery.validate.min.js') }}></script>
    <script src={{ asset('app-assets/js/scripts/form-file-uploads.js') }}></script>
    <script src={{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}></script>



<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="country"]').on('change',function(){
               var countryID = jQuery(this).val();
               console.log(countryID);
               if(countryID == '0')
               {
                  jQuery.ajax({
                     url : 'allvideos/' +countryID,
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
            $("#title_en").keyup(function(){
                $("#title_ar").val(this.value);
            });
        </script>
  </body>
</html>
@endsection
