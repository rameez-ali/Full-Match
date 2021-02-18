<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProjectCategory;
use App\Model\Videoclub;
use App\Model\Club;
use \stdClass;



class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;


    public function clubs()
    {
        $obj = new stdClass;
        $array = array();

        $clubs = Club::orderBy('club_sorting')->get();
        if (!$clubs->isEmpty()) {

            foreach ($clubs as $k => $v) {

                $banner = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_banner));
                $logo = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_logo));

                $array[$k]['id'] = $v->id;
                $array[$k]['name'] = $v->name_en;
                $array[$k]['name_ar'] = $v->name_ar;
                $array[$k]['banner'] = $banner;
                $array[$k]['logo'] = $logo;
                $array[$k]['description'] = $v->description_en;
                $array[$k]['description_ar'] = $v->description_ar;
                $array[$k]['sorting'] = $v->club_sorting;
                $array[$k]['created_at'] = $v->created_at;
                $array[$k]['deleted_at'] = $v->deleted_at;

            }
            $obj->Heading = "All Clubs";
            $obj->Content = $array;
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Club found.', 'data' => $obj]);

        }else{
            return response()->json(['error' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No record found.', 'data' => []]);
        }

    }


    public function club($id)
    {
        $obj = new stdClass;
        $club_detail = array();
        $club_related_video = array();

        $video_clubs=Videoclub::select('videos.id','videos.title_en','videos.title_ar','videos.video_img','videos.description_en','videos.description_ar','videos.video_banner_img')
            ->join('videos','videoclubs.Video_id' , '=' ,'videos.id')
            ->where('Club_id','=', $id)
            ->orderBy('video_sorting')
            ->get();


        $clubs = Club::orderBy('club_sorting')->where('id',$id)->orderBy('club_sorting')->get();
        if (!$clubs->isEmpty()) {

            foreach ($clubs as $k => $v) {

                $banner = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_banner));
                $logo = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_logo));

                $club_detail[$k]['id'] = $v->id;
                $club_detail[$k]['name'] = $v->name_en;
                $club_detail[$k]['name_ar'] = $v->name_ar;
                $club_detail[$k]['banner'] = $banner;
                $club_detail[$k]['logo'] = $logo;
                $club_detail[$k]['description'] = $v->description_en;
                $club_detail[$k]['description_ar'] = $v->description_ar;

            }
            $obj->Club_Details = $club_detail;
        }



        if (!$video_clubs->isEmpty()) {

            foreach ($video_clubs as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));
                $video_banner_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $club_related_video[$k]['id'] = $v->id;
                $club_related_video[$k]['name'] = $v->title_en;
                $club_related_video[$k]['name_ar'] = $v->title_en;
                $club_related_video[$k]['description'] = $v->description_en;
                $club_related_video[$k]['description_en'] = $v->description_ar;
                $club_related_video[$k]['logo'] = $video_img;
                $club_related_video[$k]['banner'] = $video_banner_img;

            }
            $obj->Club_Related_Videos = $club_related_video;
        }

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Club Detail Data found.', 'data' => $obj]);


    }

}
