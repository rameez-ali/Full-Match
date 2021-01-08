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
                                        Season Part Sorting

                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                            <form method="post" action="{{route('video-form.store')}}" enctype="multipart/form-data">
                            @csrf








                              <div class="form-group">

                              <div >
        <select id="country" name="category_id"  >
        <option value="" selected disabled>Select League</option>
         @foreach($countries as $key => $country)
         <option value="{{$key}}"> {{$country}}</option>
         @endforeach
         </select>
      </div>
      <div >
        <label for="title">Select Season:</label>
        <select name=state class="browser-default custom-select" id="state" >
        </select>
      </div>

      <div >
        <label for="title">Select Season:</label>
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

  <script type=text/javascript>
  $('#country').change(function(){
  var countryID = $(this).val();
  if(countryID){
    $.ajax({
      type:"GET",
      url:"{{url('get-state-list')}}?country_id="+countryID,
      success:function(res){
      if(res){
        $("#state").empty();
        $("#state").append('<option>Select</option>');
        $.each(res,function(key,value){
          $("#state").append('<option value="'+key+'">'+value+'</option>');
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
  $('#state').on('change',function(){
  var stateID = $(this).val();
  if(stateID){
    $.ajax({
      type:"GET",
      url:"{{url('get-city-list')}}?state_id="+stateID,
      success:function(res){
      if(res){
        $(".striped").empty();
        $.each(res,function(key,value){
          $(".striped").append('<tbody><tr><td value="'+ key +'">'+ value +'</td><td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="seasonpart-form/'+ key +'/edit">edit</a></td></tr></tbody>');
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

