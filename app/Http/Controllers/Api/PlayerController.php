<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Player;
use App\Model\Videoplayer;


class PlayerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $successStatus = 200;
     public $HTTP_FORBIDDEN = 403;
     public $HTTP_NOT_FOUND = 404;

    public function players()
    {

     $array = array();

     $players = Player::all();

     if (!$players->isEmpty()) {

            foreach ($players as $k => $v) {

                $banner = str_replace('\\', '/', asset('app-assets/images/player/' . $v->player_banner));
                $profile_image = str_replace('\\', '/', asset('app-assets/images/player/' . $v->player_profile_image));

                $array[$k]['id'] = $v->id;
                $array[$k]['name'] = $v->name_en;
                $array[$k]['name_ar'] = $v->name_ar;
                $array[$k]['banner'] = $banner;
                $array[$k]['profile_image'] = $profile_image;
                $array[$k]['description_en'] = $v->description_en;
                $array[$k]['description_ar'] = $v->description_ar;
                $array[$k]['sorting'] = $v->player_sorting;

            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Player found.', 'data' => $array]);

        }

     else {
           return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Player Not Found found.', 'data' => []]);
        }

    }


    public function player($id)
    {
           $array = array();

            $video_players=Videoplayer::select('videos.id','videos.title_en','videos.title_ar','videos.video_img','videos.description_en','videos.description_ar')
            ->join('videos','videoplayers.Video_id' , '=' ,'videos.id')
            ->where('Player_id','=', $id)
            ->get();

         if (!$video_players->isEmpty()) {

            foreach ($video_players as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $array[$k]['id'] = $v->id;
                $array[$k]['title'] = $v->title_en;
                $array[$k]['title_ar'] = $v->title_ar;
                $array[$k]['description'] = $v->description_en;
                $array[$k]['description_ar'] = $v->description_ar;
                $array[$k]['image'] = $video_img;

            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Player Related Videos found.', 'data' => $array]);

        }

        else {
           return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Player Related Videos Not Found.', 'data' => []]);
        }




    }

}
