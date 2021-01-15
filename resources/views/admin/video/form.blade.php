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
                                          
                                           <div class="row">
                            
                                              <div class="input-field col s12">
                                              <p for="video_title">Add Video Title * </p>
                                              <input id="video_title" name="video_title" type="text"  required data-error=".errorTxt1">
                                              <small class="errorTxt1"></small>
                                              @error('video_title')
                                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                              @enderror
                                               </div>

                                              <div class="input-field col s12">
                                              <p for="video_title">Add Video Description </p>
                                              <input type="text" id="video_description" name="video_description" class="form-control input-lg" />  
                                              </div>

                                              <div class="input-field col s12">
                                              <p for="video_link">Add Video Link * </p>
                                              <input id="video_link" name="video_link" type="text"  required data-error=".errorTxt2">
                                              <small class="errorTxt2"></small>
                                              @error('video_link')
                                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                              @enderror
                                              </div>
                                               
                                               <div class="input-field col s12">
                                              <p for="video_sorting">Video Duration * </p>
                                              <div class="input-field col s1">
                                              <p for="hour">Hour </p>
                                              <input type="number" id="hour" name="hour"  min="0" class="form-control input-lg" required/>
                                              </div>
                                              <div class="input-field col s1">
                                              <p for="Minutes">Minutes </p>
                                              <input type="number" id="minute" name="minute"  min="0" class="form-control input-lg" required />
                                              </div>
                                              <div class="input-field col s1">
                                              <p for="second">Second </p>
                                              <input type="number" id="second" name="second"  min="0"class="form-control input-lg" required />
                                              </div>
                                               </div>
                                               

                            
                                              <div class="input-field col s12">
                                              <label>
                                              <input type="checkbox" name="notify_user" id="customer-status" />
                                               <span for="customer-status" >Notify User</span>
                                               </label><br><br>
                                               </div>

                                              <div class="input-field col s12">
                                              <p for="video_sorting">Video Sorting </p>
                                              <input type="text" id="video_sorting" name="video_sorting" class="form-control input-lg" />
                                              </div>



                                              <div class="input-field col s12">
                                              <p for="video_banner_img"> Add Video Banner Image </p>
                                              <input type="file" name="video_banner_img" id="video_banner_img" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" />
                                              </div>


                                              <div class="input-field col s12">
                                              <p for="video_img"> Add Video Image * </p>
                                              <input type="file" name="video_img" id="video_img" class="dropify mt-3" data-default-file="" data-max-file-size="10M" data-allowed-file-extensions="png jpg jpeg" required data-error=".errorTxt4" />
                                              <small class="errorTxt4"></small>
                                              @error('video_img')
                                              <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                               </span>
                                               @enderror
                                               </div>

                                              <div class="input-field col s12">
                                              <p for="Category_id"> Select Category * </p>
                                              <select  class="browser-default custom-select" name="Category_id" required data-error=".errorTxt5">                                
                                              <option selected> </option>
                                              @foreach($category as $category)
                                              <option value="{{$category->id}}">{{$category->category_name}}</option>
                                              @endforeach
                                              <small class="errorTxt5"></small>
                                              @error('video_img')
                                              <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                               </span>
                                               @enderror
                                              </select>
                                              </div>


                                              <div class="input-field col s12">
                                              <p for="country"> Select League </p>
                                              <select name="country" id="country" class="form-control" style="width:250px">
                                              <option value="">--- Select Leagues ---</option>
                                              @foreach ($leagues as $leagues)
                                              <option value="{{$leagues->id}}">{{ $leagues->league_name }}</option>
                                              @endforeach
                                              </select>
                                              </div>

                                              <div class="input-field col s12">
                                              <p for="state">Select Season:</p>
                                              <select name="state" class="select browser-default" style="width:250px">
                                              </select>
                                              </div>
                           
                                              <div class="input-field col s12">
                                              <p for="genre"> Select Video Genre *</p>
                                              <select class="selectpicker" multiple data-live-search="true" name="genre[]" >
                                              @foreach($videogenres as $videogenre )
                                              <option value="{{$videogenre->id}}">{{$videogenre->genre_name}}</option>
                                              @endforeach
                                              <small class="errorTxt6"></small>
                                              @error('genre[]')
                                              <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                               </span>
                                               @enderror
                                              </select>
                                               </div>
                            
                                              <div class="input-field col s12">
                                              <p for="club"> Select Club </p>
                                              <select class="selectpicker" multiple data-live-search="true" name="club[]">
                                              @foreach($club as $club )
                                              <option value="{{$club->id}}">{{$club->club_name}}</option>
                                              @endforeach
                                              </select>
                                              </div>

                                              <div class="input-field col s12">
                                              <p for="player"> Select Player </p>
                                              <select class="selectpicker" multiple data-live-search="true" name="player[]">
                                              @foreach($player as $player)
                                              <option value="{{$player->id}}">{{$player->player_name}}</option>
                                              @endforeach
                                              </select>
                                              </div>

                                              <div class="input-field col s12">
                                              <p for="popularsearches"> Popular Searches </p>
                                              <select name="popularsearches" class="form-control" style="width:250px">
                                              <option value="0">No</option>
                                              <option value="1">Yes</option>
                                              </select>
                                              </div>

                             

                                              <div class="input-field col s12">
                                              <p for="video_promo"> Add Promo Video URL </p>
                                              <input type="text" name="video_promo" id="exampleInputFile1">
                                              </div>
                    </div>
                   </div><br>
                            
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
<script src={{ asset('app-assets/vendors/jquery-validation/jquery.validate.min.js') }}></script>
    <script src={{ asset('app-assets/js/scripts/form-file-uploads.js') }}></script>
    <script src={{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

 <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="country"]').on('change',function(){
               var countryID = jQuery(this).val();
               console.log(countryID);
               if(countryID == '0')
               {
                  
               }
               else
               {
                  jQuery.ajax({
                     url : 'videos/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="state"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="state"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
            });
    });

     
     </script> 
 <script>
 $('#phone-input').formatter({
        'pattern': '({{99}}-{{9999}}-{{9999}})',
        'persistent': true
      });
 </script>
@endsection

