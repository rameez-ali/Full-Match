<?php

namespace App\Http\Requests\Discount;

use App\Model\Promo_code;
use Illuminate\Foundation\Http\FormRequest;

class CreateDiscountRequest extends FormRequest
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
            'discount_title' => ['required', 'string'],
        ];
    }
    public function handle(){
        $this->validated();

        $params = $this->all();

        $promo_code = new Promo_code();

        $promo_code->title = $params['discount_title'];
        $promo_code->type = $params['discount_type'];
        $promo_code->value = $params['discount_value'];
        $promo_code->num_usage = $params['usage_limit'];
        $promo_code->per_user_can_use = $params['usage_peruser'];
        $promo_code->start_date = date('Y-m-d',strtotime($params['discoun_start_date']));
        $promo_code->end_date = date('Y-m-d',strtotime($params['discoun_end_date']));
        $promo_code->code = $params['customer_code'];
        $promo_code->lang = 'en';
        $promo_code->individual_user_can_use = $params['for_specific_user'];
        $promo_code->status = isset($params['status']) ? 1 : 0;
        $promo_code->save();

        return true;

    }
}
