<!-- dropdown.blade.php -->
@extends('admin.layouts.app')
@section('content')
<html>
<style>
select{height: 50px; width: 50px;
color:black;}
option {margin: 10px;}

</style>
    <div class="col s12">
        <div class="container">
            <div class="section">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                        ADD SLIDER
                                    </h4>
                                     <div class="row">
                                        <div class="col s12">
                                          <form method="post" action="{{route('slider-form.store')}}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="form-group">
                                          <label for="exampleInputEmail1">Enter Slider Name</label>
                                          <input type="text" name="slider_name" class="form-control input-lg" required/>
                                          <small class="errorTxt1"></small>
                                          @error('slider_name')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                          </div>

                                          <div class="form-group">
                                            <label for="country">Select Slider Type:</label>
                                            <select name="country" id="country" class="browser-default custom-select" style="width:250px" required data-error=".errorTxt5">
                                            <option selected> </option>
                                            <option value="0"> Home </option>
                                            @foreach ($video as $video)
                                            <option value="{{$video->id}}">{{ $video->category_name }}</option>
                                            @endforeach
                                            <small class="errorTxt5"></small>
                                            @error('video_img')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </select>
                                            </div>

                                            

                                        <div class="form-group">
                                           <label for="state">Select Videos</label>
                                           <select name="state[]" id="testbox"  class="select2 browser-default" multiple="multiple" style="width:250px">
                                           </select>
                                        </div>

                                        


                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Enter Slider Sorting</label>
                                          <input type="text" name="slider_sorting" class="form-control input-lg" required/>
                                          <small class="errorTxt1"></small>
                                          @error('slider_sorting')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
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
  </div>

  $(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
    });

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

     
      <script type="text/javascript">
      $(document).ready(function() {
        var last_valid_selection = null;
        $('#testbox').change(function(event) {
         if ($(this).val().length > 5) {
           alert('You can only choose 5 videos maximum!');
           $(this).val(last_valid_selection);
         } else {
           last_valid_selection = $(this).val();
         }
       });
        
     });
     </script>

     
    
  </body>
</html>

@endsection

