@extends('admin.layouts.app')

@section('content')
<style>
table, th, td {
  border-bottom: 1px solid ;
  background-color: none;
}

table {
  width: 100%;
}
</style>

    <div class="col s12">
        <div class="container">
            <div class="section">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                        Video Filter

                                    </h4>

                                     <form action="{{route('videofilter.search')}}" method="post" role="search">
                                    {{ csrf_field() }}
                                    <div class="input-field col s12">

                                        <input type="text" class="form-control" name="q"
                                               placeholder="Search Video by video title, player name or club name"> <span class="input-group-btn">
                                                <button type="submit" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">Search Videos
                                                   <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                                  </span>

                                    </div>
                                </form>

                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                         <div class="form-group">
                                         <select id="country" name="category_id"  >
                                         <option value="" selected>--Select Filter By--</option>
                                         <option value="0">By Category</option>
                                         <option value="1">By Genre</option>
                                         <option value="2">By Club</option>
                                         <option value="3">By Player</option>
                                         <option value="4">By League</option>
                                         </select>
                                         </div>
                                      
                                         <div>
                                         <select name="state" class="select2 browser-default hide" id="category_video" multiple="multiple">
                                         </select>

                                         </div>

                                         <div>
                                         <select name="state" class="select2 browser-default hide" id="genre_video" multiple="multiple">
                                         </select>
                                         </div>

                                         <div>
                                         <select name="state" class="browser-default custom-select hide" id="club_video" >
                                         </select>
                                         </div>

                                         <div>
                                         <select name="state" class="browser-default custom-select hide" id="player_video" >
                                         </select>
                                         </div>

                                         <div>
                                         <select name="state" class="browser-default custom-select hide" id="league_video" >
                                         </select>
                                         </div>

                                         <div>
                                         <select name="state" class="browser-default custom-select hide" id="season_video" >
                                         </select>
                                         </div>
<<<<<<< HEAD
                                          
                                          <form id="" action="{{ route('exportexcel') }}" method="POST" >
                                          @CSRF
                                         <div name="name" id="name2">
                                         </div>
                                          <button class="btn btn-success" id="submit">EXCEL</button>
                                          </form> 
                                        
                                         <div >
                                         

                                         <table id="orignal_table" class="display">
                                            <thead>
                                            <tr>
                                                <th width="20%">Title</th>
                                                <th width="20%">Description</th>
                                                <th width="20%">Link</th>
                                                <th width="20%">Sorting</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($video as $video)
                                                @if($video!=null)
                                                <tr>
                                                    <td>{{ $video->title_en }}</td>
                                                     <td>{{ substr_replace(strip_tags($video->description_en,'description'), "...", 20) }}</td>
                                                    <td>{{ substr_replace(strip_tags($video->video_link,'link'), "...", 20) }}</td>
                                                    <td>{{ $video->video_sorting}}</td>
                                                    <td><form action="{{ route('video-form.destroy', $video->id)}}" method="post">
                                                            @can('view-videodetail')
                                                            <a href="{{ url('videodetails/'.$video->id)}}" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">Details</a>
                                                            @endcan
                                                                @can('edit-video')
                                                                <a href="{{ route('video-form.edit',$video->id)}}" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">Edit</a>
                                                                @endcan
                                                                    {{ csrf_field() }}
                                                                @can('delete-video')
                                                            @method('DELETE')
                                                            <button onclick="return window.confirm('Are you sure you want to delete this record?');" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow" type="submit">Delete</button>
                                                             @endcan
                                                        </form>
                                                    </td>

                                                </tr>
                                                @endif
                                            @endforeach

                                            </tbody>
                                            </tbody>
                                        </table>

                                         <div>
                                         <table  id="ajax_table" class="striped display hide">
                                           <thead>
                                            <tr>
                                                <th width="20%">Title</th>
                                                <th width="20%">Description </th>
                                                <th width="20%">Link</th>
                                                <th width="20%">Sorting</th>
                                                <th width="50%">Action</th>
                                            </tr>
                                            </thead>
                                         </table>

                                         </div>
