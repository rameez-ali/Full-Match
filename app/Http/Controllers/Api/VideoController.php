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


class VideoController extends Controller
{
  public $successStatus = 200;
  public $HTTP_FORBIDDEN = 403;
  public $HTTP_NOT_FOUND = 404;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function videos()
    {
        $all_videos_array = array();
        $videos = Video::all();
        foreach ($videos as $k => $v) {

            $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

            $all_videos_array[$k]['id'] = $v->id;
            $all_videos_array[$k]['title'] = $v->video_title;
            $all_videos_array[$k]['description'] = $v->video_description;
            $all_videos_array[$k]['image'] = $video_img;

        }
        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'All Videos found.', 'data'=> $all_videos_array]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function video_details($id)
    {
        $season_array = array();
        $category_array = array();
        $specific_video_array=array();



       //Getting league_id of that specific video
        $leagues_id_collection = Video::select('leagues_id')->where('id', $id)->get()->first();

        $category_id_collection = Video::select('Category_id')->where('id', $id)->get()->first();

        //Converting collection to string
        $league_id=$leagues_id_collection->leagues_id;

        //Converting collection to string
        $category_id=$category_id_collection->Category_id;


        //if league is assocaited
       if(isset($league_id))
       {
           $videos = Video::where('leagues_id', $league_id)->get();
           foreach ($videos as $k => $v) {

               $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

               $season_array[$k]['id'] = $v->id;
               $season_array[$k]['title'] = $v->video_title;
               $season_array[$k]['description'] = $v->video_description;
               $season_array[$k]['image'] = $video_img;

           }
          return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Season Realted Videos found.', 'data'=> $season_array]);

       }
       //in case league is not assocaited
       elseif(isset($category_id)) {

           $videos = Video::where('Category_id', $category_id)->get();

           foreach ($videos as $k => $v) {

               $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

               $category_array[$k]['id'] = $v->id;
               $category_array[$k]['title'] = $v->video_title;
               $category_array[$k]['description'] = $v->video_description;
               $category_array[$k]['image'] = $video_img;

           }
           return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Category Realted Videos found.', 'data'=> $category_array]);

       }
       else{
           return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No Videos found.']);

       }




     }



}
