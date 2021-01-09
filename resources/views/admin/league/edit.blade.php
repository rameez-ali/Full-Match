@extends('admin.layouts.app')
@section('content')

<div class="col s12">
    <div class="container">
<div class="row">
    <div class="col s12">
        <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                        ADD LEAGUE
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Details</a>
                                    </h4>
                            <div class="row">
                             <form method="post" action="{{ route('league-form.update', $league->id) }}" enctype="multipart/form-data">
                             @csrf
                             @method('PATCH')
                                <div class="col s12">
                                    <div id="question-section" >
                                        <div class="question-section" data-id="0">
                                            <div class="card-body">
                                       <div class="form-group">
                                       <input type="text" name="league_name" Placeholder="League Name *" value="{{ $league->league_name }}" class="form-control input-lg"></textarea>
                                       </div>
                                       <br/>


                                        <div class="form-group">
                                       <label class="col-md-4 text-right">Select League Banner</label>
                                       <div class="col-md-8">
                                       <input type="file" name="league_banner" />
                                       <input type="hidden" name="hidden_image1" value="{{ $league->league_banner }}" />
                                       </div>
                                       </div>

                                       <div class="form-group">
                                       <input type="text" name="league_promo_video" Placeholder="League Promo Video URL *" value="{{ $league->league_promo_video }}" class="form-control input-lg" required data-error=".errorTxt2"></textarea>
                                       <small class="errorTxt2"></small>
                                        @error('filename2')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                       </div>
                                       <br/>

                                            <div class="form-group">
                                                <label class="col-md-4 text-right">Select Profile Image</label>
                                                <div class="col-md-8">
                                                    <input type="file" name="league_profile_image" />
                                                    <input type="hidden" name="hidden_image3" value="{{ $league->league_profile_image }}" />
                                                </div>
                                            </div><br>

                                         <div class="form-group">
                                               <label class="col-md-4 text-right">Add League1 Sorting</label>
                                               <div class="col-md-8">
                                               <input type="text" name="league_sorting" value="{{ $league->league_sorting }}" class="form-control input-lg" />
                                            </div><br>

                                        <div class="card-body">
                                        <div class="form-group">
                                        <input type="text" name="league_description" value="{{ $league->league_description }}" placeholder="Description" class="form-control input-lg"></textarea>
                                        </div>

                                   
                                        
                                        
                                         <table class="table table-bordered" id="dynamicTable">  
                                       <?php $i = 1; ?>
                                        @foreach($season as $season)
                                        
                                      <tr> 
                                      <td><input type="text" name="addmore[{{$i}}][name]" Value="{{$season->Seasons}}" class="form-control" /></td>  
                                      <td><input type="text" name="addmore[{{$i}}][qty]" Value="{{$season->Video}}" class="form-control" /></td> 

                                      <!-- <td><input type="text" name="addmore[2]['name']" Value="{{$season->Seasons}}" class="form-control" /></td>  
                                      <td><input type="text" name="addmore[2]['qty']" Value="{{$season->Video}}" class="form-control" /></td>  -->

                                      <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td> 
                                      </tr>
                                      <?php $i++; ?>
                                        @endforeach

                                         
                                        
                                        </table>

                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More Season</button></td>  
 
                                         
                                     

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

<script type="text/javascript">
   var table = document.getElementById("dynamicTable");
   var i = table.tBodies[0].rows.length;
    $("#add").click(function(){
        i++;
        $("#dynamicTable").append('<tr><td><input type="text" value="Season'+i+'" name="addmore['+i+'][name]" placeholder="Enter Ss['+i+']" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter Season URL" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');

    });
    $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();

    });  
</script>

@endsection