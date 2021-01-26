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
                                                    <p for="name_en">Edit League Name EN * </p>
                                                    <input type="text" name="name_en" value="{{ $league->name_en }}" class="form-control input-lg" required data-error=".errorTxt1" />
                                                    <small class="errorTxt1"></small>
                                                    @error('name_en')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="name_ar">Edit League Name AR * </p>
                                                    <input type="text" name="name_ar" value="{{ $league->name_ar }}" class="form-control input-lg" required data-error=".errorTxt5" />
                                                    <small class="errorTxt5"></small>
                                                    @error('name_ar')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>


                                                <div class="input-field col s12">
                                                    <p for="league_banner"> Edit League Banner </p>
                                                    <input type="file" name="filename1" value="{{ $league->league_banner }}" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/league/'.$league->league_banner)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="league_promo_video">Edit League Promo Video URL * </p>
                                                    <input type="url" name="league_promo_video" value="{{ $league->league_promo_video }}" required data-error=".errorTxt2"/>
                                                    <small class="errorTxt2"></small>
                                                    @error('league_promo_video')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="league_profile_image"> Edit League Profile Image * </p>
                                                    <input type="file" name="filename3" value="{{ $league->league_profile_image }}" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/league/'.$league->league_profile_image)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg"/>
                                                <!-- <small class="errorTxt3"></small>
                                          @error('league_profile_image')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror -->
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="league_sorting">Edit League Sorting  </p>
                                                    <input type="number" name="league_sorting" value="{{ $league->league_sorting }}" min="1" class="form-control input-lg" />
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_en">Edit League Description EN * </p>
                                                    <input type="text" name="description_en" value="{{ $league->description_en}}" class="form-control input-lg" required data-error=".errorTxt4" />
                                                    <small class="errorTxt4"></small>
                                                    @error('description_en')
                                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="description_ar">Edit League Description AR * </p>
                                                    <input type="text" name="description_ar" value="{{ $league->description_ar}}" class="form-control input-lg" required data-error=".errorTxt6" />
                                                    <small class="errorTxt6"></small>
                                                    @error('description_ar')
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
                                                                <td><input type="text" name="addmore[{{$i}}][name_en]" Value="{{$season->name_en}}" class="form-control" /></td>
                                                                <td><input type="url" name="addmore[{{$i}}][qty]" Value="{{$season->Video}}" class="form-control" /></td>
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
                        $("#dynamicTable").append('<tr><td><input type="text" value="Season'+i+'" name="addmore['+i+'][name_en]" placeholder="Enter Ss['+i+']" class="form-control" /></td><td><input type="url" name="addmore['+i+'][qty]" placeholder="Enter Season URL" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
                        i++;

                    });
                    $(document).on('click', '.remove-tr', function(){

                        $(this).parents('tr').remove();

                        i--;

                    });
                </script>
@endsection
