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
                                        Edit Video Genre
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" class="formValidate" id="formValidate"  action="{{ route('genre-form.update', $genre->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="row">
                                          <div class="input-field col s12">
                                          <label for="name_en">Edit Genre Name EN * </label>
                                          <input type="text" name="name_en" id="name_en" max="16" value="{{ $genre->name_en }}" class="form-control input-lg" data-error=".errorTxt1" required />
                                          <small class="errorTxt1"></small>
                                          @error('name_en')
                                         <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                         </span>
                                         @enderror
                                          </div>

                                            <div class="input-field col s12">
                                                <label for="name_ar">Edit Genre Name AR * </label>
                                                <input type="text" name="name_ar" id="name_ar" max="16" value="{{ $genre->name_ar }}" class="form-control input-lg" data-error=".errorTxt1" required />
                                                <small class="errorTxt1"></small>
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                         </span>
                                                @enderror
                                            </div>

                                           <div class="input-field col s12">
                                           <label for="category_name">Edit Genre Sorting </label>
                                           <input type="number" name="genre_sorting" value="{{ $genre->genre_sorting }}" min="1" class="form-control input-lg" />
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
        </div>
        <div class="content-overlay"></div>
    </div>
@endsection
@section('scripts')
    <script src={{ asset('app-assets/vendors/jquery-validation/jquery.validate.min.js') }}></script>
    <script src={{ asset('app-assets/js/scripts/form-file-uploads.js') }}></script>
    <script src={{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}></script>
<script>
    /*
 * Form Validation
 */
    $("#name_en").keyup(function(){
        $("#name_ar").val(this.value);
    });
    $("#description_en").keyup(function(){
        $("#description_ar").val(this.value);
    });

    $(function () {

        $('select[required]').css({
            position: 'absolute',
            display: 'inline',
            height: 0,
            padding: 0,
            border: '1px solid rgba(255,255,255,0)',
            width: 0
        });

        $("#formValidate").validate({
            rules: {
                genre_name: {
                    required: true,
                    minlength: 5 ,
                },
                tnc_select: "required",
            },
            //For custom messages
            messages: {
                genre_name: {
                    required: "Enter Genre Name",
                    minlength: "Enter at least 5 characters"
                },
                curl: "Enter your website",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>
@endsection