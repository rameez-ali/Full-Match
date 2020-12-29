<?php

namespace App\Http\Requests\Customer;
use App\User;
use App\customer;
use DB;
use Illuminate\Foundation\Http\FormRequest;

class GetAllCustomerRequest extends FormRequest
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

    public function handle(){
        return DB::table('customers')
            ->Join('users', 'customers.user_id' , '=' ,'users.id')
            ->Where('users.deleted_at', null)
            ->get();

    }
}
