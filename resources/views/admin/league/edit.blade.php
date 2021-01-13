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
                                    </h4>
                            <div class="row">
                             <form method="post" action="{{ route('league-form.update', $league->id) }}" enctype="multipart/form-data">
                             @csrf
                             @method('PATCH')
                                   
                                   <div class="row">          
                                         <div class="input-field col s12">
                                          <p for="category_image">Add League Name * </p>
                                          <input type="text" name="league_name" value="{{ $league->league_name }}" class="form-control input-lg" required data-error=".errorTxt1" />
                                          <small class="errorTxt1"></small>
                                          @error('league_name')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                          </div>


                                          <div class="input-field col s12">
                                          <p for="league_banner"> Add League Banner </p>
                                          <input type="file" name="filename1" value="{{ $league->league_banner }}" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                          </div>

                                          <div class="input-field col s12">
                                          <p for="league_promo_video">Add League Promo Video URL * </p>
                                          <input type="text" name="league_promo_video" value="{{ $league->league_promo_video }}" class="form-control input-lg" required data-error=".errorTxt2"/>
                                          <small class="errorTxt2"></small>
                                          @error('league_promo_video')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                          </div>

                                          <div class="input-field col s12">
                                          <p for="league_profile_image"> Add League Profile Image * </p>
                                          <input type="file" name="filename3" value="{{ $league->league_profile_image }}" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required />
                                          <!-- <small class="errorTxt3"></small>
                                          @error('league_profile_image')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror -->
                                          </div>

                                          <div class="input-field col s12">
                                          <p for="league_sorting">Add League Sorting  </p>
                                          <input type="text" name="league_sorting" value="{{ $league->league_sorting }}" class="form-control input-lg" />
                                          </div>

                                         <div class="input-field col s12">
                                          <p for="league_description">Add League Description * </p>
                                          <input type="text" name="league_description" value="{{ $league->league_description}}" class="form-control input-lg" required data-error=".errorTxt4" />
                                          <small class="errorTxt4"></small>
                                          @error('league_description')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                          </div>

                                         <div class="input-field col s12">
                                         <table class="table table-bordered" id="dynamicTable">  
                                         <?php $i = 1; ?>
                                         @foreach($season as $season)       
                                         <tr> 
                                         <td><input type="text" name="addmore[{{$i}}][name]" Value="{{$season->Seasons}}" class="form-control" /></td>  
                                         <td><input type="text" name="addmore[{{$i}}][qty]" Value="{{$season->Video}}" class="form-control" /></td> 
                                         @if($i==1) @else
                                         <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td> 
                                          
                                         @endif
                                         </tr>
                                         <?php $i++; ?>
                                         @endforeach                                  
                                         </table>
                                        </div>

                                        

                                         <td><button type="button" name="add" id="add" class="btn btn-success">Add More Season</button></td>  
                                            <div class="input-field col s12">
                                                    <button class="btn waves-effect waves-light right submit" type="submit" name="action">Submit
                                                        <i class="material-icons right">send</i>
                                                    </button>
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
@endsection
@section('scripts')
   <script src={{ asset('app-assets/vendors/jquery-validation/jquery.validate.min.js') }}></script>
    <script src={{ asset('app-assets/js/scripts/form-file-uploads.js') }}></script>
    <script src={{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}></script>


<script type="text/javascript">
   var table = document.getElementById("dynamicTable");
   var i = table.tBodies[0].rows.length;
      i++;
    $("#add").click(function(){      
        $("#dynamicTable").append('<tr><td><input type="text" value="Season'+i+'" name="addmore['+i+'][name]" placeholder="Enter Ss['+i+']" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter Season URL" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
         i++;

    });
    $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();

         i--;

    });  
</script>
@endsection