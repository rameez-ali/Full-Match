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
                                        Videos
                                     @can('add-video')
                                    <a href="{{ URL::route('video-form.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Add</a>
                                    <br>
                                    <a href="{{ URL::route('update-category-genre.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Update Category Genre</a>
                                    @endcan
                                    </h4>

                                     <form action="{{route('video-form.search')}}" method="post" role="search">
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
                                      
                                         <div id="category_video_hide" class="hide">
                                         <select name="state0" class="select2 browser-default " id="category_video" multiple="multiple">
                                         </select>
                                         </div>

                                         <div id="genre_video_hide" class="hide">
                                         <select name="state1" class="select2 browser-default " id="genre_video hide" multiple="multiple">
                                         </select>
                                         </div>

                                         <div id="club_video_hide" class="hide">
                                          <select name="state2" class="select2 browser-default " id="club_video" multiple="multiple">
                                         </select>
                                         </div>

                                         <div id="player_video_hide" class="hide">
                                         <select name="state" class="select2 browser-default " id="player_video" multiple="multiple">
                                         </select>
                                         </div>

                                         <div id="league_video_hide" class="hide">
                                         <select name="state3" class="browser-default custom-select " id="league_video" >
                                         </select>
                                         </div>

                                         <div id="season_video_hide" class="hide">
                                         <select name="state4" class="select2 browser-default" id="season_video" multiple="multiple">
                                         </select>
                                         </div>
                                          
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
                                                <th width="80%">Action</th>
                                            </tr>
                                            </thead>
                                         </table>

                                         </div>

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


<script type="text/javascript">
  jQuery("#state").select2().next().hide();
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
        $("#category_video_hide").removeClass('hide');
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
        $("#genre_video_hide").removeClass('hide');
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
        $("#club_video_hide").removeClass('hide');
        $("#club_video").append('<option>Select Club</option>');
        $.each(res,function(key,value){
          $("#club_video").append('<option value="'+key+'">'+value+'</option>');
        });
      }else{
        $("#club_video").empty();
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
        $("#player_video_hide").removeClass('hide');
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
        $("#league_video_hide").removeClass('hide');
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

<script type="text/javascript">
  $('#league_video').change(function(){
  var seasonID = $(this).val();
    console.log(seasonID);
    $.ajax({
      type:"GET",
      url:"{{url('byseason')}}?league_id="+seasonID,
      success:function(res){
      if(res){
        $("#season_video_hide").removeClass('hide');
        $("#season_video").append('<option>Select Season</option>');
        $.each(res,function(key,value){
          $("#season_video").append('<option value="'+key+'">'+value+'</option>');
        });
      }else{
        $("#state").empty();
      }
      }
    });
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
        $("#orignal_table").addClass('hide');
        $("#ajax_table").removeClass('hide');
        console.log(res)      
        $.each(res,function(key,value){
          $(".striped").append('<tbody><tr><td width="20%">'+ value.title_en +'</td><td width="20%">'+ value.description_en +'</td><td width="20%">'+ value.video_link.substr(0, 20) +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/videodetails/'+ value.id +'">details</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td></tr></tbody>');

          $("#name1").append('<input type="hidden" name="name" id="name" value="'+ value.category_id +'"/>');
          $("#name2").append('<input type="hidden" name="name[]" id="name" value="'+ value.category_id +'"/>');
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
      url: "{{url('genre_video')}}?genre_ids=",
      type: "GET",
      data: {
        "genre_ids": genre_ids
      },
      success:function(res){
      if(res){
        $("#orignal_table").addClass('hide');
        $("#ajax_table").removeClass('hide');
        console.log(res)
        $.each(res,function(key,value){
           $(".striped").append('<tbody><tr><td width="20%">'+ value.title_en +'</td><td width="20%">'+ value.description_en +'</td><td width="20%">'+ value.video_link.substr(0, 20) +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/videodetails/'+ value.id +'">details</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td></tr></tbody>');

          $("#name1").append('<input type="hidden" name="name" id="name" value="'+ value.category_id +'"/>');
          $("#name2").append('<input type="hidden" name="name[]" id="name" value="'+ value.category_id +'"/>');
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
    jQuery("#club_video").change(function() {
    var club_ids = $(this).val();
    console.log(club_ids);
    if(club_ids!=0){
    jQuery.ajax({
      url: "{{url('club_video')}}?club_ids=",
      type: "GET",
      data: {
        "club_ids": club_ids
      },
      success:function(res){
      if(res){
        $("#orignal_table").addClass('hide');
        $("#ajax_table").removeClass('hide');
        console.log(res)
        $.each(res,function(key,value){
           $(".striped").append('<tbody><tr><td width="20%">'+ value.title_en +'</td><td width="20%">'+ value.description_en +'</td><td width="20%">'+ value.video_link.substr(0, 20) +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/videodetails/'+ value.id +'">details</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td></tr></tbody>');

          $("#name1").append('<input type="hidden" name="name" id="name" value="'+ value.id +'"/>');
          $("#name2").append('<input type="hidden" name="name[]" id="name" value="'+ value.id +'"/>');
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
    jQuery("#player_video").change(function() {
    var player_ids = $(this).val();
    console.log(player_ids);
    if(player_ids!=0){
    jQuery.ajax({
      url: "{{url('player_video')}}?player_ids=",
      type: "GET",
      data: {
        "player_ids": player_ids
      },
      success:function(res){
      if(res){
        $("#orignal_table").addClass('hide');
        $("#ajax_table").removeClass('hide');
        console.log(res)
        $.each(res,function(key,value){
           $(".striped").append('<tbody><tr><td width="20%">'+ value.title_en +'</td><td width="20%">'+ value.description_en +'</td><td width="20%">'+ value.video_link.substr(0, 20) +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/videodetails/'+ value.id +'">details</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td></tr></tbody>');

          $("#name1").append('<input type="hidden" name="name" id="name" value="'+ value.category_id +'"/>');
          $("#name2").append('<input type="hidden" name="name[]" id="name" value="'+ value.category_id +'"/>');
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
    jQuery("#season_video").change(function() {
    var season_ids = $(this).val();
    console.log(season_ids);
    if(season_ids!=0){
    jQuery.ajax({
      url: "{{url('season_video')}}?season_ids=",
      type: "GET",
      data: {
        "season_ids": season_ids
      },
      success:function(res){
      if(res){
        $("#orignal_table").addClass('hide');
        $("#ajax_table").removeClass('hide');
        console.log(res)
        $.each(res,function(key,value){
           $(".striped").append('<tbody><tr><td width="20%">'+ value.title_en +'</td><td width="20%">'+ value.description_en +'</td><td width="20%">'+ value.video_link.substr(0, 20) +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/videodetails/'+ value.id +'">details</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="video-form/'+ value.id +'/edit">delete</a></td></tr></tbody>');

          $("#name1").append('<input type="hidden" name="name" id="name" value="'+ value.category_id +'"/>');
          $("#name2").append('<input type="hidden" name="name[]" id="name" value="'+ value.category_id +'"/>');
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


