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
                                        Edit Slider
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" action="{{ route('slider-form.update', $slider->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                       <div class="form-group">

                                       <div class="input-field col s12">
                                       <p for="name_en"> Edit Slider Name * </p>
                                       <input type="text" name="name_en" id="name_en" value="{{ $slider->name_en }}" class="form-control input-lg"  required data-error=".errorTxt1" />
                                       </div>

                                       <div class="input-field col s12">
                                          <p for="name_ar"> Edit Slider Name AR *</p>
                                           <input type="text" name="name_ar"  id="name_ar" value="{{ $slider->name_ar }}" class="form-control input-lg"  required data-error=".errorTxt4" />
                                       </div>

                                        <div class="input-field col s12">
                                            <p for="Category_id"> Type *</p>
                                        @if(isset($select_category_id->category_id))
                                            <input type="text" name="Category_id" value="{{$category->name_en}}" readonly />
                                        @else
                                            <input type="text" name="Category_id" value="Home" readonly />
                                       @endif
                                      </div>

                                       <div class="input-field col s12">
                                         <p for="video[]"> Edit Videos *</p>
                                       <select class="max-length browser-default" id="testbox" multiple data-live-search="true" name="video[]" data-error=".errorTxt2" required>
                                       @foreach($video1 as $video )
                                       <option value="{{$video->id}}" {{in_array($video->id, $selected_ids) ? 'selected' : ''}} >{{$video->title_en}}</option>
                                       @endforeach
                                       </select>
                                       </div>

                                       <div class="input-field col s12">
                                         <p for="slider_sorting"> Edit Slider Sorting *</p>
                                       <input type="number" name="slider_sorting" value="{{ $slider->slider_sorting }}" min="1" class="form-control input-lg"  required data-error=".errorTxt3"/>
                                       </div>

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

$(document).ready(function() {
        $("#travel").change(function() {
            if ($("#travel").val() == 1) {
                $("#hidden-panel1").hide()
                $("#hidden-panel").show()
            }
            else if ($("#travel").val() == 2) {
                $("#hidden-panel").hide()
                $("#hidden-panel1").show()
            }
            else if ($("#travel").val() == 0){
                $("#hidden-panel").hide()
                $("#hidden-panel1").hide()
            }
        })
    });


</script>
    <script>
        $("#name_en").keyup(function(){
            $("#name_ar").val(this.value);
        });
    </script>


@endsection
