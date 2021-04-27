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
                                        Video Filter

                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                            <form method="post" action="{{route('video-form.store')}}" enctype="multipart/form-data">
                                           
                                           @csrf

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
                                         <select name="state" class="browser-default custom-select hide" id="category_video" >
                                         </select>
                                         </div>

                                         <div>
                                         <select name="state" class="browser-default custom-select hide" id="genre_video" >
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

                                         <div >
                                         <table class="striped" name="state[]">
                                         </table>
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


  <!----Start of logic to Get Category,Clubs,Player,Genre name------>

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

  <script type=text/javascript>
  $('#category_video').on('change',function(){
  var categoryvideoID = $(this).val();
  if(categoryvideoID){
    $.ajax({
      type:"GET",
      url:"{{url('category_video')}}?category_id="+categoryvideoID,
      success:function(res){
      if(res){
        console.log(res)
        $(".striped").empty();
        $.each(res,function(key,value){
          $(".striped").append('<thead><tr><th>Video title</th><th>Video Sorting</th><th>Video Sorting Edit</th></tr></thread>','<tbody><tr><td value="'+ key +'">'+ value.title_en +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ value.id +'/edit">edit</a></td></tr></tbody>');
        });

      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }

  });
</script>

<script type=text/javascript>
  $('#genre_video').on('change',function(){
  var genrevideoID = $(this).val();
  if(genrevideoID){
    $.ajax({
      type:"GET",
      url:"{{url('genre_video')}}?genre_id="+genrevideoID,
      success:function(res){
      if(res){
        console.log(res)
        $(".striped").empty();
        $.each(res,function(key,value){
          $(".striped").append('<thead><tr><th>Video title</th><th>Video Sorting</th><th>Video Sorting Edit</th></tr></thread>','<tbody><tr><td value="'+ key +'">'+ value.title_en +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ value.id +'/edit">edit</a></td></tr></tbody>');
        });

      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }

  });
</script>

<script type=text/javascript>
  $('#club_video').on('change',function(){
  var clubvideoID = $(this).val();
  if(clubvideoID){
    $.ajax({
      type:"GET",
      url:"{{url('club_video')}}?club_id="+clubvideoID,
      success:function(res){
      if(res){
        console.log(res)
        $(".striped").empty();
        $.each(res,function(key,value){
          $(".striped").append('<thead><tr><th>Video title</th><th>Video Sorting</th><th>Video Sorting Edit</th></tr></thread>','<tbody><tr><td value="'+ key +'">'+ value.title_en +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ value.id +'/edit">edit</a></td></tr></tbody>');
        });

      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }

  });
</script>

<script type=text/javascript>
  $('#player_video').on('change',function(){
  var playervideoID = $(this).val();
  if(playervideoID){
    $.ajax({
      type:"GET",
      url:"{{url('player_video')}}?player_id="+playervideoID,
      success:function(res){
      if(res){
        console.log(res)
        $(".striped").empty();
        $.each(res,function(key,value){
          $(".striped").append('<thead><tr><th>Video title</th><th>Video Sorting</th><th>Video Sorting Edit</th></tr></thread>','<tbody><tr><td value="'+ key +'">'+ value.title_en +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ value.id +'/edit">edit</a></td></tr></tbody>');
        });

      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }

  });
</script>

<script type=text/javascript>
  $('#season_video').on('change',function(){
  var seasonvideoID = $(this).val();
  if(seasonvideoID){
    $.ajax({
      type:"GET",
      url:"{{url('season_video')}}?season1_id="+seasonvideoID,
      success:function(res){
      if(res){
        console.log(res)
        $(".striped").empty();
        $.each(res,function(key,value){
          $(".striped").append('<thead><tr><th>Video title</th><th>Video Sorting</th><th>Video Sorting Edit</th></tr></thread>','<tbody><tr><td value="'+ key +'">'+ value.title_en +'</td><td value="'+ key +'">'+ value.video_sorting +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ value.id +'/edit">edit</a></td></tr></tbody>');
        });

      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }

  });
</script>


  <!----End of login to Get Videos, byCategory,byClubs,byPlayer,byGenre name------>

  <script type=text/javascript>
  $('#league_video').on('change',function(){
  var leaguevideoID = $(this).val();
  if(leaguevideoID){
    $.ajax({
      type:"GET",
      url:"{{url('byseason')}}?league_id="+leaguevideoID,
      success:function(res){
      if(res){
        $("#season_video").removeClass('hide');
        $("#category_video").hide();
        $("#genre_video").hide();
        $("#club_video").hide();
        $("#season_video").show();
        $("#season_video").empty();
        $("#season_video").append('<option>Select season</option>');
        $.each(res,function(key,value){
          $("#season_video").append('<option value="'+key+'">'+value+'</option>');
        });

      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }

  });
</script>

  
@endsection

