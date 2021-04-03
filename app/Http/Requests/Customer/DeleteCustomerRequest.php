<?php

namespace App\Http\Requests\Customer;

use App\customer;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Bouncer;

class DeleteCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('delete-customer');
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

        $User = User::find($this->id);

        $User->forceDelete();

        customer::where('user_id' , $User->id )->forceDelete();

        return true;
    }
}
