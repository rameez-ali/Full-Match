<?php

namespace App\Http\Requests\Customer;
use App\User;
use App\customer;
use Illuminate\Foundation\Http\FormRequest;
use Bouncer;

class GetCustomerRequest extends FormRequest
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

        $customer = Customer::with('user')->findOrNew($this->id);

        if(is_null($customer->user)){
            $customer->user = new User;
        }

        return $customer;
    }
    public function handle_edit(){

        return Customer::with('user')->where('id',$this->id)->First();

    }
    public function handle_editApi(){

        return Customer::with('user')->where('user_id',$this->id)->First();

    }
}
