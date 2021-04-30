<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Video;
use App\Model\League;
use App\Model\Season;
use App\Model\Category;
use App\Model\Video_genre;
use App\Model\Club;
use App\Model\Player;
use App\Model\Videogenre;
use App\Model\Videoclub;
use App\Model\Videoplayer;
use App\Exports\VideosExport;

use Maatwebsite\Excel\Facades\Excel;

class VideoFilterController extends Controller
{
    function __construct() {
        $this->middleware('can:view-seasonpartsorting', ['only' => ['index', 'show']]);
    }

        public function index()
        {
           $leagues=league::pluck('name_en','id');
           $video=Video::all();
            return view('admin.videofilter.index',compact('leagues','video'));
        }

        public function get_category(Request $request)
        {
              $category=Category::select('name_en','id')->pluck("name_en","id");
              return response()->json($category);
        }

        public function get_genre(Request $request)
        {
              $genre=Video_genre::select('name_en','id')->pluck("name_en","id");
              return response()->json($genre);
        }


        public function get_club(Request $request)
        {
              $club=Club::select('name_en','id')->pluck("name_en","id");
              return response()->json($club);
        }


        public function get_player(Request $request)
        {
              $player=Player::select('name_en','id')->pluck("name_en","id");
              return response()->json($player);
        }

        public function get_league(Request $request)
        {
              $league=League::select('name_en','id')->pluck("name_en","id");
              return response()->json($league);
        }

        public function get_season(Request $request)
        {
              $season=Season::select('name_en','id')->where("league_id",$request->league_id)->pluck("name_en","id");
              return response()->json($season);
        }

        public function get_category_video(Request $request)
        { 
            
<<<<<<< HEAD
              $videos=Video::select('title_en','id','video_sorting','description_en','video_link','video_promo')->whereIn("category_id",$request->category_ids)->get();
=======
              $videos=Video::select('title_en','id','video_sorting','category_id')->whereIn("category_id",$request->category_ids)->get();
>>>>>>> f12f47d2746fff926c3954fc3dc2543bfc03bfb3
              return response()->json($videos);
        }
        

        public function get_genre_video(Request $request)
        { 
          
          $videogenres=Videogenre::select('video_id')->wherein("genre_id",$request->genre_ids)->get();
<<<<<<< HEAD
          $videos=Video::select('title_en','id','video_sorting','description_en','video_link','video_promo')
                  ->wherein("id",$videogenres)->get();
=======
          $videos=Video::select('title_en','id','video_sorting')->wherein("id",$videogenres)->get();
>>>>>>> f12f47d2746fff926c3954fc3dc2543bfc03bfb3
              return response()->json($videos);
        }

        public function get_club_video(Request $request)
        { 
              $videoclubs=Videoclub::select('video_id')->wherein("club_id",$request->club_ids)->get();
              $videos=Video::select('title_en','id','video_sorting')->wherein("id",$videoclubs)->get();
              return response()->json($videos);
        }

        public function get_player_video(Request $request)
        { 
              $videoplayers=Videoplayer::select('video_id')->wherein("player_id",$request->player_ids)->get();
              $videos=Video::select('title_en','id','video_sorting')->wherein("id",$videoplayers)->get();
              return response()->json($videos);
        }


        public function get_season_video(Request $request)
        { 

            $videos=Video::select('title_en','id','video_sorting')->where("season_id",$request->season1_id)->get();
            return response()->json($videos);
        }

        public function exportexcel(Request $request)
<<<<<<< HEAD
=======
        {
              $video=Video::wherein('category_id',$request->name)->get();
              return Excel::download(new InvoicesExport, 'invoices.xlsx');
        }

        public function exportcsv(Request $request)
        {
              $video=Video::wherein('category_id',$request->name)->get();
              dd($video);
        }


        public function edit($id)
>>>>>>> f12f47d2746fff926c3954fc3dc2543bfc03bfb3
        {
              $video=Video::wherein('category_id',$request->name)->get();
              return Excel::download(new VideosExport($request->name), 'videos.xlsx');


        }

        public function exportcsv(Request $request)
        {
              $video=Video::wherein('category_id',$request->name)->get();
              dd($video);
              return Excel::download(new VideosExport($request->name), 'videos.xlsx');

        }

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
            return view('admin.videofilter.index', compact('video'));
        }
        else if(count($players) > 0){
            $video_id = Videoplayer::select('Video_id')->wherein('Player_id',$players)->get();
            $video=Video::wherein('id',$video_id)->get();
            $leagues=league::pluck('name_en','id');
            return view('admin.videofilter.index', compact('video'));
        }

        else if (count($clubs) > 0){
            $video_id = Videoclub::select('Video_id')->wherein('Club_id',$clubs)->get();
            $video=Video::wherein('id',$video_id)->get();
            $leagues=league::pluck('name_en','id');
            return view('admin.videofilter.index', compact('video'));
        }

        else if (count($categories) > 0){
            $video_id = Videocategory::select('video_id')->wherein('category_id',$categories)->get();
            $video=Video::wherein('id',$video_id)->get();
                       $leagues=league::pluck('name_en','id');

            return view('admin.videofilter.index', compact('video'));
        }

        else {

            return view('admin.videofilter.index', compact('video'));
        }
    }

}