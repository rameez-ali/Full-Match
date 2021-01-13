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
                             <form method="post" action="{{ route('league-form.store') }}" enctype="multipart/form-data">
                              @csrf

                                <div class="row">

                                      <div class="input-field col s12">
                                      <p for="league_name">Add League Name * </p>
                                      <input id="league_name" name="league_name" type="text"  required data-error=".errorTxt1">
                                      <small class="errorTxt1"></small>
                                      @error('league_name')
                                      <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                      </div>

                                      <div class="input-field col s12">
                                      <p for="filename1"> Add League Banner </p>
                                      <input type="file" name="filename1" id="filename1" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                      </div>

                                      <div class="input-field col s12">
                                      <p for="filename2">Add League Promo Video URL * </p>
                                      <input id="filename2" name="filename2" type="text"  required data-error=".errorTxt2">
                                      <small class="errorTxt2"></small>
                                      @error('filename2')
                                      <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                      </div>
                                     
                                     <div class="input-field col s12">
                                     <p for="filename3"> Add League Profile Image * </p>
                                     <input type="file" name="filename3" id="filename3" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required data-error=".errorTxt3" />
                                     <small class="errorTxt3"></small>
                                     @error('filename3')
                                     <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                     </span>
                                     @enderror
                                      </div>

                                      <div class="input-field col s12">
                                      <p for="league_description">Add League Description * </p>
                                      <input id="league_description" name="league_description" type="text"  required data-error=".errorTxt4">
                                      <small class="errorTxt4"></small>
                                      @error('league_description')
                                      <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                      </div>

                                      <div class="input-field col s12">
                                      <p for="league_description">Add League Sorting</p>
                                      <input type="text" name="league_sorting" placeholder="League Sorting" class="form-control input-lg"></textarea>
                                      </div>

                                         
                                      <div class="input-field col s12">
                                      <table class="table table-bordered" id="dynamicTable">  
                                       <tr>
                                       <th>Season</th>
                                       <th>Video</th>
                                       </tr>
                                     
                                      <tr>  
                                      <td><input type="text" name="addmore[0][name]" Value="Season1" class="form-control" /></td>  
                                      <td><input type="text" name="addmore[0][qty]" placeholder="Enter Season URL" class="form-control" /></td>  
                                      <td><button type="button" name="add" id="add" class="btn btn-success">Add More Season</button></td>  
                                      </tr>  
                                      </table>
                                     </div>

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
   var i = 1;
    $("#add").click(function(){
        i++;
        $("#dynamicTable").append('<tr><td><input type="text" value="Season'+i+'" name="addmore['+i+'][name]" placeholder="Enter Ss['+i+']" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter Season URL" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');

    });
    $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();
         i--;

    });  
</script>


@endsection

