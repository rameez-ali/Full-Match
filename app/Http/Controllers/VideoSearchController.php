<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;
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


class VideoSearchController extends Controller
{
    public function search(Request $searchword){


        $video = Video::where('video_title', $searchword->q)
            ->orWhere('video_title', 'like', '%' . $searchword->q. '%')
            ->get();

        $clubs  = Club::select('id')->where('club_name', $searchword->q)
            ->orWhere('club_name', 'like', '%' . $searchword->q. '%')
            ->first();

        $players = Player::where('player_name', $searchword->q)
            ->orWhere('player_name', 'like', '%' . $searchword->q. '%')
            ->first();

        if(count($video)){

            return view('admin.video.index', compact('video'));

        }
        else if($clubs!=null){

            $video_id = Videoclub::select('Video_id')->wherein('Club_id',$clubs)->get();
            $video=Video::wherein('id',$video_id)->get();


            return view('admin.video.index', compact('video'));
        }
        else if($players!=null){

            $video_id = Videoplayer::wherein('Player_id',$players)->get();
            $video=Video::wherein('id',$video_id)->get();

            return view('admin.video.index', compact('video'));
        }

        else {
            return view('admin.video.search');
        }
    }



}
