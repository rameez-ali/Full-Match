<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Category;
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


class SearchSuggestionController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchsuggestion($searchword)
    {
        $obj = new stdClass;

        $videosclub = array();
        $videosonly = array();
        $videosplayer = array();
        $popular_search_video = array();
        $result = array();

        $video = Video::where('title_en', $searchword)
            ->orwhere('title_ar', $searchword)
            ->orWhere('title_en', 'like', '%' . $searchword. '%')
            ->orWhere('title_ar', 'like', '%' . $searchword. '%')
            ->get();


        $clubs  = Club::select('id')->where('name_en', $searchword)
            ->orwhere('name_ar', $searchword)
            ->orWhere('name_en', 'like', '%' . $searchword. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword. '%')
            ->get();


        $players = Player::select('id')->where('name_en', $searchword)
            ->orwhere('name_ar', $searchword)
            ->orWhere('name_en', 'like', '%' . $searchword. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword. '%')
            ->get();

        $popular_search_videos = Video::where('popular_searches', 2)->get();

        if(count($video)){
            $videosonly = Video::select('title_en as name')->where('title_en', $searchword)
            ->orwhere('title_ar', $searchword)
            ->orWhere('title_en', 'like', '%' . $searchword. '%')
            ->orWhere('title_ar', 'like', '%' . $searchword. '%')
            ->get()
            ->toArray();

        }
        // $obj->Byvideotitle= $videosonly;

        if($clubs!=null){

            $video_id = Videoclub::select('Video_id')->wherein('Club_id',$clubs)->get();
            $videosclub=Video::select('title_en as name')->wherein('id',$video_id)->get()->toArray();

        }
        // $obj->Byclubname = $videosclub;

        if($players!=null){

            $video_id = Videoplayer::select('Video_id')->wherein('Player_id',$players)->get();
            $videosplayer=Video::select('title_en as name')->wherein('id',$video_id)->get()->toArray();

        }

        //Merging Videos found by video title, club name and player
         $array_merge = array_merge($videosonly, $videosclub, $videosplayer);

         //Converting 2D Array to Single Array
         $singlearray = array_column($array_merge, 'name');

         //Making  Array of Object Unique
         $obj->SearchData=$result = array_unique($singlearray);
    

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Search Result found.', 'data' => $obj]);

    }


}




