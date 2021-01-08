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
                                          <div class="form-group">
                                          <label for="exampleInputEmail1">Enter Video Title</label>
                                          <input type="text" name="video_title" class="form-control input-lg" />
                                          </div>



                                           <div class="form-group">
                                            <div class="input-group">
                                            <div class="custom-file">
                                            <label>Video Banner </label>
                                            <input type="file" name="video_banner" Placeholder="Video Banner" id="exampleInputFile">
                                            <small class="errorTxt1"></small>
                                           @error('club_banner')
                                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                            </div>
                                            </div>
                                            </div><br>

                                            <div class="form-group">
                                          <label for="exampleInputEmail1">Enter Video Link</label>
                                          <input type="text" name="video_link" class="form-control input-lg" />
                                          </div>


                                          <div class="form-group">
                                            <label for="country">Select Type:</label>
                                            <select name="country" id="country" class="form-control" style="width:250px">
                                            <option value="">--- Select Categories ---</option>
                                            @foreach ($video as $video)
                                            <option value="{{$video->id}}">{{ $video->category_name }}</option>
                                            @endforeach
                                            </select>
                                            </div>

                                        <div class="form-group">
                                            <label for="country">Select Genre</label>
                                            <select name="genre" class="form-control" style="width:250px">
                                            @foreach ($videogenre as $videogenre)
                                            <option value="{{$videogenre->id}}">{{ $videogenre->genre_name }}</option>
                                            @endforeach
                                            </select>
                                            </div>

                                        <div class="form-group">
                                           <label for="state">Select Videos</label>
                                           <select name="state[]" class="select2 browser-default" multiple style="width:250px">
                                           </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="country">Homepage</label>
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
                        jQuery('select[name="state[]"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="state[]"]').append('<option value="'+ key +'">'+ value +'</option>');
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
                        jQuery('select[name="state[]"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="state[]"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
            });
    });
     </script>
  </body>
</html>

@endsection
@section('scripts')
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />



@endsection
