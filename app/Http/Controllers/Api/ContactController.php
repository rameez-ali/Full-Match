<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProjectCategory;
use App\Model\Videoclub;
use App\Model\Contact;
use App\Model\Fullmatchcontact;
use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  public $successStatus = 200;
  public $HTTP_FORBIDDEN = 403;
  public $HTTP_NOT_FOUND = 404;

    public function contact()
    {
        $contactus = Fullmatchcontact::all();
        if (!$contactus->isEmpty()) {

            foreach ($contactus as $k => $v) {
                $array[$k]['id'] = $v->id;
                $array[$k]['call_us'] = $v->call_us;
                $array[$k]['email_us'] = $v->email_us;
                $array[$k]['address'] = $v->address_en;
                $array[$k]['address_ar'] = $v->address_ar;
            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Contact Info found.', 'data' => $array]);

        }else{
            return response()->json(['error' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No Contact Info found.', 'data' => []]);
        }

    }


    public function query(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
         $Contact = new Contact;
         $Contact->name=$request->name;
         $Contact->email=$request->email;
         $Contact->message=$request->message;
         $result=$Contact->save();

         if($result){
             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Thank you message has been submitted .']);

         }
         else{
             return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Your message has not been submitted.']);

         }
    }


}
