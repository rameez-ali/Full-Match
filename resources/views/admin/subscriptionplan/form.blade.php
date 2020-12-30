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
                                            {{ __('customer.subsplan.add_subsplan') }}
                                        @else
                                            {{ __('customer.subsplan.edit_subsplan') }}
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
                                                        <label for="subp_title">{{ __('customer.subsplan.subsplan_title') }}*</label>
                                                        <input id="subp_title" value="{{ old('subp_title',$subscriptionplan->plan_title) }}" name="subp_title" type="text" data-error=".errorTxt1" required>
                                                        <small class="errorTxt1"></small>
                                                    </div>

                                                        @error('subp_title')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror

                                                    <div class="input-field col s12">
                                                        <textarea id="subp_desc" name="subp_desc" value="{{ old('subp_desc',$subscriptionplan->plan_Description) }}" class="materialize-textarea validate" data-error=".errorTxt2" required>{{ old('subp_title',$subscriptionplan->email) }}</textarea>
                                                        <label for="subp_desc">{{ __('customer.subsplan.subsplan_decs') }}*</label>
                                                        <small class="errorTxt2"></small>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="subp_price">{{ __('customer.subsplan.subsplan_price') }}*</label>
                                                        <input id="subp_price" type="number" name="subp_price" value="{{ old('subp_price',$subscriptionplan->plan_price) }}" min="0.1" step=".001" data-error=".errorTxt3" required>
                                                        <small class="errorTxt3"></small>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="subp_start_date">{{ __('customer.subsplan.subsplan_start') }}*</label>
                                                        <input id="subp_start_date" type="text" name="subp_start_date" value="{{ old('subp_start_date',$subscriptionplan->start_date) }}" class="datepicker" data-error=".errorTxt4"required>
                                                        <small class="errorTxt4"></small>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="subp_end_date">{{ __('customer.subsplan.subsplan_end') }}*</label>
                                                        <input id="subp_end_date" type="text" name="subp_end_date" value="{{ old('subp_end_date',$subscriptionplan->end_date) }}" class="datepicker" data-error=".errorTxt5" required>
                                                        <small class="errorTxt5"></small>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="subp_sort">{{ __('customer.subsplan.subsplan_sort') }}*</label>
                                                        <input id="subp_sort" type="number" name="subp_sort" value="{{ old('subp_sort',$subscriptionplan->sort_by) }} min="1" data-error=".errorTxt3" required>
                                                        <small class="errorTxt3"></small>
                                                    </div>

                                                    <div class="col s12">
                                                        <label for="subsplan_notify">{{ __('customer.subsplan.subsplan_notify') }}*</label>
                                                        <p>
                                                            <label>
                                                                <input type="checkbox" id="subsplan_notify"  name="subsplan_notify" />
                                                                <span></span>
                                                            </label>
                                                        </p>
                                                        <div class="input-field">
                                                            <small class="errorTxt6"></small>
                                                        </div>
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
                subp_title: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
            },
            //For messages
            messages: {
                subp_title: {
                    required: "Enter Title",
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
