<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Video;
use App\Model\League;
use App\Model\Season;

class SeasonPartSorting extends Controller
{
    function __construct() {
        $this->middleware('can:view-seasonpartsorting', ['only' => ['index', 'show']]);
    }

    public function index()
        {

          $leagues=league::pluck('name_en','id');
            return view('admin.seasonpart.index',compact('leagues'));
        }

        public function get_seasons(Request $request)
        {

            $seasons=Season::select('name_en','id')->where("league_id",$request->country_id)->pluck("name_en","id");
            return response()->json($seasons);
        }

        public function get_leagues_seasons_videos(Request $request)
        { 

            $videos=Video::select('title_en','id','video_sorting')->where("season_id",$request->state_id)->get();
            return response()->json($videos);
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
