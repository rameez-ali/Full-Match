<?php

namespace App\Http\Requests\Customer;

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

        $User->delete();

        return true;
    }
}
