<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video;
use App\Model\League;
use App\Model\Club;
use App\Model\player;
use App\Model\Videoclub;
use App\Model\Videoplayer;
use DB;


class SeasonpartSortingController extends Controller
{

  function __construct() {
        $this->middleware('can:view-seasonpartsorting', ['only' => ['index', 'show']]);
    }

   public function index()
    {
       echo  $data['leagues'] = Leagues::get(["league_name","id"]);
        // return view('country-state-city',$data);
    }
    public function getState(Request $request)
    {
       echo  $data['seasons'] = Season::where("Project_id",$request->country_id)
                    ->get(["Seasons","id"]);
        // return response()->json($data);
    }
    public function getCity(Request $request)
    {
      echo   $data['video'] = Video::where("leagues_id",$request->state_id)
                    ->get(["video_title","id"]);
        // return response()->json($data);
    }
}
