<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Leaguecategory;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\League;
use App\Model\Season;
use App\Model\Videoplayer;
use \stdClass;


class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;

    public function leagues()
    {
        $obj = new stdClass;
        $array = array();

        $leagues = League::orderBy('league_sorting')->get();

        if (!$leagues->isEmpty()) {

            foreach ($leagues as $k => $v) {

                $profile_image = str_replace('\\', '/', asset('app-assets/images/league/' . $v->league_profile_image));

                $array[$k]['id'] = $v->id;
                $array[$k]['name'] = $v->name_en;
                $array[$k]['name_ar'] = $v->name_ar;
                $array[$k]['image'] = $profile_image;
                $array[$k]['description'] = $v->description_en;
                $array[$k]['description_ar'] = $v->description_ar;
                $array[$k]['route'] = "league/".$v->id;

            }
            $obj->Heading = "All Leagues";
            $obj->Content = $array;
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'League found.', 'data' => $obj]);

        }

        else {
            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'League not found .', 'data' => []]);
        }

    }


    public function league($id)
    {
        $obj = new stdClass;
        $league_detail = array();
        $league_related_video = array();

        $leagues = League::orderBy('league_sorting')->where('id',$id)->orderBy('league_sorting')->get();

        if (!$leagues->isEmpty()) {

            foreach ($leagues as $k => $v) {

                $banner = str_replace('\\', '/', asset('app-assets/images/league/' . $v->league_banner));

                $league_detail[$k]['id'] = $v->id;
                $league_detail[$k]['name'] = $v->name_en;
                $league_detail[$k]['name_ar'] = $v->name_ar;
                $league_detail[$k]['image'] = $banner;
                $league_detail[$k]['description'] = $v->description_en;
                $league_detail[$k]['description_ar'] = $v->description_ar;

            }
            $obj->detail = $league_detail;

        }

        $seasons=Season::select('id','name_en')->where('league_id',$id)->get()->toArray();

        $obj->seasons = $seasons;

//        $video_leagues=Leaguecategory::select('videos.id','videos.title_en','videos.title_ar','videos.video_img','videos.description_en','videos.description_ar','videos.video_banner_img')
//            ->join('videos','leaguecategories.video_id' , '=' ,'videos.id')
//            ->where('leaguecategories.league_id','=', $id)
//            ->orderBy('video_sorting')
//            ->get();

//        if (!$video_leagues->isEmpty()) {
//
//            foreach ($video_leagues as $k => $v) {
//
//                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));
//
//                $league_related_video[$k]['id'] = $v->id;
//                $league_related_video[$k]['name'] = $v->title_en;
//                $league_related_video[$k]['name_ar'] = $v->title_ar;
//                $league_related_video[$k]['description'] = $v->description_en;
//                $league_related_video[$k]['description_ar'] = $v->description_ar;
//                $league_related_video[$k]['image'] = $video_img;
//
//            }
//            $obj->related_video = $league_related_video;
//        }

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'League Detail Data found.', 'data' => $obj]);





    }

}
