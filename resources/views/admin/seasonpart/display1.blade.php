@extends('admin.layouts.app')
@section('content')
<div class="pt-3 pb-1" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ __('exam.exams') }}</span></h5>
            </div>
            <div class="col s12 m6 l6 right-align-md">
                <ol class="breadcrumbs mb-0">
                    <li class="breadcrumb-item active">{{ __('exam.add') }}</li>
                    <li class="breadcrumb-item">{{ __('exam.exams') }}</li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('exam.home') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="col s12">
    <div class="container">
<div class="row">
    <div class="col s12">
        <div id="input-fields" class="card card-tabs">
            <div class="card-content">
                <!-- <div class="card-title">
                    <div class="row">
                        <div class="col s12 m6 l10">
                            <h4 class="card-title">{{ __('exam.add') }}</h4>
                        </div>
                    </div>
                </div> -->
                <div id="view-input-fields" class="active">
                    <div class="row">
                        <div class="col s12">
                            <form method="POST" action="" class="row"  enctype="multipart/form-data"  >
                                @csrf
                                
                                    @method('PUT')
                                
                                <div class="col s12">
                                    <div id="question-section" >
                                        <div class="question-section" data-id="0">
                                           
                                            <div class="input-field col s2"></div>                                            
                                            <div class="answer-section"> 
                                                
                                                        <div class="answer-section-{{ $loop->index + 1 }}">
                                                            <div class="input-field col s8">
                                                                <input value="{{ $answer->answer }}" name="answers[]" placeholder="{{ __('exam.answer') }}" id="customer-answer" type="text" class="validate" required >
                                                                <label for="customer-answer" class="active">{{ __('league.season') }}</label>
                                                            </div>
                                                            <div class="input-field col s2">
                                                                <label>
                                                                    <input type="radio" name="is_default" value="{{ $loop->index }}" id="exam-subtotal" {{ $answer->is_correct ? 'checked' : '' }} />
                                                                    <span for="exam-subtotal" >{{ __('league.season') }}</span>
                                                                </label>                                            
                                                            </div>
                                                            <div class="input-field col s2">
                                                                @if($loop->index > 0)
                                                                <button class="btn waves-effect waves-light btn-small remove-button" type="button" name="action">{{ __('exam.remove') }}</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    
                                                    <div class="answer-section-1">
                                                        <div class="input-field col s8">
                                                            <input value="" name="answers[]" placeholder="{{ __('exam.answer') }}" id="customer-answer" type="text" class="validate" required >
                                                            <label for="customer-answer" class="active">{{ __('exam.answer') }}</label>
                                                        </div>
                                                        <div class="input-field col s2">
                                                            <label>
                                                                <input type="radio" name="is_default" value="0" id="exam-subtotal" checked />
                                                                <span for="exam-subtotal" >{{ __('exam.default') }}</span>
                                                            </label>                                            
                                                        </div>
                                                        <div class="input-field col s2">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light btn-small" type="button" name="action" onclick="addAnswer(this)" >
                                                    {{ __('exam.add_another_season') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="input-field col s12 pt-3">
                                        <button class="btn waves-effect waves-light " type="submit" name="action">{{ __('exam.submit') }}</button>
                                        <a class="btn waves-effect waves-light " href="{{ route('exam.questions',[ 'exam_id' => $exam_id ]) }}" name="action">{{ __('exam.cancel') }}</a>
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
@endsection
@section('scripts')
<script type="text/javascript" >
function addAnswer(element)
{
    let sections = $('.question-section').length;
    let number = $(element).parent().parent().data('id');
    let ans = $(element).parent().siblings('.answer-section').find('.answer-section-1').length ;
    const answer = `<div class="answer-section-1">
        <div class="input-field col s8">
            <input value="{{ old('answer') }}" name="answers[]" placeholder="{{ __('exam.answer') }}" id="customer-answer" type="text" class="validate">
            <label for="customer-answer" class="active">{{ __('exam.answer') }}</label>
        </div>
        <div class="input-field col s2">
            <label>
                <input type="radio" name="is_default" value="${ans}" id="exam-subtotal" />
                <span for="exam-subtotal" >{{ __('exam.default') }}</span>
            </label>                                            
        </div>
        <div class="input-field col s2">
            <button class="btn waves-effect waves-light btn-small remove-button" type="button" name="action">{{ __('exam.remove') }}</button>
        </div>
    </div>`;
    $(element).parent().siblings('.answer-section').append(answer);
}
$(function(){
    $(document).on('click','.remove-button',function(){
        $(this).parent().parent().remove();
    })
})
</script>
@endsection