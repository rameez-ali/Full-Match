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
                             <form method="post" action="{{ route('league-form.store') }}" enctype="multipart/form-data">
                              @csrf

                                <div class="col s12">
                                    <div id="question-section" >
                                        <div class="question-section" data-id="0">
                                            <div class="card-body">
                                       <div class="form-group">
                                       <input type="text" name="league_name" Placeholder="League Name *" class="form-control input-lg" required data-error=".errorTxt1"></textarea>
                                       <small class="errorTxt1"></small>
                                        @error('league_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                       </div>
                                       <br/>


                                        <div class="form-group">
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <label>League Banner</label>
                                        <input type="file" name="filename1" multiple id="exampleInputFile">
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                         <div class="form-group">
                                       <input type="text" name="filename2" Placeholder="League Promo Video URL *" class="form-control input-lg" required data-error=".errorTxt2"></textarea>
                                       <small class="errorTxt2"></small>
                                        @error('filename2')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                       </div>
                                       <br/>

                                         <div class="form-group">
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <label>Profile Image *</label>
                                        <input type="file" name=filename3 multiple id="exampleInputFile" required data-error=".errorTxt3">
                                        <small class="errorTxt3"></small>
                                        @error('filename3')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                        <div class="card-body">
                                        <div class="form-group">
                                        <input type="text" name="league_description" placeholder="League Description  * " class="form-control input-lg" required data-error=".errorTxt4"></textarea>
                                        <small class="errorTxt4"></small>
                                        @error('league_description')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                        </div>

                                         <div class="card-body">
                                        <div class="form-group">
                                        <input type="text" name="league_sorting" placeholder="League Sorting" class="form-control input-lg"></textarea>
                                        </div>

                                         

                                      <table class="table table-bordered" id="dynamicTable">  
                                       <tr>
                                       <th>Season</th>
                                       <th>Video</th>
                                       <th>Remove</th>
                                       </tr>
                                     
                                      <tr>  
                                      <td><input type="text" name="addmore[0][name]" Value="Season1" class="form-control" /></td>  
                                      <td><input type="text" name="addmore[0][qty]" placeholder="Enter Season URL" class="form-control" /></td>  
                                      <td><button type="button" name="add" id="add" class="btn btn-success">Add More Season</button></td>  
                                      </tr>  
                                      </table>

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
   var i = 1;
    $("#add").click(function(){
        i++;
        $("#dynamicTable").append('<tr><td><input type="text" value="Season'+i+'" name="addmore['+i+'][name]" placeholder="Enter Ss['+i+']" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter Season URL" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');

    });
    $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();

    });  
</script>


@endsection

