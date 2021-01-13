<?php

namespace App\Http\Requests\Discount;

use App\Model\Order;
use App\Model\Promo_code;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ValidatePromoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'promo_code' => 'required|string',
            'subtotal' => 'required'
        ];
    }
    public function handle()
    {
        $params = $this->all();

        $discount = Promo_code::where(['code' => $params['promo_code']])->first();

        $promotion = [
            'valid' => false,
            'value' => 0,
            'type' => 'amount',
            'apply_to' => '',
            'item' => 0,
            'subtotal' => 0,
            'subtotal_only' => false

        ];

        if(!is_null($discount)){

            $user = Auth::user();

            if(!is_null($user)){
                $promo_redeem_count_user = Order::where(['code' => $params['promo_code'], 'user_email' => Auth::user()->email])->count();

                if($discount->individual_user_can_use != 0 && $discount->individual_user_can_use == $user->id){
                        if(($discount->num_usage > $promo_redeem_count_user) &&
                            ($discount->per_user_can_use > $promo_redeem_count_user) ){

                            $promotion['valid'] = true;

                        } else {

                            $promotion['valid'] = false;

                        }

                }else {

                    if ($discount->num_usage == 0 || $discount->num_usage > $promo_redeem_count_user) {
                        $promotion['valid'] = true;
                    }
                    if ($discount->per_user_can_use > $promo_redeem_count_user) {
                        $promotion['valid'] = true;
                    } else {
                        $promotion['valid'] = false;
                    }

                }

            }

            $today = date('Y-m-d H:i:s');
            $promo_redeem_count = Order::where(['code' => $params['promo_code']])->count();

            if(($discount->start_date < $today && $discount->end_date > $today) && ($discount->num_usage == 0 || $discount->num_usage > $promo_redeem_count)){
                $promotion['valid'] = true;

            }else{
                $promotion['valid'] = false;

            }
//            dd($promotion['valid']);

        }

        $response = [
            'valid' => false,
            'discounted_amount' => 0,
        ];

        if($promotion['valid']){

            $discount_val = 0;

            if($discount->status == 1){
                if ($discount->type == 'fixed') {
                    $discount_val = $discount->value;
                } else {
                    $discount_val = ($params['subtotal'] * ($discount->value / 100));
                }
            }else {
                $discount_val = 0;
                $response['valid'] = false;
            }
            $response['valid'] = true;
            $response['discounted_amount'] = $discount_val;
            $response['total'] = $params['subtotal'] - $discount_val > 0 ? $params['subtotal'] - $discount_val : 0;
        }

        return $response;
    }
}
