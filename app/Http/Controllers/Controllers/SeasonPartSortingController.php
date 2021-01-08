<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Model\TagList;
use Validator;


class SeasonPartSortingController extends Controller
{


   public function addMore()
    {
        return view("admin.seasonpart.index");
    }


    public function addMorePost(Request $request)
    {
        $rules = [];


        foreach($request->input('name') as $key => $value) 
        {
            $rules["name.{$key}"]='required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {

            $i=0;
            foreach($request->input('name') as $key => $value) {
                TagList::create(['name'=>$value, 'season'=>"season".$i++ ,]);
                            


            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }


}
}