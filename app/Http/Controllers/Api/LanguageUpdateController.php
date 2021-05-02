<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DeviceToken;
use Validator;

class LanguageUpdateController extends Controller
{
   public $successStatus = 200;
   public $HTTP_FORBIDDEN = 403;
   public $HTTP_NOT_FOUND = 404;

    public function languageupdate(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'token' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
          
         $form_data = array(
            'lang'       =>   $request->status
        );

        $result=DeviceToken::where('token',$request->token)->update($form_data);

         if($result){
             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Thank you message has been submitted .']);

         }
         else{
             return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Your message has not been submitted.']);

         }
    }
}
