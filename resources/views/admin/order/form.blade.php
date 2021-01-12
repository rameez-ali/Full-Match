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
                                    @if($edit)
                                        {{ __('customer.cmspage.edit_cmspage') }}
                                    @endif

                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <form class="formValidate" id="formValidate" method="POST" action="{{ $route }}">
                                            @csrf
                                            @if($edit)
                                                @method('PUT')
                                            @endif

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <label for="name">{{ __('customer.name') }} *</label>
                                                    <input id="name" name="name" type="text"  data-error=".errorTxt1">
                                                    <small class="errorTxt1"></small>

                                                </div>

                                                <div class="input-field col s12">
                                                    <select id="user_email" class="select2 browser-default" name="user_email" required>
                                                        <option value="0">Select Customer</option>
                                                        @foreach($allcusts as $allcust)
                                                            <option value="{{$allcust->user_id}}" >{{$allcust->email}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <select id="subsplans" class="select2 browser-default" name="subsplans" required>
                                                        <option value="0" >Select Plan</option>
                                                        @foreach($allsubplans as $allsubplan)
                                                            <option value="{{$allsubplan->id}}" data-price="{{ $allsubplan->plan_price }}" data-discounted-price="0">{{$allsubplan->plan_title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-field col s6">
                                                    <label for="promo_code">{{ __('customer.code') }}</label>
                                                    <input id="promo_code" name="promo_code" type="text"  data-error=".errorTxt2">
                                                    <small class="errorTxt2"></small>
                                                </div>

                                                <div class="input-field col s6">
                                                    <button class="btn waves-effect waves-light" id="verify_code" type="button" name="code_chk">{{ __('customer.verify_code') }}</button>
                                                    <label class="active">&nbsp;</label>
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="sub_total">{{ __('customer.sub_total') }}</p>
                                                    <input id="sub_total" type="number" name="sub_total" min="0.1" step=".001" data-error=".errorTxt3" readonly required>
                                                    <small class="errorTxt3"></small>
                                                    @error('sub_total')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="input-field col s12">
                                                    <p for="discount_amount">{{ __('customer.discounted_value') }}</p>
                                                    <input id="discount_amount" type="number" name="discount_amount" step=".001" data-error=".errorTxt4" readonly>
                                                    <input type="hidden" name="discount_value" id="order-discount-value" />
                                                    <input type="hidden" name="discount_type" id="order-discount-type" />

                                                    <input type="hidden" name="apply_to" id="order-discount-apply_to" />
                                                    <input type="hidden" name="item" id="order-discount-item" />
                                                    <input type="hidden" name="subtotal_only" id="order-discount-subtotal_only" />
                                                    <small class="errorTxt4"></small>
                                                    @error('discount_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>


                                                <div class="input-field col s12">
                                                    <p for="grand_total">{{ __('customer.grand_total') }}</p>
                                                    <input id="grand_total" type="number" name="grand_total" min="0.1" step=".001" data-error=".errorTxt5" readonly required>
                                                    <small class="errorTxt5"></small>
                                                    @error('grand_total')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
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

        $(function(){
            $(document).on('change','#subsplans',function(){
                // console.log(calculatePrice())
                calculatePrice()
            })
        })

        function calculatePrice()
        {
            let results = [];

            $('#subsplans').find('option:selected').each(function() {

                 if($('#order-discount-apply_to').val() == 'plans' && $('#order-discount-item').val() == $(this).val()){
                  results.push({ price : parseFloat($(this).data('price')), discount : true , discounted_price : $(this).data('discounted-price') });
                 }else{
                     results.push({ price : parseFloat($(this).data('price')), discount : false , discounted_price : $(this).data('discounted-price') });
                 }
            });

            let total = 0;
            let total_discount = 0;

            let subtotal = 0;
            let discount = 0;

            results.map(item => {

                subtotal += parseFloat(item.price);

                if(item.discount){

                    let value = $('#order-discount-value').val();
                    let disc = 0;

                    if($('#order-discount-type').val() == 'percentage'){
                        disc = parseFloat(item.price) * parseFloat(value) / 100;
                    }else{
                        disc = parseFloat(item.price) - parseFloat(value);
                    }

                    discount += disc;

                }else{
                    discount += item.discounted_price;
                }
            })

            $('#discount_amount').val(discount);
            $('#sub_total').val(subtotal);
            $('#grand_total').val(subtotal - discount);
        }

        $(function(){
            $('#verify_code').click(function(){
                let code = $('#promo_code').val();
                let subtotal = $('#sub_total').val();
                console.log(code);
                if(code != '' && code != null){
                    $.ajax({
                        url: `{{ route('discount.promo.verify') }}`,
                        method: 'POST',
                        data : {promo_code : code , subtotal : subtotal},
                        success : function(response){
                            console.log(response);
                            let { discounted_amount, valid } = response;
                            if(valid){
                                $('#discount_amount').val(parseFloat(discounted_amount).toFixed(3) );
                                $('#grand_total').val(parseFloat(response.total).toFixed(3));
                                // config.order.total = response.total
                                // goSell.config(config);
                                if(parseFloat(discounted_amount).toFixed(3) == 0){
                                    $('#discount-failed').alert('Discount Failed');
                                }else{
                                    $('.app').html('مطبق');

                                }
                            }else{
                                $('.app').html('غير صالحة');
                                $('#discount-failed').alert('Discount Failed');
                            }
                        }
                    })
                }else{
                    $('#discount_amount').val('');
                    $('#grand_total').val($('#sub_total').val());
                }
            })
        })

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
                    name: {
                        required: true,
                    },
                },
                //For custom messages
                messages: {
                    name: {
                        required: "Enter Customer"
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
