<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;
use App\Model\Video;
use App\Model\Club;
use App\Model\player;
use App\Model\Video_club;
use App\Model\Video_player;
use DB;


class ProjectVideoViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video::latest()->paginate(5);
            return view('admin.video.index', compact('video'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=ProjectCategory::all();
        $club=Club::all();
        $player=Player::all();
        return view('admin.video.form',compact('category','club','player'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
     $request->validate([
            'video_banner_img' =>  'required|image|max:2048',
            'video_img'  =>  'required|image|max:2048'
           
        ]);

        $image = $request->file('video_banner_img');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $image1 = $request->file('video_img');
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);


        $form_data2 = array(
            'Category_id'    =>   $request->Category_id,
            'video_title'    =>   $request->video_title,
            'video_banner_img'     =>   $new_name,
            'video_img'     =>   $new_name1,
            'video_description'     =>   $request->video_description,
            'video_link'     =>   $request->video_link,
            'video_duration'     =>   $request->video_duration,
            'notify_user'     =>   $request->notify_user
        );        


            Video::create($form_data2);

            foreach($request->club as $club){
            $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
            $form_data3 = array(
            'Club_id'     =>   $club,
            'Video_id'     =>  $id
             );

            Video_club::create($form_data3);
            }


            foreach($request->player as $player){
            $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
            $form_data4 = array(
            'Player_id'     =>   $player,
            'Video_id'     =>  $id
             );

            Video_player::create($form_data4);
            }


            
     
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video_player::where('Video_id', $id)->delete();
        Video_club::where('Video_id', $id)->delete();
        $data = Video::findOrFail($id);
        $data->delete();
        return redirect('video-form')->with('success', 'Data is successfully deleted');


    }

    public function destroy1($id)
    {

        $Video_id=$id;
       


      $video_clubs = DB::table('video_clubs');
      $clubs =  DB::table('clubs')
        ->where('Video_id', '=', $Video_id)
        ->join('video_clubs', 'video_clubs.Club_id', '=', 'clubs.id')
        ->select('clubs.*', 'clubs.club_name')
        ->get(); 

            return view('admin.video.display_club', compact('video_clubs','clubs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    public function destroy2($id)
    {

        $Video_id=$id;
        $data3 = Video_player::latest()->paginate(5);
        return view('admin.video.display_player', compact('Video_id','data3','data4'));

    }

}
