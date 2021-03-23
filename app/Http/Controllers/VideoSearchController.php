<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video;
use App\Model\Videocategory;
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


class VideoSearchController extends Controller
{
    public function search(Request $searchword){


        $video = Video::where('title_en', $searchword->q)
            ->orwhere('title_ar', $searchword->q)
            ->orWhere('title_en', 'like', '%' . $searchword->q. '%')
            ->orWhere('title_ar', 'like', '%' . $searchword->q. '%')
            ->get();


        $clubs  = Club::select('id')->where('name_en', $searchword->q)
            ->orwhere('name_ar', $searchword->q)
            ->orWhere('name_en', 'like', '%' . $searchword->q. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword->q. '%')
            ->get();


        $players = Player::select('id')->where('name_en', $searchword->q)
            ->orwhere('name_ar', $searchword->q)
            ->orWhere('name_en', 'like', '%' . $searchword->q. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword->q. '%')
            ->get();

        $categories = Category::select('id')->where('name_en', $searchword->q)
            ->orwhere('name_ar', $searchword->q)
            ->orWhere('name_en', 'like', '%' . $searchword->q. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword->q. '%')
            ->get();




        if(count($video) > 0){
            return view('admin.video.index', compact('video'));
        }
        else if(count($players) > 0){
            $video_id = Videoplayer::select('Video_id')->wherein('Player_id',$players)->get();
            $video=Video::wherein('id',$video_id)->get();
            return view('admin.video.index', compact('video'));
        }

        else if (count($clubs) > 0){
            $video_id = Videoclub::select('Video_id')->wherein('Club_id',$clubs)->get();
            $video=Video::wherein('id',$video_id)->get();
            return view('admin.video.index', compact('video'));
        }

        else if (count($categories) > 0){
            $video_id = Videocategory::select('video_id')->wherein('category_id',$categories)->get();
            $video=Video::wherein('id',$video_id)->get();
            return view('admin.video.index', compact('video'));
        }

        else {
            return view('admin.video.index', compact('video'));
        }
    }



}
