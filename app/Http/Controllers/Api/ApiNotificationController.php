<?php

namespace App\Http\Controllers\Api;

use App\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiNotificationController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;

    public function notifiOff()
    {
        $user = Auth::user();
        $cust = customer::all();
        dd('workingg' ,$user);
//            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Club found.', 'data' => $array]);
    }
}
