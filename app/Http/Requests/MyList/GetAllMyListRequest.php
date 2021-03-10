<?php

namespace App\Http\Requests\MyList;

use App\Model\My_wish_list;
use Illuminate\Foundation\Http\FormRequest;

class GetAllMyListRequest extends FormRequest
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
    public function handle()
    {
        return My_wish_list::with('wishlistvideo')
            ->whereHas('wishlistvideo', function($query){ $query->orWhere('deleted_at', '!=', null); })
            ->where('user_id' ,$this->custinfo)
            ->get();
    }
}
