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


class LeagueSeasonController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function season($leagueid, $seasonid)
    {
        $seasonvideos=Video::where('league_id',$leagueid)
                      ->where('season_id',$seasonid)
                      ->get();

        $season_videos_array=array();
      

        if($seasonvideos!=null)
        {
            foreach ($seasonvideos as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $season_videos_array[$k]['id'] = $v->id;
                $season_videos_array[$k]['name'] = $v->title_en;
                $season_videos_array[$k]['name_ar'] = $v->title_ar;
                $season_videos_array[$k]['description'] = $v->description_en;
                $season_videos_array[$k]['description_ar'] = $v->description_ar;
                $season_videos_array[$k]['image'] = $video_img;
                $season_videos_array[$k]['duration'] = $v->duration;
                $season_videos_array[$k]['link'] = $v->video_link;


            }

        }
       

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Sesaon Data Found', 'data'=> $season_videos_array]);

    }



}
