<?php

namespace App\Http\Requests\Page;

use App\Model\Page;
use Illuminate\Foundation\Http\FormRequest;
use Bouncer;

class GetAllPagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-cmspage');
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

        return Page::all();
    }
}
