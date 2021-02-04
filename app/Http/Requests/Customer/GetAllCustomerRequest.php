<?php

namespace App\Http\Requests\Customer;
use App\customer;
use Illuminate\Foundation\Http\FormRequest;
use Bouncer;

class GetAllCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-customer');
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

        return Customer::select('customers.id','customers.name','users.phone','customers.email','customers.user_id')
            ->join('users','customers.user_id' , '=' ,'users.id')
            ->where('users.deleted_at',null)
            ->get();

    }
}
