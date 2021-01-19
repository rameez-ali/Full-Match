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
                                        @if(!$edit)
                                            {{ __('customer.notification.add_notification') }}
                                        @else
                                            {{ __('customer.notification.edit_notification') }}
                                        @endif
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <form class="formValidate" id="formValidate" method="POST" action="{{ $route }}" >
                                                @csrf
                                                @if($edit)
                                                    @method('PUT')
                                                @endif
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <label for="notify_title">{{ __('customer.title') }}*</label>
                                                        <input id="notify_title" value="{{ old('notify_title',$notification->notify_title) }}" name="notify_title" type="text" data-error=".errorTxt1" required>
                                                        <small class="errorTxt1"></small>
                                                    </div>

                                                        @error('notify_title')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror

                                                    <div class="input-field col s12">
                                                        <textarea id="notify_desc" name="notify_desc" value="{{ old('notify_desc',$notification->notify_text) }}"  class="materialize-textarea validate" data-error=".errorTxt2" required>{{ old('notify_desc',$notification->notify_text) }}</textarea>
                                                        <label for="notify_desc">{{ __('customer.decs') }}</label>
                                                        <small class="errorTxt2"></small>
                                                    </div>

                                                    <div class="input-field col s12">

                                                        <p class="mb-1"> <label>{{ __('customer.notification.notification_type') }}*</label></p>

                                                        <p class="mb-1">
                                                            <label>
                                                                <input name="notify_type" value="1" {{ $notification->notify_type == '1' ? 'checked' : '' }}  @if(!$edit) checked="checked" @endif type="radio" />
                                                                <span>{{ __('customer.notification.all_user') }}</span>
                                                            </label>
                                                        </p>

                                                        <p class="mb-1">
                                                            <label>
                                                                <input name="notify_type" value="2" {{ $notification->notify_type == '2' ? 'checked' : '' }} type="radio" />
                                                                <span>{{ __('customer.notification.guest_user') }}</span>
                                                            </label>
                                                        </p>

                                                        <p class="mb-1">
                                                            <label>
                                                                <input name="notify_type" value="3" {{ $notification->notify_type == '3' ? 'checked' : '' }} type="radio" />
                                                                <span>{{ __('customer.notification.registered_user') }}</span>
                                                            </label>
                                                        </p>
                                                        <small class="errorTxt4"></small>
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
    <script src={{ asset('app-assets/js/scripts/form-elements.js') }}></script>
<script>
    /*
 * Form Validation
 */

    $(function () {

        $('.datepicker').datepicker({
            defaultDate: new Date()
        });

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
                notify_title: {
                    required: true,
                },
                notify_desc: {
                    required: true,
                },
            },
            //For messages
            messages: {
                notify_title: {
                    required: "Enter Title",
                },
                notify_desc: {
                    required: "Enter Description",
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
