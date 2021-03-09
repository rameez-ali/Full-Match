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
        $obj = new stdClass;
        $all_videos_array = array();
        $videos = Video::orderBy('video_sorting')->get();

        if(isset($videos)) {
            foreach ($videos as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $all_videos_array[$k]['id'] = $v->id;
                $all_videos_array[$k]['name'] = $v->title_en;
                $all_videos_array[$k]['name_ar'] = $v->title_ar;
                $all_videos_array[$k]['description'] = $v->description_en;
                $all_videos_array[$k]['description_ar'] = $v->description_ar;
                $all_videos_array[$k]['sorting'] = $v->video_sorting;
                $all_videos_array[$k]['image'] = $video_img;
                $all_videos_array[$k]['duration'] = $v->duration;
                $all_videos_array[$k]['link'] = $v->video_link;
                $all_videos_array[$k]['route'] = "video/".$v->id;


            }
            $obj->Heading = "All Videos";
            $obj->Content = $all_videos_array;
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'All Videos found.', 'data'=> $obj]);

        }
        else{
            return response()->json(['success' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No Videos found.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function video_details(Request $request,$id)
    {
        $obj = new stdClass;

        $season_array = array();
        $category_array = array();
        $latest_videos_array=array();

        //getting video details of that specific video
        $videos = Video::where('id', $id)->orderBy('video_sorting')->get();

        $myListUser = Video::with('mylist')->where('id', $id)->first();

        if ($myListUser->mylist->user_id == $request->user()->id ){
            $mylist = 1 ;
        }else{
            $mylist = 0 ;
        }

        //Getting Category_id of that specific video
        $category_id_collection = Video::select('category_id')->where('id', $id)->get()->first();

        //Converting collection to string
        if(isset($category_id_collection)){
            $category_id=$category_id_collection->category_id;

        }


        if($videos!=null)
        {

            foreach ($videos as $k => $v) {

                $video_banner_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_banner_img));

                $latest_videos_array[$k]['id'] = $v->id;
                $latest_videos_array[$k]['name'] = $v->title_en;
                $latest_videos_array[$k]['name_ar'] = $v->title_ar;
                if ($v->video_link == null) {
                    $season_id = Video::select('season_id')->where('id', $v->id)->first();
                    $league_id = Season::select('league_id')->where('id', $season_id)->first();
                    $video_link = League::select('video_link')->where('id', $league_id)->first();
                    $latest_videos_array[$k]['video_link'] = $video_link;
                } else {
                    $latest_videos_array[$k]['video_link'] = $v->video_link;
                }
                $latest_videos_array[$k]['description'] = $v->description_en;
                $latest_videos_array[$k]['description_ar'] = $v->description_ar;
                $latest_videos_array[$k]['image'] = $video_banner_img;
                $latest_videos_array[$k]['duration'] = $v->duration;
                $latest_videos_array[$k]['mylist'] = $mylist;


            }

        }
        $obj->detail = $latest_videos_array;


        if(isset($category_id)) {

            $videos = Video::orderBy('video_sorting')->where('category_id', $category_id)->orderBy('video_sorting')->get();

            foreach ($videos as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $category_array[$k]['id'] = $v->id;
                $category_array[$k]['name'] = $v->title_en;
                $category_array[$k]['name_ar'] = $v->title_ar;
                $category_array[$k]['description'] = $v->description_en;
                $category_array[$k]['description_ar'] = $v->description_ar;
                $category_array[$k]['image'] = $video_img;
                $category_array[$k]['duration'] = $v->duration;
                $category_array[$k]['link'] = $v->video_link;
                $category_array[$k]['route'] = "video/".$v->id;



            }
            $obj->related_video = $category_array;
        }


        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Videos Data Found', 'data'=> $obj]);

    }



}