=======

                                        
                                         <div >
                                         <label for="title">Select Season:</label>
                                         <table class="striped" name="state[]">
                                         </table>
                                         
                                         <form id="exportcsv">
                                         <div name="name" id="name1">
                                         </div>
                                          <button class="btn btn-success" id="submit">CSV</button>
                                          </form>

                                          <form id="exportexcel">
                                         <div name="name" id="name2">
                                         </div>
                                          <button class="btn btn-success" id="submit">EXCEL</button>
                                          </form>                                         
                                         

                                         </div>
>>>>>>> f12f47d2746fff926c3954fc3dc2543bfc03bfb3

                                         </div>
                                         

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


  <!----Start of logic to Get Category,Clubs,Player,Genre name------>


<<<<<<< HEAD

=======
<script type="text/javascript">
    $('#exportexcel').on('submit',function(event){
        event.preventDefault();
        var name = $('#exportexcel').serializeArray();
        $.ajax({
          url: "{{url('exportexcel')}}",
          type:"GET",
          data:{
            "name":name,
          },
          success:function(response){
            console.log(response);
          },
         });
        });
</script>
>>>>>>> f12f47d2746fff926c3954fc3dc2543bfc03bfb3

<script type="text/javascript">
    $('#exportcsv').on('submit',function(event){
        event.preventDefault();
        var name = $('#exportcsv').serializeArray();
        $.ajax({
          url: "{{url('exportcsv')}}",
          type:"GET",
          data:{
            "name":name,
          },
          success:function(response){
            console.log(response);
          },
         });
        });
</script>


  <script type=text/javascript>
  $('#country').change(function(){
  var countryID = $(this).val();
  if(countryID=="0"){
    $.ajax({
      type:"GET",
      url:"{{url('bycategory')}}?country_id="+countryID,
      success:function(res){
      if(res){
        $("#category_video").removeClass('hide');
        $("#category_video1").removeClass('hide');
        $("#genre").hide();
        $("#player").hide();
        $("#club").hide();
        $("#category_video").show();
        $("#category_video").empty(); 
        $("#category_video").append('<option>Select Category</option>');
        $.each(res,function(key,value){
          $("#category_video").append('<option value="'+key+'">'+value+'</option>');
        });
      }else{
        $("#category").empty();
      }
      }
    });
  }else{
    $("#state").empty();
    $("#city").empty();
  }
  });
  </script>

<script type=text/javascript>
  $('#country').change(function(){
  
  var countryID = $(this).val();
  if(countryID=="1"){
    $.ajax({
      type:"GET",
      url:"{{url('bygenre')}}?country_id="+countryID,
      success:function(res){
      if(res){
        $("#genre_video").removeClass('hide');
        $("#category_video").hide();
        $("#player_video").hide();
        $("#club_video").hide();
        $("#genre_video").show();
        $("#genre_video").empty();
        $("#genre_video").append('<option>Select Genre</option>');
        $.each(res,function(key,value){
          $("#genre_video").append('<option value="'+key+'">'+value+'</option>');
        });
      }else{
        $("#genre").empty();
      }
      }
    });
  }
  else if(countryID=="2"){
    $.ajax({
      type:"GET",
      url:"{{url('byclub')}}?country_id="+countryID,
      success:function(res){
      if(res){
        $("#club_video").removeClass('hide');
        $("#category_video").hide();
        $("#genre_video").hide();
        $("#player_video").hide();
        $("#club_video").show();
        $("#club_video").empty();
        $("#club_video").append('<option>Select Club</option>');
        $.each(res,function(key,value){
          $("#club_video").append('<option value="'+key+'">'+value+'</option>');
        });
      }else{
        $("#state").empty();
      }
      }
    });
  }
  else if(countryID=="3"){
    $.ajax({
      type:"GET",
      url:"{{url('byplayer')}}?country_id="+countryID,
      success:function(res){
      if(res){
        $("#player_video").removeClass('hide');
        $("#category_video").hide();
        $("#genre_video").hide();
        $("#club_video").hide();
        $("#player_video").show();
        $("#player_video").empty();
        $("#player_video").append('<option>Select Player</option>');
        $.each(res,function(key,value){
          $("#player_video").append('<option value="'+key+'">'+value+'</option>');
        });
      }else{
        $("#player").empty();
      }
      }
    });
  }
  else if(countryID=="4"){
    $.ajax({
      type:"GET",
      url:"{{url('byleague')}}?league_id="+countryID,
      success:function(res){
      if(res){
        $("#league_video").removeClass('hide');
        $("#category_video").hide();
        $("#genre_video").hide();
        $("#club_video").hide();
        $("#player_video").show();
        $("#league_video").empty();
        $("#league_video").append('<option>Select League</option>');
        $.each(res,function(key,value){
          $("#league_video").append('<option value="'+key+'">'+value+'</option>');
        });
      }else{
        $("#state").empty();
      }
      }
    });
  }else{
    $("#state").empty();
    $("#city").empty();
  }
  });
  </script>

  <!----End of logic to Get Category,Clubs,Player,Genre name------>

  
  <!----Start of logic to Get Videos, byCategory,byClubs,byPlayer,byGenre name------>


  <!----End of login to Get Videos, byCategory,byClubs,byPlayer,byGenre name------>
