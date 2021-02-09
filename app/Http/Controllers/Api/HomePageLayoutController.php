<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Homepgmanage\GetHomePgManageRequest;
use App\Model\Club;
use App\Model\HomePgItem;
use App\Model\League;
use App\Model\Player;
use App\Model\Video;
use Illuminate\Http\Request;
use stdClass;

class HomePageLayoutController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;

    public function index()
    {
        $request = new GetHomePgManageRequest();

        $request->id = 1;

        $response = $request->handle();
        if ($response->status == 1 ) {

            // START
            $obj = new stdClass;

            $get_league = HomePgItem::select('item_id')->where('section_id', $response->id)->where('item_name', 'league')->get()->toArray();
            $league_details = League::wherein('id', $get_league)->get();

            $selected_league = array();
            foreach ($league_details as $k => $v) {

                $image = str_replace('\\', '/', asset('app-assets/images/league/' . $v->league_profile_image));
                $selected_league[$k]['id'] = $v->id;
                $selected_league[$k]['name'] = $v->name_en;
                $selected_league[$k]['name_ar'] = $v->name_ar;
                $selected_league[$k]['image'] = $image;
                $selected_league[$k]['route'] = "/league/".$v->id;
            }
            $obj->leagues = $selected_league;

            $get_players = HomePgItem::select('item_id')->where('section_id', $response->id)->where('item_name', 'players')->get()->toArray();
            $player_details = Player::wherein('id', $get_players)->get();

            $selected_players = array();
            foreach ($player_details as $k => $v) {

                $image = str_replace('\\', '/', asset('app-assets/images/player/' . $v->player_profile_image));
                $selected_players[$k]['id'] = $v->id;
                $selected_players[$k]['name'] = $v->name_en;
                $selected_players[$k]['name_ar'] = $v->name_ar;
                $selected_players[$k]['image'] = $image;
                $selected_players[$k]['route'] = "/player/".$v->id;
            }
            $obj->players = $selected_players;

            $get_clubs = HomePgItem::select('item_id')->where('section_id', $response->id)->where('item_name', 'clubs')->get()->toArray();
            $club_details = Club::wherein('id', $get_clubs)->get();

            $selected_clubs = array();
            foreach ($club_details as $k => $v) {

                $image = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_logo));
                $selected_clubs[$k]['id'] = $v->id;
                $selected_clubs[$k]['name'] = $v->name_en;
                $selected_clubs[$k]['name_ar'] = $v->name_ar;
                $selected_clubs[$k]['image'] = $image;
                $selected_clubs[$k]['route'] = "/club/".$v->id;
            }
            $obj->clubs = $selected_clubs;

            $get_videos = HomePgItem::select('item_id')->where('section_id', $response->id)->where('item_name', 'videos')->get()->toArray();
            $video_details = Video::wherein('id', $get_videos)->get();

            $selected_videos = array();
            foreach ($video_details as $k => $v) {

                $image = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));
                $selected_videos[$k]['id'] = $v->id;
                $selected_videos[$k]['name'] = $v->title_en;
                $selected_videos[$k]['name_ar'] = $v->title_ar;
                $selected_videos[$k]['image'] = $image;
                $selected_videos[$k]['route'] = "/video/".$v->id;
            }
            $obj->videos = $selected_videos;
            //  END
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Data found And layout is Active.', 'data' => $obj]);
        }else{
            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'layout is In-Active.', 'data' => []]);
        }
    }
}
