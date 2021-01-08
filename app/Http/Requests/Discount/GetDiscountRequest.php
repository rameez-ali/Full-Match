<?php

namespace App\Http\Requests\Discount;

use App\Model\Promo_code;
use Illuminate\Foundation\Http\FormRequest;

class GetDiscountRequest extends FormRequest
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

        return Promo_code::findOrNew($this->id);

    }
}
