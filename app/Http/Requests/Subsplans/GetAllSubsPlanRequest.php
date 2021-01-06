<?php

namespace App\Http\Requests\Subsplans;

use App\Model\Subs_plan;
use Illuminate\Foundation\Http\FormRequest;

class GetAllSubsPlanRequest extends FormRequest
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
        return Subs_plan::all();
    }
}
