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
                                                                                      
                              <select>
                              <div class="form-group">
                              <label for="exampleInputEmail2"></label>
                              <select  class="browser-default custom-select" name="">
                              <option selected></option>
                            </selected>
                              </div>

                              <div class="form-group">
                                    <label for="country">Select League:</label>
                                    <select name="country" id="country1" class="form-control" style="width:250px">
                                    <option value="">--- Select Leagues ---</option>
                                    @foreach ($leagues as $leagues)
                                    <option value="{{$leagues->id}}">{{ $leagues->league_name }}</option>
                                    @endforeach
                                    </select>
                            </div>
            
                                     <label for="state">Select Season:</label>
                                     <select name="state" id="country1" class="select browser-default" style="width:250px">
                                     </select>

                                      <label for="state">Select Season:</label>
                                     <select name="state" class="select browser-default" style="width:250px">
                                     </select>
                                            
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

 <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="country"]').on('change',function(){
               var countryID = jQuery(this).val();
               console.log(countryID);
               if(countryID == '0')
               {
                  
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

    jQuery(document).ready(function ()
    {
            jQuery('select[name="country1"]').on('change',function(){
               var countryID1 = jQuery(this).val();
               console.log(countryID);
               if(countryID1 == '0')
               {
                  
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
                        jQuery('select[name="state1"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="state1"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
            });
    });
     </script>   
@endsection
@section('scripts')
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
