<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProjectCategory;
use App\Model\Videoclub;
use App\Model\Club;



class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public $successStatus = 200;
public $HTTP_FORBIDDEN = 403;
public $HTTP_NOT_FOUND = 404;


    public function clubs()
    {
     $array = array();

     $clubs = Club::all();
        if (!$clubs->isEmpty()) {

            foreach ($clubs as $k => $v) {

                $club_banner = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_banner));
                $club_logo = str_replace('\\', '/', asset('app-assets/images/club/' . $v->club_logo));

                $array[$k]['id'] = $v->id;
                $array[$k]['club_name'] = $v->club_name;
                $array[$k]['club_banner'] = $club_banner;
                $array[$k]['club_logo'] = $club_logo;
                $array[$k]['club_description'] = $v->club_description;
                $array[$k]['club_sorting'] = $v->club_sorting;
                $array[$k]['created_at'] = $v->created_at;
                $array[$k]['deleted_at'] = $v->deleted_at;

            }
            return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Club found.', 'data' => $array]);

        }else{
            return response()->json(['error' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No record found.', 'data' => []]);
        }

    }


    public function club($id)
    {



        if (Videoclub::where('Club_id', $id)->exists()) {

            $video_club=Videoclub::select('videos.id','videos.video_title','videos.video_img')
            ->join('videos','videoclubs.Video_id' , '=' ,'videos.id')
            ->where('Club_id','=', $id)
            ->get();



         return response()->json(['success' => true, 'status' => $this->successStatus, 'message' => 'Club found.', 'data' => $video_club]);
          }
        else {
           return response()->json(['error' => false, 'status' => $this->HTTP_NOT_FOUND, 'message' => 'No record found.']);
         }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $club=Club::find($id);
        return view('admin.club.edit',compact('club'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



    }
}
