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
                                        ADD VIDEO
                                         
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                            <form method="post" action="{{route('video-form.store')}}" enctype="multipart/form-data">
                            @csrf
                            
                            
                             <div class="form-group">
                                            <input type="text" name="video_title" Placeholder="Video Title *" class="form-control input-lg" />
                                            <small class="errorTxt1"></small>
                                            @error('video_title')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div>

                            <div class="form-group">
                             <input type="text" name="video_description" Placeholder="Video Description" class="form-control input-lg" />  

                            </div>

                            <div class="form-group">
                            <input type="text" name="video_link" Placeholder="Video Link *" class="form-control input-lg" />
                            <small class="errorTxt1"></small>
                                @error('video_link')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                            <input type="text" name="video_duration" Placeholder="Duration *" class="form-control input-lg" />
                             <small class="errorTxt1"></small>
                      @error('video_duration')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                            </div>

                            
                            <div class="input-field col s6">
                              <label>
                                <input type="checkbox" name="notify_user" id="customer-status" />
                                <span for="customer-status" >Notify User</span>
                              </label>
                            </div><br><br><br>

                            <div class="form-group">
                            <input type="text" name="video_sorting" Placeholder="Video Sorting" class="form-control input-lg" />
                            </div><br>


                            <br>


                  <div class="form-group">
                    <div class="input-group">
                    <div class="custom-file">
                    <label>Video Banner Image  </label>
                    <input type="file" name="video_banner_img" id="exampleInputFile">
                    </div>
                    </div>
                   </div><br>

                   <div class="form-group">
                    <div class="input-group">
                    <div class="custom-file">
                    <label>Video Image * </label>
                    <input type="file" name="video_img" id="exampleInputFile1">
                    <small class="errorTxt1"></small>
                      @error('video_img')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    </div>
                   </div><br>

                              <div class="form-group">
                              <label for="exampleInputEmail1">Select Category</label>
                              <select  class="browser-default custom-select" name="Category_id">
                                
                              <option selected> Select Category </option>
                              @foreach($category as $category)
                              <option value="{{$category->id}}">{{$category->category_name}}</option>
                              @endforeach
                              </div>

                              <div class="form-group">
                              <label for="exampleInputEmail2"></label>
                              <select  class="browser-default custom-select" name="">
                              <option selected></option>
                              </div>

                            <div class="form-group">
                              <label><strong>Select Club </strong></label><br/>
                              <select class="selectpicker" multiple data-live-search="true" name="club[]">
                              @foreach($club as $club )
                              <option value="{{$club->id}}">{{$club->club_name}}</option>
                              @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label><strong>Select Player </strong></label><br/>
                              <select class="selectpicker" multiple data-live-search="true" name="player[]">
                              @foreach($player as $player)
                              <option value="{{$player->id}}">{{$player->player_name}}</option>
                              @endforeach
                              </select>
                            </div>


                            
                            <div class="text-center" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success">Save</button>
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
         <script src="app-assets/vendors/select2/select2.full.min.js"></script>
       <script src="app-assets/js/scripts/form-select2.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
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
        $('select').selectpicker();
    });
</script>
@endsection
