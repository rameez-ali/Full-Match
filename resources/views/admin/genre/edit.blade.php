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
                                        <form method="post" action="{{ route('genre-form.update', $genre->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="row">
                                          <div class="input-field col s12">
                                          <label for="name_en">Edit Genre Name EN * </label>
                                          <input type="text" name="name_en" value="{{ $genre->name_en }}" class="form-control input-lg" data-error=".errorTxt1" required />
                                          <small class="errorTxt1"></small>
                                          @error('name_en')
                                         <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                         </span>
                                         @enderror
                                          </div>

                                            <div class="input-field col s12">
                                                <label for="name_ar">Edit Genre Name AR * </label>
                                                <input type="text" name="name_ar" value="{{ $genre->name_ar }}" class="form-control input-lg" data-error=".errorTxt1" required />
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
    <script src="app-assets/vendors/jquery-validation/jquery.validate.min.js"></script>
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
                uname: {
                    required: true,
                    minlength: 5
                },
                cemail: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                cpassword: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                crole: {
                    required: true,
                },
                curl: {
                    required: true,
                    url: true
                },
                ccomment: {
                    required: true,
                    minlength: 15
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
