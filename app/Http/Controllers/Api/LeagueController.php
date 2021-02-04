<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Leaguecategory;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\League;
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

     $leagues = League::all();

     if (!$leagues->isEmpty()) {

            foreach ($leagues as $k => $v) {

                $banner = str_replace('\\', '/', asset('app-assets/images/league/' . $v->league_banner));
                $profile_image = str_replace('\\', '/', asset('app-assets/images/league/' . $v->league_profile_image));

                $array[$k]['id'] = $v->id;
                $array[$k]['name'] = $v->name_en;
                $array[$k]['name_ar'] = $v->name_ar;
                $array[$k]['banner'] = $banner;
                $array[$k]['profile_image'] = $profile_image;
                $array[$k]['description'] = $v->description_en;
                $array[$k]['description_ar'] = $v->description_ar;
                $array[$k]['sorting'] = $v->league_sorting;

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
           $array = array();

            $video_leagues=Leaguecategory::select('videos.id','videos.title_en','videos.title_ar','videos.video_img','videos.description_en','videos.description_ar')
            ->join('videos','leaguecategories.video_id' , '=' ,'videos.id')
            ->where('league_id','=', $id)
            ->get();

         if (!$video_leagues->isEmpty()) {

            foreach ($video_leagues as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $array[$k]['id'] = $v->id;
                $array[$k]['name'] = $v->title_en;
                $array[$k]['name_ar'] = $v->title_ar;
                $array[$k]['description'] = $v->description_en;
                $array[$k]['description_ar'] = $v->description_ar;
                $array[$k]['image'] = $video_img;

            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'League Related Videos found.', 'data' => $array]);

        }

        else {
           return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'league Related Videos Not Found.', 'data' => []]);
        }




    }

}
