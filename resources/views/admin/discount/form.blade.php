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
                                            {{ __('customer.discount.add_discount') }}
                                        @else
                                            {{ __('customer.discount.edit_discount') }}
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
                                                        <label for="discount_title">{{ __('customer.title') }}*</label>
                                                        <input id="discount_title" name="discount_title" value="{{ old('discount_title',$discount->title) }}" type="text" data-error=".errorTxt1" required>
                                                        <small class="errorTxt1"></small>
                                                        @error('discount_title')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>

                                                    <div class="input-field col s12">

                                                        <p class="mb-1"> <label>{{ __('customer.discount.discount_type') }}*</label></p>

                                                        <p class="mb-1">
                                                            <label>
                                                                <input name="discount_type" value="fixed" {{ $discount->type == 'fixed' ? 'checked' : '' }}  @if(!$edit) checked="checked" @endif type="radio" />
                                                                <span>{{ __('customer.discount_fixed') }}</span>
                                                            </label>
                                                        </p>

                                                        <p class="mb-1">
                                                            <label>
                                                                <input name="discount_type" value="percentage" {{ $discount->type == 'percentage' ? 'checked' : '' }} type="radio" />
                                                                <span>{{ __('customer.discount_percentage') }}</span>
                                                            </label>
                                                        </p>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="discount_value">{{ __('customer.value') }}*</label>
                                                        <input id="discount_value" type="number" value="{{ old('discount_value',$discount->value) }}" name="discount_value" min="0.1" step=".001" data-error=".errorTxt2" required>
                                                        <small class="errorTxt2"></small>
                                                        @error('discount_value')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="usage_limit">{{ __('customer.discount.usage_limit') }}*</label>
                                                        <input id="usage_limit" type="number" value="{{ old('usage_limit',$discount->num_usage) }}" name="usage_limit" min="1" data-error=".errorTxt3" required>
                                                        <small class="errorTxt3"></small>
                                                        @error('usage_limit')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="usage_peruser">{{ __('customer.discount.usage_peruser') }}*</label>
                                                        <input id="usage_peruser" type="number" value="{{ old('usage_peruser',$discount->per_user_can_use) }}" name="usage_peruser" min="1" data-error=".errorTxt4" required>
                                                        <small class="errorTxt4"></small>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <select id="for_specific_user" class="select2 browser-default" name="for_specific_user">
                                                                <option value="0">none</option>
                                                            @foreach($customers as $customer)
                                                                <option value="{{$customer->user_id}}"  {{ $customer->user_id == $discount->individual_user_can_use ? 'selected' : '' }} >{{$customer->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="discoun_start_date">{{ __('customer.subsplan.subsplan_start') }}*</label>
                                                        <input id="discoun_start_date" type="text" name="discoun_start_date" value="{{ old('discoun_start_date',$discount->start_date) }}" class="datepicker" required>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="discoun_end_date">{{ __('customer.subsplan.subsplan_end') }}*</label>
                                                        <input id="discoun_end_date" type="text" name="discoun_end_date" value="{{ old('discoun_end_date',$discount->end_date) }}" class="datepicker"  required>
                                                    </div>

                                                    <div class="input-field col s6">
                                                        <input value="{{ old('code',$discount->code) }}" name="customer_code" placeholder="{{ __('customer.code') }}" id="customer_code" type="text" class="validate" data-error=".errorTxt5" required>
                                                        <label for="customer_code" class="active">{{ __('customer.code') }}</label>
                                                        <small class="errorTxt5"></small>
                                                        @error('code')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="input-field col s6">
                                                        <button class="btn waves-effect waves-light" id="generate-code" type="button" name="action">{{ __('customer.generate') }}</button>
                                                        <label class="active">&nbsp;</label>
                                                    </div>

                                                    <div class="input-field col s12">

                                                        <p class="mb-1">
                                                            <label>
                                                                <input name="status" {{ $discount->status == '1' ? 'checked' : '' }}  @if(!$edit) checked="checked" @endif type="checkbox" />
                                                                <span>{{ __('customer.status') }}</span>
                                                            </label>
                                                        </p>
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
                discount_title: {
                    required: true,
                    minlength: 5,
                },
                discount_value: {
                    required: true,
                    min: 0.1,
                } ,
                usage_limit: {
                    required: true,
                    min: 1,
                },
                usage_peruser: {
                    required: true,
                    min: 1,
                },
                customer_code: {
                    required: true,
                    minlength: 6,
                },
            },
            //For messages
            messages: {
                discount_title: {
                    required: "Enter Discount Title",
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

    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    $(function(){
        $('#generate-code').click(function(){
            let code = makeid(8);
            $('#customer_code').val(code);
        })
    })
</script>
@endsection
