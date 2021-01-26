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
        $club_search_video = array();
        $all_videos_array = array();
        $player_search_video = array();

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

             foreach ($video as $k => $v) {

                 $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                 $all_videos_array[$k]['id'] = $v->id;
                 $all_videos_array[$k]['title'] = $v->video_title;
                 $all_videos_array[$k]['description'] = $v->video_description;
                 $all_videos_array[$k]['image'] = $video_img;

             }
             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Videos found.', 'data'=> $all_videos_array]);


        }
         else if($clubs!=null){

            $video_id = Videoclub::select('Video_id')->wherein('Club_id',$clubs)->get();

             $videos=Video::wherein('id',$video_id)->get();

             foreach ($videos as $k => $v) {

                 $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                 $club_search_video[$k]['id'] = $v->id;
                 $club_search_video[$k]['title'] = $v->video_title;
                 $club_search_video[$k]['description'] = $v->video_description;
                 $club_search_video[$k]['image'] = $video_img;

             }
             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Videos in Club found.', 'data'=> $club_search_video]);


         }
        else if($players!=null){

           $video_id = Videoplayer::select('Video_id')->wherein('Player_id',$players)->get();
           $videos=Video::wherein('id',$video_id)->get();

            foreach ($videos as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $player_search_video[$k]['id'] = $v->id;
                $player_search_video[$k]['title'] = $v->video_title;
                $player_search_video[$k]['description'] = $v->video_description;
                $player_search_video[$k]['image'] = $video_img;

            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Videos in Player found.', 'data'=> $player_search_video]);


         }

        else {
             return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No Video found.']);
            }




}

     public function searchclub($searchword){

        $array=array();

         $clubs  = Club::where('club_name', $searchword)
             ->orWhere('club_name', 'like', '%' . $searchword. '%')
             ->get();

         if (!$clubs->isEmpty()) {

             foreach ($clubs as $k => $v) {

                 $logo = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_logo));

                 $array[$k]['id'] = $v->id;
                 $array[$k]['name'] = $v->club_name;
                 $array[$k]['image'] = $logo;

             }
             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Club found.', 'data' => $array]);

         }else{
             return response()->json(['error' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No record found.', 'data' => []]);
         }

     }

    public function searchplayer($searchword){
        $array=array();

        $players  = Player::where('player_name', $searchword)
            ->orWhere('player_name', 'like', '%' . $searchword. '%')
            ->get();

        if (!$players->isEmpty()) {

            foreach ($players as $k => $v) {

                $profile_image = str_replace('\\', '/', asset('app-assets/images/player/' . $v->player_profile_image));

                $array[$k]['id'] = $v->id;
                $array[$k]['name'] = $v->player_name;
                $array[$k]['profile_image'] = $profile_image;


            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Player found.', 'data' => $array]);

        }

        else {
            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Player Not Found found.', 'data' => []]);
        }

    }
}




