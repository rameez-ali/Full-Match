<?php

namespace App\Http\Requests\Customer;

use App\customer;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CreateCustomerRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['integer', 'min:8'],
        ];
    }

    public function handle(){

        $this->validated();

        $params = $this->all();
//        dd($params);
        $user = new User();

        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->phone = $params['phone'];
        $user->password = Hash::make($params['password']);
        $user->is_customer = 1;

        $user->save();

        $customer = new Customer();

        $customer->name = $params['name'];
        $customer->email = $params['email'];
//      $customer->user_image = $params['image'];
        $path = $this->file('avatar')->store('avatarDp');

        $customer->user_image = 'storage/app/public/'.$path;

        $customer->user_id = $user->id;
        $customer->save();

        return true;
    }
}