<script type="text/javascript">
    jQuery(function() {
    jQuery("#category_video").change(function() {
    var category_ids = $(this).val();
    console.log(category_ids);
    if(category_ids!=0){
    jQuery.ajax({
      url: "{{url('category_video')}}?category_ids=",
      type: "GET",
      data: {
        "category_ids": category_ids
      },
      success:function(res){
      if(res){
<<<<<<< HEAD
        $("#orignal_table").addClass('hide');
        $("#ajax_table").removeClass('hide');
        console.log(res)      
        $.each(res,function(key,value){
          $(".striped").append('<tbody><tr><td width="20%">'+ value.title_en +'</td><td width="20%">'+ value.description_en +'</td><td width="20%">'+ value.video_link.substr(0, 20) +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ value.id +'/edit">edit</a></td></tr></tbody>');

          $("#name1").append('<input type="hidden" name="name" id="name" value="'+ value.category_id +'"/>');
          $("#name2").append('<input type="hidden" name="name[]" id="name" value="'+ value.category_id +'"/>');
=======
        console.log(res)      
        $.each(res,function(key,value){
          $(".striped").append('<thead><tr><th>Video title</th><th>Video Sorting</th><th>Video Sorting Edit</th></tr></thread>','<tbody><tr><td value="'+ key +'">'+ value.title_en +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ value.id +'/edit">edit</a></td></tr></tbody>');
          $("#name1").append('<input type="hidden" name="name" id="name" value="'+ value.category_id +'"/>');
          $("#name2").append('<input type="hidden" name="name" id="name" value="'+ value.category_id +'"/>');

>>>>>>> f12f47d2746fff926c3954fc3dc2543bfc03bfb3
        });
      }else{
        $(".striped").empty();
      }
      }
    });
    }else{
    $(".striped").empty();
  }
  });
});
</script>

<script type="text/javascript">
    jQuery(function() {
    jQuery("#genre_video").change(function() {
    var genre_ids = $(this).val();
    console.log(genre_ids);
    if(genre_ids!=0){
    jQuery.ajax({
      url: "{{url('genre_video')}}?genre_id=",
      type: "GET",
      data: {
        "genre_ids": genre_ids
      },
<<<<<<< HEAD
=======

>>>>>>> f12f47d2746fff926c3954fc3dc2543bfc03bfb3
      success:function(res){
      if(res){
        console.log(res)
        $(".striped").empty();
        $.each(res,function(key,value){
          $(".striped").append('<thead><tr><th>Video title</th><th>Video Sorting</th><th>Video Sorting Edit</th></tr></thread>','<tbody><tr><td value="'+ key +'">'+ value.title_en +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ value.id +'/edit">edit</a></td></tr></tbody>');
        });
      }else{
        $(".striped").empty();
      }
      }
    });
    }else{
    $(".striped").empty();
  }
  });
});
</script>
<<<<<<< HEAD


@endsection



@section('scripts')
    <script src={{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/js/dataTables.select.min.js') }}></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    @section('scripts')
    <script src={{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/js/dataTables.select.min.js') }}></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <style type="text/css">
        div.dt-buttons {
            margin-bottom:20px;
        }

    </style>
    
@endsection


=======

@endsection
>>>>>>> f12f47d2746fff926c3954fc3dc2543bfc03bfb3
