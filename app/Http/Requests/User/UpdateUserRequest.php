<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email'],
        ];
    }
    public function handle(){

        $this->validated();

        $params = $this->all();

        $user = User::find($this->id);

        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->status =isset($params['status']) ? 1  : 2; //status 1 for block by admin , 2 for unblock ,or active .

        if (isset($params['password'])){
            $user->password = Hash::make($params['password']);
        }

        $user->save();

        Bouncer::sync($user)->roles([]);

        $user->assign($params['roles']);

        return true;
    }
}
