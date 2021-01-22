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


class SearchController extends Controller
{
  public $successStatus = 200;
  public $HTTP_FORBIDDEN = 403;
  public $HTTP_NOT_FOUND = 404;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($searchword)
    {
        $video = Video::where('video_title', $searchword)
                 ->orWhere('video_title', 'like', '%' . $searchword. '%') 
                  ->get();

        $clubs  = Club::select('id')->where('club_name', $searchword)
                 ->orWhere('club_name', 'like', '%' . $searchword. '%') 
                  ->first();

        $players = Player::where('player_name', $searchword)
                 ->orWhere('player_name', 'like', '%' . $searchword. '%') 
                  ->first();                    
                 
         if(count($video)){
          
           return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Videos found.', 'data'=> $video]);

        }
         else if($clubs!=null){

            $videos = Videoclub::wherein('Club_id',$clubs)->get();

           return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Videos found.', 'data'=> $videos]);     

         } 
        else if($players!=null){

           $videos = Videoplayer::wherein('Player_id',$players)->get();

           return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Videos found.', 'data'=> $videos]);   
          
         }     
          
        else {
             return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No Video found.']);
            }
    


    
}
}




