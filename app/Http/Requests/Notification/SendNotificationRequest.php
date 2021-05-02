<?php

namespace App\Http\Requests\Notification;

use App\Model\DeviceToken;
use App\Model\Notification;
use Illuminate\Foundation\Http\FormRequest;

class SendNotificationRequest extends FormRequest
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

        $notification = Notification::find($this->id); // notify type 1 for all , 2 for guest , 3 for register

         if ($notification['notify_type'] == 1 ){
            $tokenList_en = DeviceToken::where('notify_status', 1)->where('lang', 1)->pluck('token')->toArray();
            $tokenList_ar = DeviceToken::where('notify_status', 1)->where('lang', 2)->pluck('token')->toArray();
         }
         elseif ($notification['notify_type'] == 2){
            $tokenList_en = DeviceToken::where('user_id' , null)->where('lang', 1)->pluck('token')->toArray();
            $tokenList_ar = DeviceToken::where('user_id' , null)->where('lang', 2)->pluck('token')->toArray();
         }
         elseif ($notification['notify_type'] == 3){
            $tokenList_en = DeviceToken::where('notify_status', 1)->where('lang', 1)->where('user_id' , '!=',null )->pluck('token')->toArray();
            $tokenList_ar = DeviceToken::where('notify_status', 1)->where('lang', 2)->pluck('token')->toArray();
         }


//        $tokenList = DeviceToken::pluck('token')->toArray();
//         dd($tokenList);
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        // $tokenList[] = 'eCcZ-L2K49w:APA91bHyArn9JrTqLWl1vmd_3IgE-XIDEwKAFL5B5g3RVBrSfacFfvQrXuywNXZuE2WlplXBxkFxmHoZb5oSc1hZayy8XGght7j6AyC4cS7661ck9UHseayLNPcxopCX2nWdKSXKwB8D';
        // $tokenList[] = 'f0xnoyCn90orlDK8SLGX8N:APA91bHl1l8tO_GClxgjtjsXHbO_5viCxCKJ3dmLcYbzcCcE82wxymm3IVJV9dc2OpIRkfTWBM3frUQ5Q2ZdPi6LVtSnbPSp0I7Rk4DmSaagRfmkhnQ_uwHBH3i8S8atdtk4TsTOSb5H';
        $notification_en = [
            'title' => $notification->notify_title,
            'text'  => $notification->notify_text,
            'type'  => $notification->notify_type,
            'sound' => true,
        ];

        $notification_ar = [
            'title' => $notification->notify_title_ar,
            'text'  => $notification->notify_text_ar,
            'type'  => $notification->notify_type,
            'sound' => true,
        ];

        $extraNotificationData = ["message" => $notification_en,"moredata" =>'dd'];

        $fcmNotification_en = [
            'registration_ids' => $tokenList_en, //multple token array
            // 'to' => $token, //single token
            'notification' => $notification_en,
            'data' => $extraNotificationData
        ];

        $fcmNotification_ar = [
            'registration_ids' => $tokenList_ar, //multple token array
            // 'to' => $token, //single token
            'notification' => $notification_ar,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key='.'AAAAmTF75NM:APA91bG_ohKx-gMv_t6COCCjY2BOXDbN6jHrEG9SJBlcTLVWuBuBNfIoZJznuAT2FIbOji6HVduclLhHre8oilhZQp1LwMKqQZYzL_tmNJXJ7Ph6NwhlonUnrCWZprAFkj8YUUxw_Lfx',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification_en));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification_ar));
        $result = curl_exec($ch);
        curl_close($ch);
        // print_r($result);
        return true;
    }
}
