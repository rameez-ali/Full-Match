<?php

namespace App\Http\Requests\Homepgmanage;

use App\Model\HomePageManagement;
use Illuminate\Foundation\Http\FormRequest;

class GetAllHomePgManageRequest extends FormRequest
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
        return HomePageManagement::all();
    }
}
