<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;
use App\Model\Video;
use App\Model\League;
use App\Model\Video_genre;
use App\Model\Videogenre;
use App\Model\Club;
use App\Model\Player;
use App\Model\Videoclub;
use App\Model\Videoplayer;
use App\Model\Season;
use App\Model\Notify_user;
use App\Model\Popular_search;
use DB;
use \stdClass;


class VideoController extends Controller
{
  public $successStatus = 200;
  public $HTTP_FORBIDDEN = 403;
  public $HTTP_NOT_FOUND = 404;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function videos()
    {
        $video = Video::all();
        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Record found.', 'data'=> $video]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function video_details($id)
    {
       //Getting league_id of that specific video
        $leagues_id_collection = Video::select('leagues_id')->where('id', $id)->get()->first();

        $category_id_collection = Video::select('Category_id')->where('id', $id)->get()->first();

        //Converting collection to string
        $league_id=$leagues_id_collection->leagues_id;

        //Converting collection to string
        $category_id=$category_id_collection->Category_id;

        
       //check if leagues_id exists or not
       if(isset($league_id))
       {
           $videos = Video::where('leagues_id', $league_id)->get();
          return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Record found.', 'data'=> $videos]);

       }
       else{

           $videos = Video::where('Category_id', $category_id)->get();
            
            return response()->json(['success' => false, 'status' => $this->successStatus, 'message' => 'Category Related Video Found.','data'=> $videos]);

       }
        
     
          
      
     }



}
