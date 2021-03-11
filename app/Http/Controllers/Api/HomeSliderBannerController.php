<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Model\My_wish_list;
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


class HomeSliderBannerController extends Controller
{
    public $successStatus = 200;
    public $HTTP_FORBIDDEN = 403;
    public $HTTP_NOT_FOUND = 404;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsliderbanner(Request $request)
    {
        $obj = new stdClass;

        $category = array();
        $home_slider_array = array();
        $home_banner_array = array();
        $new_adding_video = array();

        $category=Category::select('id','name_en','name_ar')->orderBy('category_sorting')->get();
        $obj->Categories=$category;

        $category_id=null;
        $slider_id = Slider::select("id")->where('category_id',$category_id)->get();

        if($slider_id!=null){
        $video_id=Slidervideo::select("Video_id")->wherein('Slider_id',$slider_id)->get();
        $videos=Video::wherein('id',$video_id)->get();

        foreach ($videos as $k => $v) {

            $myListUser = My_wish_list::where('video_id', $v->id)->where('user_id', $request->user()->id)->first();

            $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

            $home_slider_array[$k]['id'] = $v->id;
            $home_slider_array[$k]['title'] = $v->title_en;
            $home_slider_array[$k]['title_ar'] = $v->title_ar;
            $home_slider_array[$k]['description'] = $v->description_en;
            $home_slider_array[$k]['description_ar'] = $v->description_ar;
            $home_slider_array[$k]['promo'] = $v->promo_video;
            $home_slider_array[$k]['image'] = $video_img;
            $home_slider_array[$k]['duration'] = $v->duration;
            $home_slider_array[$k]['link'] = $v->video_link;
            $home_slider_array[$k]['route'] = "video/".$v->id;

            if (isset($myListUser)) {
                if ($myListUser->video_id == $v->id) {
                    $home_slider_array[$k]['mylist'] = 1;
                }
            }else {
                $home_slider_array[$k]['mylist'] = 0;
            }
            if (!isset($request->user()->id)) {
                $home_slider_array[$k]['mylist'] = 0;
            }

        }
      }
      $obj->Homeslider=$home_slider_array;

        //getting video id of banner_id of home
        $banner = Adv_banner::where('homepage',1)
            ->orderBy('created_at','desc')
            ->first()
            ->get();

        if($banner!=null){
        foreach ($banner as $k => $v) {

            $video_banner = str_replace('\\', '/', asset('app-assets/images/advbanner/' . $v->video_banner));

            $home_banner_array[$k]['id'] = $v->id;
            $home_banner_array[$k]['name'] = $v->title_en;
            $home_banner_array[$k]['name_ar'] = $v->title_en;
            $home_banner_array[$k]['image'] = $video_banner;
            $home_banner_array[$k]['link'] = $v->video_link;
            $home_banner_array[$k]['route'] = "video/".$v->id;

           }
        }
        $obj->Homebanner=$home_banner_array;


        $new_adding_videos=Video::orderBy('created_at','desc')
            ->get();



        foreach ($new_adding_videos as $k => $v) {

            $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

            $new_adding_video[$k]['id'] = $v->id;
            $new_adding_video[$k]['name'] = $v->title_en;
            $new_adding_video[$k]['name_ar'] = $v->title_en;
            $new_adding_video[$k]['description'] = $v->description_en;
            $new_adding_video[$k]['description_ar'] = $v->description_ar;
            $new_adding_video[$k]['image'] = $video_img;
            $new_adding_video[$k]['duration'] = $v->duration;
            $new_adding_video[$k]['link'] = $v->video_link;
            $new_adding_video[$k]['route'] = "video/".$v->id;


        }

        $obj->NewAdding=$new_adding_video;


        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Home Slider Banner found.', 'data'=>  $obj]);


    }

    public function gethomebannerforguest()
    {
        $obj = new stdClass;

        $category = array();
        $home_slider_array = array();
        $home_banner_array = array();
        $new_adding_video = array();

        $category=Category::select('id','name_en' ,'name_ar')->orderBy('category_sorting')->get();
        $obj->Categories=$category;

        $category_id=null;
        $slider_id = Slider::select("id")->where('category_id',$category_id)->get();

        if($slider_id!=null){
            $video_id=Slidervideo::select("Video_id")->wherein('Slider_id',$slider_id)->get();
            $videos=Video::wherein('id',$video_id)->get();

            foreach ($videos as $k => $v) {

                $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                $home_slider_array[$k]['id'] = $v->id;
                $home_slider_array[$k]['title'] = $v->title_en;
                $home_slider_array[$k]['title_ar'] = $v->title_ar;
                $home_slider_array[$k]['description'] = $v->description_en;
                $home_slider_array[$k]['description_ar'] = $v->description_ar;
                $home_slider_array[$k]['promo'] = $v->promo_video;
                $home_slider_array[$k]['image'] = $video_img;
                $home_slider_array[$k]['duration'] = $v->duration;
                $home_slider_array[$k]['link'] = $v->video_link;
                $home_slider_array[$k]['route'] = "video/".$v->id;

            }
        }
        $obj->Homeslider=$home_slider_array;

        //getting video id of banner_id of home
        $banner = Adv_banner::where('homepage',1)
            ->orderBy('created_at','desc')
            ->first()
            ->get();

        if($banner!=null){
            foreach ($banner as $k => $v) {

                $video_banner = str_replace('\\', '/', asset('app-assets/images/advbanner/' . $v->video_banner));

                $home_banner_array[$k]['id'] = $v->id;
                $home_banner_array[$k]['name'] = $v->title_en;
                $home_banner_array[$k]['name_ar'] = $v->title_en;
                $home_banner_array[$k]['image'] = $video_banner;
                $home_banner_array[$k]['link'] = $v->video_link;
                $home_banner_array[$k]['route'] = "video/".$v->id;

            }
        }
        $obj->Homebanner=$home_banner_array;

        $new_adding_videos=Video::orderBy('created_at','desc')
            ->get();

        foreach ($new_adding_videos as $k => $v) {

            $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

            $new_adding_video[$k]['id'] = $v->id;
            $new_adding_video[$k]['name'] = $v->title_en;
            $new_adding_video[$k]['name_ar'] = $v->title_en;
            $new_adding_video[$k]['description'] = $v->description_en;
            $new_adding_video[$k]['description_en'] = $v->description_ar;
            $new_adding_video[$k]['image'] = $video_img;
            $new_adding_video[$k]['duration'] = $v->duration;
            $new_adding_video[$k]['link'] = $v->video_link;
            $new_adding_video[$k]['route'] = "video/".$v->id;

        }

        $obj->NewAdding=$new_adding_video;

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Home Slider Banner found.', 'data'=>  $obj]);


    }
}




