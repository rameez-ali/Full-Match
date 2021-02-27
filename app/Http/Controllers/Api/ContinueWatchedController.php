<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Video;
use App\Model\Continue_watch;
use App\Model\User;
use Validator;
use Auth;

class ContinueWatchedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  public $successStatus = 200;
  public $HTTP_FORBIDDEN = 403;
  public $HTTP_NOT_FOUND = 404;


  public function getcontinuewatch(){

      $getcontinuewatcharray=array();

      $id = Auth::user()->getId();

      $getcontinuewatch=Continue_watch::where('user_id',$id)->get();

      if($getcontinuewatch!=null){

        foreach ($getcontinuewatch as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->image));

                $getcontinuewatcharray[$k]['id'] = $v->video_id;
                $getcontinuewatcharray[$k]['name'] = $v->name;
                $getcontinuewatcharray[$k]['image'] = $video_img;
                $getcontinuewatcharray[$k]['link'] = $v->video_link;
                $getcontinuewatcharray[$k]['duration'] = $v->duration;
                $getcontinuewatcharray[$k]['position'] = $v->position;


        }
        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Your Continue Watched Videos.' , 'data'=>  $getcontinuewatcharray]);
     }
     else{
       return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'You have not Watched any Video.' , 'data'=> []]);
     }

  }
    public function continuewatch(Request $request)
    {


        $validator = Validator::make($request->input(), [
            'user_id' => 'required',
            'video_id' => 'required',
            'duration' => 'required',
            'position' => 'required',
        ]);


        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        else{

         $video_id=$request->video_id;

         $videodetails = Video::where('id',$video_id)->get()->first();

         $Continue_watch = new Continue_watch;

         $Continue_watch->user_id=$request->user_id;
         $Continue_watch->video_id=$request->video_id;
         $Continue_watch->name=$videodetails->title_en;
         $Continue_watch->image=$videodetails->video_img;
         $Continue_watch->video_link=$videodetails->video_link;
         $Continue_watch->duration=$request->duration;
         $Continue_watch->position=$request->position;


         $result=$Continue_watch->save();

        }

         if($result){
             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Continue watching has been added .']);

         }
         else{
             return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Continue watching failed to added.']);

         }
    }


}
