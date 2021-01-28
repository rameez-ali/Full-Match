<?php

namespace App\Http\Requests\MyList;

use App\Model\My_wish_list;
use Illuminate\Foundation\Http\FormRequest;

class DeleteMyListRequest extends FormRequest
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
         My_wish_list::where('user_id' ,$this->custinfo)->where('video_id',$this->id)->forceDelete();
        return true;
    }
}
