<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;
use App\Model\Category_genre;
use App\Model\Video_genre;
use App\Model\Slidercategory1;
use App\Model\Slidervideo;
use App\Model\Video;
use App\Model\Adv_banner;
use App\Model\Adv_banner_video;
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
        $slider_array = array();
        $category_id=null;
        $categories = ProjectCategory::all();
        $slider_id = Slidercategory1::select("id")->where('category_id',$category_id)->first();
        $video_id=Slidervideo::select("Video_id")->wherein('Slider_id',$slider_id)->get();
        $videos=Video::select("video_title")->wherein('id',$video_id)->get();

        foreach ($videos as $k => $v) {

            $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

            $slider_array[$k]['id'] = $v->id;
            $slider_array[$k]['title'] = $v->video_title;
            $slider_array[$k]['description'] = $v->video_description;
            $slider_array[$k]['image'] = $video_img;

        }

        return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Home Slider Videos found.', 'data'=>  $slider_array]);


    }


    public function getcategoryinfo($id)
    {
        $obj = new stdClass;

        $slider_array = array();
        $banner_array = array();
        $genre_array=array();

        //getting slider id of that specific categories
        $slider_id = Slidercategory1::select("id")->where('Category_id',$id)->first();

        //getting banner_id of that specific categories
        $banner_id = Adv_banner::select("id")->where('category_id',$id)->get();

        //getting genres id of that specific categories
        $genre_id = Category_genre::select("genre_id")->where('category_id',$id)->get();




         if($slider_id!=null)
         {
           $video_id=Slidervideo::select("Video_id")->wherein('Slider_id',$slider_id)->get();
           $videos=Video::wherein('id',$video_id)->get();
             foreach ($videos as $k => $v) {

                 $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                 $slider_array[$k]['id'] = $v->id;
                 $slider_array[$k]['title'] = $v->video_title;
                 $slider_array[$k]['description'] = $v->video_description;
                 $slider_array[$k]['image'] = $video_img;

             }
             $obj->category_slider = $slider_array;
//             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Slider Related Related Videos found.', 'data' => $slider_array]);

         }



         if($banner_id!=null)
         {
         $video_id=Adv_banner_video::select("video_id")->wherein('banner_id',$banner_id)->get();
         $banner_videos=Video::select("id","video_title")->wherein('id',$video_id)->get();
             foreach ($banner_videos as $k => $v) {

                 $video_img = str_replace('\\', '/', asset('app-assets/images/video/' . $v->video_img));

                 $banner_array[$k]['id'] = $v->id;
                 $banner_array[$k]['title'] = $v->video_title;
                 $banner_array[$k]['description'] = $v->video_description;
                 $banner_array[$k]['image'] = $video_img;

             }
             $obj->category_banner = $banner_array;
//             return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Banner Related Videos found.', 'data' => $banner_array]);

         }

        if($genre_id!=null)
        {
            $genres=Video_genre::select("genre_name")->wherein('id',$genre_id)->get();
            $obj->category_genre = $genres;

        }


         return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Category Related Videos found.', 'data'=> $obj]);

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




