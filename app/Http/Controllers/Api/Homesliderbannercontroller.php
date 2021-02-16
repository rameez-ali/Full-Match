<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Category_genre;
use App\Model\Video_genre;
use App\Model\Slider;
use App\Model\Slidervideo;
use App\Model\Video;
use App\Model\Adv_banner;
use App\Model\Adv_banner_video;
use App\Model\Club;
use App\Model\League;
use App\Model\Player;
use App\Model\Leaguecategory;
use App\Model\Videoclub;
use App\Model\Videogenre;
use App\Model\Videoplayer;
use DB;
use \stdClass;


class HomesliderbannerController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsliderbanner()
    {
        $obj = new stdClass;

        $home_slider_array = array();


        $category_id=null;
        $slider_id = Slider::select("id")->where('category_id',$category_id)->get();
        $video_id=Slidervideo::select("Video_id")->wherein('Slider_id',$slider_id)->get();
        $videos=Video::wherein('id',$video_id)->get();

        foreach ($videos as $k => $v) {

            $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

            $home_slider_array[$k]['id'] = $v->id;
            $home_slider_array[$k]['title'] = $v->title_en;
            $home_slider_array[$k]['title_ar'] = $v->title_ar;
            $home_slider_array[$k]['description'] = $v->description_en;
            $home_slider_array[$k]['description_ar'] = $v->description_ar;
            $home_slider_array[$k]['image'] = $video_img;

        }
        $obj->Homeslider=$home_slider_array;

        //getting video id of banner_id of home
        $banner_video_id = Adv_banner::select("id")->where('homepage',1)
                         ->orderBy('desc')
                         ->first();

        $videos=Video::select('id','video_banner_img', 'title_en',
                              'description_en','video_img')
                        ->where('id',$banner_video_id)
                        ->get();

        $obj->Homebanner=$videos;


        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Home Slider Banner found.', 'data'=>  $obj]);


    }

}




