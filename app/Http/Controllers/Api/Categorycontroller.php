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
use App\Model\Videoclub;
use App\Model\Club;
use DB;
use \stdClass;


class CategoryController extends Controller
{
  public $successStatus = 200;
  public $HTTP_FORBIDDEN = 403;
  public $HTTP_NOT_FOUND = 404;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gethomepageinfo()
    {
        $home_slider_array = array();
        $category_id=null;
        $categories = Category::all();
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

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Home Slider Videos found.', 'data'=>  $home_slider_array]);


    }


    public function getcategoryinfo($id)
    {
        $obj = new stdClass;

        $slider_array = array();
        $banner_array = array();
        $genre_array=array();

        //getting slider id of that specific categories
        $slider_id = Slider::select("id")->where('category_id',$id)->first();

        //getting banner_id of that specific categories
        $banner_id = Adv_banner::select("id")->where('category_id',$id)->get();

        //getting genres id of that specific categories
        $genre_id = Category_genre::select("genre_id")->where('category_id',$id)->get();

        //getting videos id that are associated with that specific categories
        $videos_id = Video::select("id")->where('category_id',$id)->get();





         if($slider_id!=null)
         {
           $video_id=Slidervideo::select("Video_id")->wherein('Slider_id',$slider_id)->get();
           $videos=Video::wherein('id',$video_id)->get();
             foreach ($videos as $k => $v) {

                 $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                 $slider_array[$k]['id'] = $v->id;
                 $slider_array[$k]['title'] = $v->title_en;
                 $slider_array[$k]['title_ar'] = $v->title_ar;
                 $slider_array[$k]['description'] = $v->description_en;
                 $slider_array[$k]['description_ar'] = $v->description_ar;
                 $slider_array[$k]['image'] = $video_img;

             }
               $obj->category_slider = $slider_array;
//             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Slider Related Related Videos found.', 'data' => $slider_array]);

         }



         if($banner_id!=null)
         {
         $video_id=Adv_banner_video::select("video_id")->wherein('banner_id',$banner_id)->get();
         $banner_videos=Video::select("id","title_en")->wherein('id',$video_id)->get();
             foreach ($banner_videos as $k => $v) {

                 $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                 $banner_array[$k]['id'] = $v->id;
                 $banner_array[$k]['title'] = $v->title_en;
                 $banner_array[$k]['title_ar'] = $v->title_ar;
                 $banner_array[$k]['description'] = $v->description_en;
                 $banner_array[$k]['description_ar'] = $v->description_ar;
                 $banner_array[$k]['image'] = $video_img;

             }
             $obj->category_banner = $banner_array;
//             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Banner Related Videos found.', 'data' => $banner_array]);

         }

        if($genre_id!=null)
        {
            $genres=Video_genre::select("name_en","name_ar")->wherein('id',$genre_id)->get();
            $obj->category_genre = $genres;

        }

        if($videos_id!=null)
        {
            $club_id=Videoclub::select("Club_id")->wherein('Video_id',$videos_id)->get();
            $clubs=Club::wherein('id',$club_id)->get();

            foreach ($clubs as $k => $v) {

                $club_banner = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_banner));

                $club_array[$k]['id'] = $v->id;
                $clubs_array[$k]['name'] = $v->name_en;
                $clubs_array[$k]['name_ar'] = $v->name_ar;
                $clubs_array[$k]['description'] = $v->description_en;
                $clubs_array[$k]['description_ar'] = $v->description_ar;
                $clubs_array[$k]['banner'] = $club_banner;

            }
            $obj->category_clubs = $clubs_array;
//             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Slider Related Related Videos found.', 'data' => $slider_array]);

        }


         return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Category Related Data Found.', 'data'=> $obj]);

    }

//    public function getgenre($id)
//    {
//
//          $genre_id = Category_genre::select("genre_id")->where('category_id',$id)->get();
//
//          $genres= Video_genre::select("genre_name")->wherein('id',$genre_id )->get();
//
//           return json_encode($genres);
//    }

}




