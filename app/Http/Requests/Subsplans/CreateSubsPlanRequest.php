<?php

namespace App\Http\Requests\Subsplans;

use App\Model\subs_plan;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubsPlanRequest extends FormRequest
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

        $this->validated();

        $params = $this->all();

        $sub_plan = new subs_plan();

        $sub_plan->plan_title = $params['subp_title'];
        $sub_plan->plan_Description = $params['subp_desc'];
        $sub_plan->plan_price = $params['subp_price'];
        $sub_plan->lang = "en";
        $sub_plan->start_date = date('Y-m-d H:i:s',strtotime($params['subp_start_date']));
        $sub_plan->end_date = date('Y-m-d H:i:s',strtotime($params['subp_end_date']));
        $sub_plan->sort_by = $params['subp_sort'];
//        $sub_plan->notify = $params['title'];

        $sub_plan->save();

        return true;
    }
}
