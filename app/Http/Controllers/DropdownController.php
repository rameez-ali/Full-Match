<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Video;

class DropdownController extends Controller
{
    public function index()
        {
            $countries = DB::table("leagues")->pluck("league_name","id");
            return view('admin.seasonpart.index',compact('countries'));
        }

        public function getStateList(Request $request)
        {
            $states = DB::table("seasons")
            ->where("Project_id",$request->country_id)
            ->pluck("Seasons","id");
            return response()->json($states);
        }

        public function getCityList(Request $request)
        {
            $cities = DB::table("videos")
            ->where("leagues_id",'=',$request->state_id)
            ->pluck('video_title','id','video_sorting');

            return response()->json($cities);
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
        }
}
