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
        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Record found.', 'data'=> $contactus]);

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
              return ["Result"=>"Thank you for submitting your query"];
         }
         else{
             return ["Result"=>"Message has not been sent"];
         }
    }


}
