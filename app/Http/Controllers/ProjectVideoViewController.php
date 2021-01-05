<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;
use App\Model\Video;
use App\Model\Club;
use App\Model\player;
use App\Model\Videoclub;
use App\Model\Videoplayer;
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
        $countries = DB::table('countries')->pluck("name","id"); 
        return view('admin.video.form',compact('countries','category','club','player'));
    }


    public function getStates($id) 
    {
        $states = DB::table("states")->where("countries_id",$id)->pluck("name","id");
        return json_encode($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
      dd($request->player);   
     $request->validate([
           'video_title'     => 'required',
            'video_duration'         => 'required',
            'video_link'     => 'required',
            'player_sorting'         => 'required',
            'video_Category'         => 'required',
            'video_banner_img' =>  'required|image|max:2048',
            'video_img'  =>  'required|image|max:2048'
           
        ]);

        $image = $request->file('video_banner_img');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $image1 = $request->file('video_img');
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);
        
        $image = $request->file('video_banner_img');

         // $notify_user=$request->isset($params['notify_user']) ? 1  : 0; //status 1 for block by admin , 2 for unblock ,or active .
        if(isset($request->notify_user)){
            $set="1";      
        }else{
            $set="0";
        }

        $form_data2 = array(
            'Category_id'    =>   $request->Category_id,
            'video_title'    =>   $request->video_title,
            'video_banner_img'     =>   $new_name,
            'video_img'     =>   $new_name1,
            'video_description'     =>   $request->video_description,
            'video_link'     =>   $request->video_link,
            'video_duration'     =>   $request->video_duration,
            'notify_user'       => $set,
            'video_sorting'       => $request->video_sorting
              
        );   
        // dd($form_data2);     


            Video::create($form_data2);

            foreach($request->club as $club){
            $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
            $form_data3 = array(
            'Club_id'     =>   $club,
            'Video_id'     =>  $id
             );

            Videoclub::create($form_data3);
            }


            foreach($request->player as $player){
            $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
            $form_data4 = array(
            'Player_id'     =>   $player,
            'Video_id'     =>  $id
             );

            Videoplayer::create($form_data4);
            }
           
            return redirect('video-form');


            
     
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
        $video=Video::find($id);
        $category=ProjectCategory::all();
        $club=Club::all();
        $player=Player::all();

     
       ///Getting Selected Clubs id
       $clubs =  DB::table('clubs')
        ->where('Video_id', '=', $id)
        ->join('videoclubs', 'videoclubs.Club_id', '=', 'clubs.id')
        ->select('clubs.id')
        ->get();
       
       $selected_ids = [];
       foreach ($clubs as $key => $clb) {
           array_push($selected_ids, $clb->id);
       }
        $club=club::select('id','club_name')->get();

        
        ///Getting Selected Player id
        $players =  DB::table('players')
        ->where('Video_id', '=', $id)
        ->join('videoplayers', 'videoplayers.Player_id', '=', 'players.id')
        ->select('players.id')
        ->get();
       
       $selected_ids1 = [];
       foreach ($players as $key => $ply) {
           array_push($selected_ids1, $ply->id);
       }
        $player=player::select('id','player_name')->get();



        
        return view('admin.video.edit',compact('category','clubs','club','players','player','video','selected_ids','selected_ids1'));
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
        $image_name1 = $request->hidden_image1;
        $image_name2 = $request->hidden_image2;

       $image1 = $request->file('video_banner_img');
       $image2 = $request->file('video_img');
       

        // echo $request->notify_user;

        if($image1 != '' || $image2 != '')
        {
            
            $image_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('images'), $image_name1);

            $image_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $image_name2);
            
        }
        else
        {
            $request->validate([
                'video_title'    =>  'required',
                'video_description'    =>  'required',
                 'video_link'    =>  'required',
                 'video_duration'    =>  'required',
                 'video_sorting'    =>  'required'
            ]);
        }
                

        $form_data = array(
            'video_title'       =>   $request->video_title,
            'video_description'       =>   $request->video_description,
            'video_link'       =>   $request->video_link,
            'video_duration'       =>   $request->video_duration,
            'video_banner_img'          =>   $image_name1,
            'video_img'   =>   $image_name2,
            'video_sorting'         =>  $request->video_sorting
        );
        
        Video::whereId($id)->update($form_data);

        Videoclub::where('Video_id', $id)->forceDelete();
        Videoplayer::where('Video_id', $id)->forceDelete();


        foreach($request->club as $club){
            $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
            $form_data3 = array(
            'Club_id'     =>   $club,
            'Video_id'     =>  $id
             );

            Videoclub::create($form_data3);
            }


            foreach($request->player as $player){
            $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
            $form_data4 = array(
            'Player_id'     =>   $player,
            'Video_id'     =>  $id
             );

            Videoplayer::create($form_data4);;
            }
           
            return redirect('video-form');

        // return redirect('player-form')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Videoplayer::where('Video_id', $id)->delete();
        Videoclub::where('Video_id', $id)->delete();

        $data = Video::findOrFail($id);
        $data->delete();
        return redirect('video-form')->with('success', 'Data is successfully deleted');


    }

    public function destroy1($id)
    {

      $Video_id=$id;
      $video_clubs = DB::table('videoclubs');
      $clubs =  DB::table('clubs')
        ->where('Video_id', '=', $Video_id)
        ->join('videoclubs', 'videoclubs.Club_id', '=', 'clubs.id')
        ->select('clubs.*', 'clubs.club_name')
        ->get(); 

     $video_players = Videoplayer::latest();;
        $players =  DB::table('players')
        ->where('Video_id', '=', $Video_id)
        ->join('videoplayers', 'videoplayers.Player_id', '=', 'players.id')
        ->select('players.*', 'players.player_name')
        ->get(); 


        return view('admin.video.display_club', compact('video_clubs','clubs','video_players','players'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    public function video_details($id)
    {
      $Video_id=$id;
      $video = Video::latest()
               ->where('id', '=', $Video_id)
               ->get();

      $video_clubs = DB::table('videoclubs');
      $clubs =  DB::table('clubs')
        ->where('Video_id', '=', $Video_id)
        ->join('videoclubs', 'videoclubs.Club_id', '=', 'clubs.id')
        ->select('clubs.*', 'clubs.club_name')
        ->get(); 

     $video_players = Videoplayer::latest();;
        $players =  DB::table('players')
        ->where('Video_id', '=', $Video_id)
        ->join('videoplayers', 'videoplayers.Player_id', '=', 'players.id')
        ->select('players.*', 'players.player_name')
        ->get(); 


        return view('admin.video.display_player', compact('video_clubs','clubs','video_players','players','video'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }



}
