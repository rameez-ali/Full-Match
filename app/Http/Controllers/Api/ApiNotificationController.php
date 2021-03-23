<?php

namespace App\Http\Controllers\Api;

use App\customer;
use App\Http\Controllers\Controller;
use App\Model\DeviceToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ApiNotificationController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;

    public function notifiOff(Request $request)
    {
        $cust = DeviceToken::where('user_id',$request->user()->id)->First();
        $cust->notify_status = 0;
        $cust->save();
        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Notification OFF.']);
    }
    public function notifiOn(Request $request)
    {
        $cust = DeviceToken::where('user_id',$request->user()->id)->First();
        $cust->notify_status = 1;
        $cust->save();
        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Notification ON.']);
    }
}
