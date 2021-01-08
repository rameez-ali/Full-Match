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
                                            <input type="text" name="video_title" Placeholder="Video Title *" class="form-control input-lg" required data-error=".errorTxt1" />
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
                            <input type="text" name="video_link" Placeholder="Video Link *" class="form-control input-lg" required data-error=".errorTxt2" />
                            <small class="errorTxt2"></small>
                                @error('video_link')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                            <input type="time" name="video_duration" Placeholder="Duration *" class="form-control input-lg" required data-error=".errorTxt3" />
                             <small class="errorTxt3"></small>
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
                    <input type="file" name="video_img" id="exampleInputFile1" required data-error=".errorTxt4">
                    <small class="errorTxt4"></small>
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
                              <select  class="browser-default custom-select" name="Category_id" required data-error=".errorTxt5">
                                
                              <option selected> Select Category </option>
                              @foreach($category as $category)
                              <option value="{{$category->id}}">{{$category->category_name}}</option>
                              @endforeach
                              <small class="errorTxt5"></small>
                              @error('video_img')
                             <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                             </span>
                              @enderror
                              </div>


                              <div class="form-group">
                              <label for="exampleInputEmail2"></label>
                              <select  class="browser-default custom-select" name="">
                              <option selected></option>
                              </div>

                              <div class="form-group">
                                    <label for="country">Select League:</label>
                                    <select name="country" id="country" class="form-control" style="width:250px">
                                    <option value="">--- Select Leagues ---</option>
                                    @foreach ($leagues as $leagues)
                                    <option value="{{$leagues->id}}">{{ $leagues->league_name }}</option>
                                    @endforeach
                                    </select>
                            </div>
            
                                     <label for="state">Select Season:</label>
                                     <select name="state" class="select browser-default" style="width:250px">
                                     </select>
                           
                           <div class="form-group">
                              <label><strong>Select Genre </strong></label><br/>
                              <select class="selectpicker" multiple data-live-search="true" name="genre[]">
                              @foreach($videogenres as $videogenre )
                              <option value="{{$videogenre->id}}">{{$videogenre->genre_name}}</option>
                              @endforeach
                              </select>
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

                            <div class="form-group">
                                            <label for="country">Popular Searches</label>
                                            <select name="popularsearches" class="form-control" style="width:250px">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                            </select>
                            </div>

                             

                    <div class="form-group">
                    <div class="input-group">
                    <div class="custom-file">
                    <label>Video Promo * </label>
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
@endsection
@section('scripts')
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
