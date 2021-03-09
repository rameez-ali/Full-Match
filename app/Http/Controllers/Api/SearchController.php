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
        $obj = new stdClass;

        $club_search_video = array();
        $all_videos_array = array();
        $player_search_video = array();
        $popular_search_video = array();

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

             foreach ($video as $k => $v) {

                 $banner = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_banner_img));

                 $all_videos_array[$k]['id'] = $v->id;
                 $all_videos_array[$k]['name'] = $v->title_en;
                 $all_videos_array[$k]['name_ar'] = $v->title_ar;
                 $all_videos_array[$k]['description'] = $v->description_en;
                 $all_videos_array[$k]['description_ar'] = $v->description_ar;
                 $all_videos_array[$k]['logo'] = $banner;
                 $all_videos_array[$k]['route'] = "video/".$v->id;

             }

        }
        $obj->Byvideotitle= $all_videos_array;

         if($clubs!=null){

            $video_id = Videoclub::select('Video_id')->wherein('Club_id',$clubs)->get();

             $videos=Video::wherein('id',$video_id)->get();

             foreach ($videos as $k => $v) {

                 $banner = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_banner_img));
                 $image = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                 $club_search_video[$k]['id'] = $v->id;
                 $club_search_video[$k]['name'] = $v->title_en;
                 $club_search_video[$k]['name_ar'] = $v->title_ar;
                 $club_search_video[$k]['description'] = $v->description_en;
                 $club_search_video[$k]['description_ar'] = $v->description_ar;
                 $club_search_video[$k]['logo'] = $banner;
                 $club_search_video[$k]['image'] = $image;
                 $club_search_video[$k]['route'] = "video/".$v->id;

             }
         }
         $obj->Byclubname = $club_search_video;

         if($players!=null){

           $video_id = Videoplayer::select('Video_id')->wherein('Player_id',$players)->get();
           $videos=Video::wherein('id',$video_id)->get();

            foreach ($videos as $k => $v) {

                $banner = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_banner_img));
                $image = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $player_search_video[$k]['id'] = $v->id;
                $player_search_video[$k]['name'] = $v->title_en;
                $player_search_video[$k]['name_ar'] = $v->title_ar;
                $player_search_video[$k]['description'] = $v->description_en;
                $player_search_video[$k]['description_ar'] = $v->description_ar;
                $player_search_video[$k]['logo'] = $banner;
                $player_search_video[$k]['image'] = $image;
                $player_search_video[$k]['route'] = "video/".$v->id;


            }
         }
         $obj->Byplayername = $player_search_video;


        if( $popular_search_videos!=null){

            foreach ($popular_search_videos as $k => $v) {

                $banner = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_banner_img));
                $image = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $popular_search_video[$k]['id'] = $v->id;
                $popular_search_video[$k]['name'] = $v->title_en;
                $popular_search_video[$k]['name_ar'] = $v->title_ar;
                $popular_search_video[$k]['description'] = $v->description_en;
                $popular_search_video[$k]['description'] = $v->description_ar;
                $popular_search_video[$k]['logo'] = $banner;
                $popular_search_video[$k]['image'] = $image;
                $popular_search_video[$k]['route'] = "video/".$v->id;

            }
            $obj->PopularSearches = $popular_search_video;

        }

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Search Result found.', 'data' => $obj]);

    }

     public function searchclub($searchword){

        $array=array();

         $clubs  = Club::where('name_en', $searchword)
             ->orwhere('name_ar', $searchword)
             ->orWhere('name_en', 'like', '%' . $searchword. '%')
             ->orWhere('name_ar', 'like', '%' . $searchword. '%')
             ->get();

         if (!$clubs->isEmpty()) {

             foreach ($clubs as $k => $v) {

                 $logo = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_logo));

                 $array[$k]['id'] = $v->id;
                 $array[$k]['name'] = $v->name_en;
                 $array[$k]['name_ar'] = $v->name_ar;
                 $array[$k]['image'] = $logo;

             }
             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Club found.', 'data' => $array]);

         }else{
             return response()->json(['error' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No record found.', 'data' => []]);
         }

     }

    public function searchplayer($searchword){
        $array=array();

        $players  = Player::where('name_en', $searchword)
            ->orwhere('name_ar', $searchword)
            ->orWhere('name_en', 'like', '%' . $searchword. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword. '%')
            ->get();

        if (!$players->isEmpty()) {

            foreach ($players as $k => $v) {

                $profile_image = str_replace('\\', '/', asset('app-assets/images/player/' . $v->player_profile_image));

                $array[$k]['id'] = $v->id;
                $array[$k]['name'] = $v->name_en;
                $array[$k]['name_ar'] = $v->name_ar;
                $array[$k]['profile_image'] = $profile_image;


            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Player found.', 'data' => $array]);

        }

        else {
            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Player Not Found found.', 'data' => []]);
        }

    }
}




