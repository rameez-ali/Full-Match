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

class VideoFilterController extends Controller
{
    function __construct() {
        $this->middleware('can:view-seasonpartsorting', ['only' => ['index', 'show']]);
    }

        public function index()
        {
          $leagues=league::pluck('name_en','id');
            return view('admin.videofilter.index',compact('leagues'));
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
            
              $videos=Video::select('title_en','id','video_sorting','category_id')->whereIn("category_id",$request->category_ids)->get();
              return response()->json($videos);
        }
        

        public function get_genre_video(Request $request)
        { 
          
          $videogenres=Videogenre::select('video_id')->wherein("genre_id",$request->genre_ids)->get();
          $videos=Video::select('title_en','id','video_sorting')->wherein("id",$videogenres)->get();
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
        {
          $video=Video::find($id);
          return view('admin.seasonpart.edit',compact('video'));
        }

        public function update(Request $request, $id)
        {

         $form_data = array(
            'video_sorting'         =>  $request->video_sorting
        );

        Video::whereId($id)->update($form_data);

        return redirect('seasonpart-form')->with('success', 'Data is successfully Added');

        }
}
