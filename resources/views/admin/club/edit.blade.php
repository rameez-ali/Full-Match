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
                                        Edit Club
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" action="{{ route('club-form.update', $club->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                       
                                       <div class="row">
                                          <div class="input-field col s12">
                                          <p for="club_name">Add Club Name * </p>
                                          <input type="text" name="club_name" Placeholder="Player Name" value="{{ $club->club_name }}" class="form-control input-lg" />
                                          <small class="errorTxt1"></small>
                                          @error('club_name')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                          </div>

                                          <div class="input-field col s12">
                                          <p for="club_description"> Add Club Description * </p>
                                          <input type="text" name="club_description" Placeholder="Description" value="{{ $club->club_description }}" class="form-control input-lg" />
                                          <small class="errorTxt2"></small>
                                          @error('club_description')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                          </div>

                                          <div class="input-field col s12">
                                          <p for="club_banner"> Add Club Banner * </p>
                                          <input type="file" name="club_banner" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/club/'.$club->club_banner)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                          <input type="hidden" name="hidden_image1" value="{{ $club->club_banner }}" />
                                          <!-- <small class="errorTxt3"></small>
                                          @error('club_banner')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror -->
                                          </div>

                                          <div class="input-field col s12">
                                          <p for="club_logo"> Add Club Logo * </p>
                                          <input type="file" name="club_logo" class="dropify mt-3" data-default-file="{{ asset('app-assets/images/club/'.$club->club_logo)}}" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                          <input type="hidden" name="hidden_image2" value="{{ $club->club_logo }}" />
                                          <!-- <small class="errorTxt3"></small>
                                          @error('club_logo')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror -->
                                          </div>


                                          <div class="input-field col s12">
                                          <p for="category_image"> Add Club Sorting </p>
                                          <input type="text" name="club_sorting" Placeholder="Player sorting" value="{{ $club->club_sorting }}" class="form-control input-lg" />
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
