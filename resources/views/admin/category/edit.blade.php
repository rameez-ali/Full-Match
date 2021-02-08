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
                                        Edit Category
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" class="formValidate" id="formValidate" action="{{ route('category-form.update', $category->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                       <div class="row">
                                          <div class="input-field col s12">
                                          <label for="name_er">Edit Category Name * </label>
                                          <input type="text" name="name_en" id="name_en" value="{{ $category->name_en }}" class="form-control input-lg" required data-error=".errorTxt1"/>
                                          <small class="errorTxt1"></small>
                                          @error('name_er')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                          </div>

                                           <div class="input-field col s12">
                                               <label for="name_ar">Edit Category Name AR * </label>
                                               <input type="text" name="name_ar" id="name_ar"  value="{{ $category->name_ar }}" class="form-control input-lg" required data-error=".errorTxt2"/>
                                               <small class="errorTxt2"></small>
                                               @error('name_ar')
                                               <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                               @enderror
                                           </div>


                                          <div class="input-field col s12">
                                          <p for="category_image"> Edit Category Image * </p>
                                          <input type="file" name="category_image"  id="category_image" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/category/'.$category->category_image)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg"  />
                                              <input type="hidden" name="hidden_image" value="{{ $category->category_image }}" />

                                          </div>

                                         <div class="input-field col s12">
                                         <label for="category_sorting">Edit Category Sorting </label>
                                         <input type="number" name="category_sorting" value="{{ $category->category_sorting }}" min="1" class="form-control input-lg" />
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

                tnc_select: "required",
            },
            //For custom messages
            messages: {
                uname: {
                    required: "Enter a username",
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
