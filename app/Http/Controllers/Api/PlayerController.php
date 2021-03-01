<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Player;
use App\Model\Videoplayer;
use \stdClass;


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
        $obj = new stdClass;
        $array = array();

        $players = Player::orderBy('player_sorting')->get();

        if (!$players->isEmpty()) {

            foreach ($players as $k => $v) {

                $profile_image = str_replace('\\', '/', asset('app-assets/images/player/' . $v->player_profile_image));

                $array[$k]['id'] = $v->id;
                $array[$k]['name'] = $v->name_en;
                $array[$k]['name_ar'] = $v->name_ar;
                $array[$k]['image'] = $profile_image;
                $array[$k]['description'] = $v->description_en;
                $array[$k]['description_ar'] = $v->description_ar;
                $array[$k]['sorting'] = $v->player_sorting;

            }
            $obj->Heading = "All Players";
            $obj->Content = $array;
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Player found.', 'data' => $obj]);

        }

        else {
            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'Player Not Found found.', 'data' => []]);
        }

    }


    public function player($id)
    {
        $obj = new stdClass;
        $player_detail = array();
        $player_related_video = array();

        $players = Player::orderBy('player_sorting')->where('id',$id)->orderBy('player_sorting')->get();;

        if (!$players->isEmpty()) {

            foreach ($players as $k => $v) {

                $banner = str_replace('\\', '/', asset('app-assets/images/player/' . $v->player_banner));

                $player_detail[$k]['id'] = $v->id;
                $player_detail[$k]['name'] = $v->name_en;
                $player_detail[$k]['name_ar'] = $v->name_ar;
                $player_detail[$k]['image'] = $banner;
                $player_detail[$k]['description'] = $v->description_en;
                $player_detail[$k]['description_ar'] = $v->description_ar;
                $player_detail[$k]['sorting'] = $v->player_sorting;
            }
            $obj->detail = $player_detail;
        }

        $video_players=Videoplayer::select('videos.id','videos.video_sorting','videos.title_en','videos.title_ar','videos.video_img','videos.description_en','videos.description_ar','videos.video_banner_img','videos.duration','videos.video_link')
            ->join('videos','videoplayers.Video_id' , '=' ,'videos.id')
            ->where('Player_id','=', $id)
            ->orderBy('video_sorting')
            ->get();

        if (!$video_players->isEmpty()) {

            foreach ($video_players as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $player_related_video[$k]['id'] = $v->id;
                $player_related_video[$k]['name'] = $v->title_en;
                $player_related_video[$k]['name_ar'] = $v->title_ar;
                $player_related_video[$k]['description'] = $v->description_en;
                $player_related_video[$k]['description_ar'] = $v->description_ar;
                $player_related_video[$k]['image'] = $video_img;
                $player_related_video[$k]['sorting'] = $v->video_sorting;
                $player_related_video[$k]['duration'] = $v->duration;
                $player_related_video[$k]['link'] = $v->video_link;

            }
            $obj->related_video = $player_related_video;
        }


        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Player Detail Data found.', 'data' => $obj]);

    }

}
