<!DOCTYPE html>
<html>
<head>
  <title>Ajax dynamic dependent country state city dropdown using jquery ajax in Laravel 5.6</title>
  <link rel="stylesheet" href="//www.codermen.com/css/bootstrap.min.css">  
  <script src=//www.codermen.com/js/jquery.js></script>
</head>
<body>
<div >
  <div >
   <div >Ajax dynamic dependent country state city dropdown using jquery ajax in Laravel 5.6</div>
   <div >
      <div >
        <select id="country" name=category_id  >
        <option value="" selected disabled>Select</option>
         @foreach($countries as $key => $country)
         <option value="{{$key}}"> {{$country}}</option>
         @endforeach
         </select>
      </div>
      <div >
        <label for="title">Select State:</label>
        <select name=state id="state" >
        </select>
      </div>
     
      <div >
        <label for="title">Select City:</label>
         <table class="striped" name="state[]">

        </table>
      </div>
   </div>
  </div>
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
          $(".striped").append('<tbody><tr><td value="'+ key +'">'+ value +'</td> <td> <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="'+ key +'/edit">edit</a></td></tr></tbody>');
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
</body>
</html>