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
                             <form method="post" action="{{ route('league-form.store') }}" enctype="multipart/form-data">
                              @csrf

                                <div class="col s12">
                                    <div id="question-section" >
                                        <div class="question-section" data-id="0">
                                            <div class="card-body">
                                       <div class="form-group">
                                       <input type="text" name="league_name" Placeholder="League Name *" class="form-control input-lg"></textarea>
                                       </div>
                                       <br/>
                                       
                
                                        <div class="form-group">
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <label>League Banner</label>
                                        <input type="file" name="filename1" multiple id="exampleInputFile">
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                         <div class="form-group">
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <label>Promo Video *</label>
                                        <input type="file" name="filename2" multiple id="exampleInputFile">
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                         <div class="form-group">
                                        <div class="input-group">
                                        <div class="custom-file">
                                        <label>Profile Image*</label>
                                        <input type="file" name="filename3" multiple id="exampleInputFile">
                                        </div>
                                        </div>
                                        </div>
                                         <br/>

                                        <div class="card-body">
                                        <div class="form-group">
                                        <input type="text" name="league_description" palceholder="Description" class="form-control input-lg"></textarea>
                                        </div>

                                            <div class="answer-section"> 
                                                 <div class="answer-section">
                                                            <div class="input-field col s8">
                                                                <input value="" name="seasons[]" id="customer-answer" type="file" class="validate" required >
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
                                <div class="card-footer">
                                     <input type="submit" name="add" class="btn btn-primary input-lg" value="Submit" />
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
            <input value="{{ old('answer') }}" name="seasons[]" id="customer-answer" type="file" class="validate">
        </div>
        
        <div class="input-field col s2">
            <button class="btn waves-effect waves-light btn-small remove-button" type="button" name="action">{{ __('exam.remove') }}</button>
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