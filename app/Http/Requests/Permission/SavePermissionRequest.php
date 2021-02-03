<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Bouncer;

class SavePermissionRequest extends FormRequest
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

        $role = $params['role'];

        $permissions = $params['permission'];

        Bouncer::sync($role)->abilities([]);

        foreach($permissions as $permission){
            Bouncer::allow($role)->to($permission);
        }
        return true;
    }
}
