<?php

namespace App\Http\Requests\Notification;

use App\Model\Notification;
use Illuminate\Foundation\Http\FormRequest;
use Bouncer;

class GetNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-notify');
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

        return Notification::findOrNew($this->id);

    }
}
