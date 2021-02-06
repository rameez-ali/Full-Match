<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Silber\Bouncer\Database\Role;
use Bouncer;

class CreateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('add-role');
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
            'title' => ['required', 'string'],
        ];
    }
    public function handle(){

        $this->validated();

        $params = $this->all();

        $role = new Role();

        $role->name = $params['name'];
        $role->title = $params['title'];

        $role->save();

        return true;
    }
}
