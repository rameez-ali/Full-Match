<?php

namespace App\Http\Requests\Notification;

use App\Model\Notification;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
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
            'notify_title' => ['string', 'required'],
        ];
    }
    public function handle(){

        $this->validated();

        $params = $this->all();

        $notif = Notification::find($this->id);

        $notif->notify_title = $params['notify_title'];
        $notif->notify_title_ar = $params['notify_title_ar'];
        $notif->notify_text = $params['notify_desc'];
        $notif->notify_text_ar = $params['notify_desc_ar'];
        $notif->notify_type = $params['notify_type'];
        $notif->lang = 'en';

        $notif->save();

        return true;
    }
}
