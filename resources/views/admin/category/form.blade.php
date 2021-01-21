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
                                        ADD Category

                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>


                                        <form method="post" class="formValidate" id="formValidate" action="{{ route('category-form.store') }}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <p for="category_name">Add Category Name * </p>
                                                    <input id="category_name" name="category_name" type="text" data-error=".errorTxt1">
                                                    <small class="errorTxt1"></small>
                                                    @error('category_name')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="category_image"> Add Category Image * </p>
                                                    <input type="file" name="category_image" id="category_image" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required data-error=".errorTxt2" />
                                                    <small class="errorTxt2"></small>
                                                    @error('category_image')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>


                                               <div class="input-field col s12">
                                              <p for="genre"> Select Genre *</p>
                                              <select class="selectpicker" multiple data-live-search="true" name="genre[]" required >
                                              @foreach($genres as $videogenre )
                                              <option value="{{$videogenre->id}}">{{$videogenre->genre_name}}</option>
                                              @endforeach
                                              </select>
                                                   <small class="errorTxt6"></small>
                                                   @error('genre')
                                                   <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                               </span>
                                                   @enderror
                                               </div>


                                                <div class="input-field col s12">
                                                    <label for="category_sorting">Add Category Sorting</label>
                                                    <input id="category_sorting" name="category_sorting" type="number" min="1" >
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
                category_name: {
                    required: true,
                    minlength: 5 ,
                },
                category_image: {
                    required: true,
                },
                tnc_select: "required",
            },
            //For custom messages
            messages: {
                category_name: {
                    required: "Enter Category Name",
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
