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
                                        Update Category Genre
                                    </h4>
                                     <div class="row">
                                        <div class="col s12">
                                          <form method="post" action="{{route('update-category-genre.store')}}" enctype="multipart/form-data">
                                          @csrf
                                          

                                          <div class="input-field col s12">
                                            <p for="category_id">Select Category: * </p>
                                            <select name="category_id" id="category_id"  style="width:250px" required>
                                            <option selected> </option>
                                            @foreach ($category as $category)
                                            <option value="{{$category->id}}">{{ $category->name_en }}</option>
                                            @endforeach
                                            </select>
                                            </div>

                                            <div class="input-field col s12">
                                                <p for="genre_id[]">Select Genres * </p>
                                                <select name="genre_id[]" id="category_id"  class="select2 browser-default" multiple="multiple" style="width:250px" required>
                                                </select>
                                            </div>

                                            <div class="input-field col s12">
                                            <p for="video_id">Select Video: * </p>
                                            <select name="video_id[]" id="video_id"  class="select2 browser-default" multiple="multiple" style="width:250px" required >
                                            @foreach ($video as $video)
                                            <option value="{{$video->id}}">{{ $video->title_en }}</option>
                                            @endforeach
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
  </div>

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

</body>
</html>

@endsection

