<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CreateUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
    public function handle(){

        $this->validated();

        $params = $this->all();
        $user = new User();

        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->phone = 12341234;
        $user->password = Hash::make($params['password']);
        $user->is_customer = 3;

        $user->save();
        return true;
    }
}
