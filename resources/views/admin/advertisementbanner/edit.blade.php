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
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Details</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                        <form method="post" action="{{ route('slider-form.update', $slider->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                       <div class="form-group">
                                       <label class="col-md-4 text-right">Add Slider Name</label>
                                       <div class="col-md-8">
                                       <input type="text" name="slider_name" value="{{ $slider->slider_name }}" class="form-control input-lg" />
                                       </div>
                                       </div>

                                       <div name="hidden-panel1" id="hidden-panel1">
                                       <label><strong>Select Videos </strong></label><br/>
                                       <select class="selectpicker" multiple data-live-search="true" name="video[]">
                                       @foreach($video as $video )
                                       <option value="{{$video->id}}" {{in_array($video->id, $selected_ids) ? 'selected' : ''}} >{{$video->video_title}}</option>
                                       @endforeach
                                       </select>
                                       </div>


                                       
                                       <br /><br />
                                       <div class="form-group text-center">
                                       <input type="submit" name="edit" class="btn btn-primary input-lg" value="Edit" />
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
@endsection
