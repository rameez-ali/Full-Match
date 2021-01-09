<?php

namespace App\Http\Requests\Discount;

use App\Model\Promo_code;
use Illuminate\Foundation\Http\FormRequest;

class DeleteDiscountRequest extends FormRequest
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
            //
        ];
    }
    public function handle(){

        $plan = Promo_code::find($this->id);

        $plan->delete();

        return true;
    }
}
