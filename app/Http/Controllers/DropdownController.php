<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Video;
use App\Model\League;
use App\Model\Season;

class DropdownController extends Controller
{
    public function index()
        {

          $countries=league::pluck('name_en','id');
            return view('admin.seasonpart.index',compact('countries'));
        }

        public function getStateList(Request $request)
        {

            $states=Season::select('name_en','id')->where("league_id",$request->country_id)->pluck("name_en","id");
            return response()->json($states);
        }

        public function getCityList(Request $request)
        {


            // $cities=Video::select('video_title','id','video_sorting')->where("leagues_id",$request->state_id)->pluck("video_title","id","video_sorting");

             $cities=Video::select('title_en','id','video_sorting')->where("leagues_id",$request->state_id)->get();
            return response()->json($cities);


            // return response()->json($cities);
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
