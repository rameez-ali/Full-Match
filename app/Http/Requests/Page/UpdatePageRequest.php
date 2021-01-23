<?php

namespace App\Http\Requests\Page;

use App\Model\Page;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'content' => ['required', 'string'],
        ];
    }
    public function handle()
    {

        $this->validated();

        $params = $this->all();

        $cmspage = Page::find($this->id);

        $cmspage->name = $params['name'];
        $cmspage->slug = $params['slug'];
        $cmspage->content = $params['content'];
        $cmspage->content_ar = $params['content_ar'];

        $cmspage->save();

        return true;
    }
}
