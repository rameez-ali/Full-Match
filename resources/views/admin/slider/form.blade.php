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
                                        ADD SLIDER
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">ADD</a>
                                    </h4>
                                     <div class="row">
                                        <div class="col s12">
                                          <form method="post" action="{{route('slider-form.store')}}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="form-group">
                                          <label for="exampleInputEmail1">Enter Slider Name</label>
                                          <input type="text" name="slider_name" class="form-control input-lg" />
                                          </div>

                                          <div class="form-group">
                                            <label for="country">Select Type:</label>
                                            <select name="country" id="country" class="form-control" style="width:250px">
                                            <option value="">--- Select Categories ---</option>
                                            <option value="0"> Home </option>
                                            @foreach ($video as $video)
                                            <option value="{{$video->id}}">{{ $video->category_name }}</option>
                                            @endforeach
                                            </select>
                                            </div>

                                        <div class="form-group">
                                           <label for="state">Select Videos</label>
                                           <select name="state[]" class="select2 browser-default" multiple style="width:250px">
                                           </select>
                                        </div>

                                         <div class="text-center" style="margin-top: 10px;">
                                          <button type="submit" class="btn btn-success">Save</button>
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
