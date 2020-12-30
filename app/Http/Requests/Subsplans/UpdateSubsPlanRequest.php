<?php

namespace App\Http\Requests\Subsplans;
use App\Model\subs_plan;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubsPlanRequest extends FormRequest
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
            'subp_title' => ['required', 'string'],
        ];
    }
    public function handle()
    {

        $this->validated();

        $params = $this->all();

        $subsplan = subs_plan::find($this->id);

        $subsplan->plan_title = $params['subp_title'];
        $subsplan->plan_Description = $params['subp_desc'];
        $subsplan->plan_price = $params['subp_price'];
        $subsplan->start_date = $params['subp_start_date'];
        $subsplan->end_date = $params['subp_end_date'];
        $subsplan->sort_by = $params['subp_sort'];
//      $subsplan->notify = $params['subsplan_notify'];
        $subsplan->save();

        return true;
    }
}
