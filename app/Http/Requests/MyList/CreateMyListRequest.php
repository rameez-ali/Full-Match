<?php

namespace App\Http\Requests\MyList;

use App\Model\My_wish_list;
use Illuminate\Foundation\Http\FormRequest;

class CreateMyListRequest extends FormRequest
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
        $params = $this->all();

        $mylist = new My_wish_list();
        $mylist->user_id = $this->custinfo;
        $mylist->video_id = $this->id;
        $mylist->lang = 'en';

        $mylist->save();
        return true;
    }
}
