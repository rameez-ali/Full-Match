@extends('admin.layouts.app')
@section('content')

<div class="col s12">
    <div class="container">
<div class="row">
    <div class="col s12">
        <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                        ADD LEAGUE
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Details</a>
                                    </h4>
                            <div class="row">
                             <form method="post" action="{{ route('league-form.update', $league->id) }}" enctype="multipart/form-data">
                             @csrf
                             @method('PATCH')
                                <div class="col s12">
                                    <div id="question-section" >
                                        <div class="question-section" data-id="0">
                                            <div class="card-body">
                                       <div class="form-group">
                                       <input type="text" name="league_name" Placeholder="League Name *" value="{{ $league->league_name }}" class="form-control input-lg"></textarea>
                                       </div>
                                       <br/>


                                        <div class="form-group">
                                       <label class="col-md-4 text-right">Select League Banner</label>
                                       <div class="col-md-8">
                                       <input type="file" name="league_banner" />
                                       <input type="hidden" name="hidden_image1" value="{{ $league->league_banner }}" />
                                       </div>
                                       </div>

                                       <div class="form-group">
                                       <input type="text" name="league_promo_video" Placeholder="League Promo Video URL *" value="{{ $league->league_promo_video }}" class="form-control input-lg" required data-error=".errorTxt2"></textarea>
                                       <small class="errorTxt2"></small>
                                        @error('filename2')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                       </div>
                                       <br/>

                                            <div class="form-group">
                                                <label class="col-md-4 text-right">Select Profile Image</label>
                                                <div class="col-md-8">
                                                    <input type="file" name="league_profile_image" />
                                                    <input type="hidden" name="hidden_image3" value="{{ $league->league_profile_image }}" />
                                                </div>
                                            </div><br>

                                         <div class="form-group">
                                               <label class="col-md-4 text-right">Add League Sorting</label>
                                               <div class="col-md-8">
                                               <input type="text" name="league_sorting" value="{{ $league->league_sorting }}" class="form-control input-lg" />
                                            </div><br>

                                        <div class="card-body">
                                        <div class="form-group">
                                        <input type="text" name="league_description" value="{{ $league->league_description }}" placeholder="Description" class="form-control input-lg"></textarea>
                                        </div>

                                            <div class="answer-section">
                                                 <div class="answer-section">
                                                    <div class="input-field col s8">
                                                            <input type="text" placeholder="Promo Video URL for Season 1"  name="filename4[]" id="exampleInputFile" >
                                                    </div>
                                                      <div class="input-field col s2">
                                                            <button class="btn waves-effect waves-light btn-small remove-button" type="button" name="action">{{ __('remove') }}</button>
                                                      </div>
                                                    </div>


                                            </div>
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light btn-small" type="button" name="action" onclick="addAnswer(this)" >
                                                    {{ __('Add Another Season') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div></div></div>
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
@endsection
@section('scripts')
<script type="text/javascript">
function addAnswer(element)
{
    var counter = 1;

    let sections = $('.question-section').length;
    let number = $(element).parent().parent().data('id');
    let ans = $(element).parent().siblings('.answer-section').find('.answer-section-1').length ;
    const answer = `<div class="answer-section-1">
        <div class="input-field col s8">
            <input type="text" name="filename4[]" placeholder="Promo Video URL for Season" id="exampleInputFile" >
        </div>

        <div class="input-field col s2">
            <button class="btn waves-effect waves-light btn-small remove-button" type="button" name="action">{{ __('Remove') }}</button>
        </div>
    </div>`;
    $(element).parent().siblings('.answer-section').append(answer);
    counter = counter + 1;
}
$(function(){
    $(document).on('click','.remove-button',function(){
        $(this).parent().parent().remove();
    })
})
</script>
@endsection
