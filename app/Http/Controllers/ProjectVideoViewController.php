<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;
use App\Model\Video;
use App\Model\League;
use App\Model\Video_genre;
use App\Model\Videogenre;
use App\Model\Club;
use App\Model\Player;
use App\Model\Videoclub;
use App\Model\Videoplayer;
use App\Model\Season;
use App\Model\Notify_user;
use App\Model\Popular_search;
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
        $video = Video::all();
            return view('admin.video.index', compact('video'));
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
        $leagues=League::all();
        $videogenres=Video_genre::all();
        $countries = DB::table('countries')->pluck("name","id");
        return view('admin.video.form',compact('countries','category','club','player','leagues','videogenres'));
    }

    public function getallseasons($id)
    {
        //$states = DB::table("videos")->pluck("video_title","id");
        $states=Season::pluck('Seasons','id');
        return json_encode($states);
        //return json_encode($states);
    }


    public function getseasons($id)
    {
        $states1=Season::select('Seasons','id')->where("Project_id",$id)->pluck("Seasons","id");
        return json_encode($states1);
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
            'genre'     => 'required'
        ]);


        if($request->file('video_banner_img')==null) {
            $image1 = $request->file('video_img');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('app-assets/images/video'), $new_name1);



            $form_data2 = array(
                'Category_id'    =>   $request->Category_id,
                'leagues_id'     =>   $request->state,
                'video_title'    =>   $request->video_title,
                'video_img'     =>   $new_name1,
                'video_description'     =>   $request->video_description,
                'video_link'     =>   $request->video_link,
                'hour'     =>   $request->hour,
                'minute'     =>   $request->minute,
                'second'     =>   $request->second,
                'notify_user'       => $request->notify_user,
                'video_sorting'       => $request->video_sorting,
                'popular_searches'       => $request->popularsearches,
                'video_promo'       => $request->video_promo

            );

            Video::create($form_data2);

            if($request->club!=null){
            foreach($request->club as $club){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data3 = array(
                    'Club_id'     =>   $club,
                    'Video_id'     =>  $id
                );

                Videoclub::create($form_data3);
            }
            }

            if($request->player!=null){
            foreach($request->player as $player){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data4 = array(
                    'Player_id'     =>   $player,
                    'Video_id'     =>  $id
                );

                Videoplayer::create($form_data4);
            }
           }

            foreach($request->genre as $genre){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data5 = array(
                    'video_id'     =>  $id,
                    'genre_id'     =>   $genre
                );

                Videogenre::create($form_data5);
            }

              return redirect('video-form')->with('videoaddsuccess','Video Added Successfully');


        }

        else if ($request->file('video_banner_img')!=null)
        {
            $image1 = $request->file('video_img');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('app-assets/images/video'), $new_name1);

            $image2 = $request->file('video_banner_img');
            $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('app-assets/images/video'), $new_name2);



            $form_data2 = array(
                'Category_id'    =>   $request->Category_id,
                'leagues_id'     =>   $request->state,
                'video_title'    =>   $request->video_title,
                'video_img'     =>   $new_name1,
                'video_banner_img'     =>   $new_name2,
                'video_description'     =>   $request->video_description,
                'video_link'     =>   $request->video_link,
                'hour'     =>   $request->hour,
                'minute'     =>   $request->minute,
                'second'     =>   $request->second,
                'notify_user'       => $request->notify_user,
                'video_sorting'       => $request->video_sorting,
                'popular_searches'       => $request->popularsearches,
                'video_promo'       => $request->video_promo

            );


            Video::create($form_data2);

            if($request->club!=null){
            foreach($request->club as $club){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data3 = array(
                    'Club_id'     =>   $club,
                    'Video_id'     =>  $id
                );

                Videoclub::create($form_data3);
            }
            }

            if($request->player!=null){
            foreach($request->player as $player){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data4 = array(
                    'Player_id'     =>   $player,
                    'Video_id'     =>  $id
                );

                Videoplayer::create($form_data4);
            }
           }

            foreach($request->genre as $genre){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data5 = array(
                    'video_id'     =>  $id,
                    'genre_id'     =>   $genre
                );

                Videogenre::create($form_data5);
            }

            return redirect('video-form')->with('videoaddsuccess','Video Added Successfully');

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


        $video_genres =  DB::table('video_genres')
        ->where('video_id', '=', $id)
        ->join('videogenres', 'videogenres.genre_id', '=', 'video_genres.id')
        ->select('video_genres.id')
        ->get();

       $selected_ids3 = [];
       foreach ($video_genres as $key => $gly) {
           array_push($selected_ids3, $gly->id);
       }

        $video_genres=Video_genre::select('id','genre_name')->get();




        return view('admin.video.edit',compact('category','clubs','club','players','player','video','selected_ids','selected_ids1','selected_ids3','video_genres'));
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

       $request->validate([
            'genre'     => 'required'
        ]);

        //when both field are empty
        if($request->video_banner_img!=null)
        {
            $image1=$request->file('video_banner_img');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('app-assets/images/video'), $new_name1);

            $form_data2 = array(
                'video_banner_img'     =>   $new_name1
            );

              Video::whereId($id)->update($form_data2);
        }

        if($request->video_img!=null)
        {
            $image2=$request->file('video_img');
            $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('app-assets/images/video'), $new_name2);

             $form_data2 = array(
                'video_img'     =>   $new_name2
            );

              Video::whereId($id)->update($form_data2);
        }



            $form_data3 = array(
                'Category_id'    =>   $request->Category_id,
                'leagues_id'     =>   $request->state,
                'video_title'    =>   $request->video_title,
                'video_description'     =>   $request->video_description,
                'video_link'     =>   $request->video_link,
                'hour'     =>   $request->hour,
                'minute'     =>   $request->minute,
                'second'     =>   $request->second,
                'video_sorting'       => $request->video_sorting,
                'popular_searches'       => $request->popularsearches,
                'video_promo'       => $request->video_promo

            );

            Video::whereId($id)->update($form_data3);

           Videoclub::where('Video_id', $id)->forceDelete();
           Videoplayer::where('Video_id', $id)->forceDelete();
           Videogenre::where('Video_id', $id)->forceDelete();


            if($request->club!=null){
            foreach($request->club as $club){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data3 = array(
                    'Club_id'     =>   $club,
                    'Video_id'     =>  $id
                );

                Videoclub::create($form_data3);
            }
          }

            if($request->player!=null){
            foreach($request->player as $player){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data4 = array(
                    'Player_id'     =>   $player,
                    'Video_id'     =>  $id
                );

                Videoplayer::create($form_data4);
            }
          }

            if($request->genre!=null){
            foreach($request->genre as $genre){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data5 = array(
                    'video_id'     =>  $id,
                    'genre_id'     =>   $genre
                );

                Videogenre::create($form_data5);
            }
          }
          return redirect('video-form')->with('videoeditsuccess','Video Updated Successfully');


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
        return redirect('video-form')->with('videodelsuccess','Video Deleted Successfully');


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





        return view('admin.video.display_club', compact('video_clubs','clubs','video_players','players','videogenres','video_genres'))
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

     $videogenres = DB::table('videogenres');
       $video_genres =  DB::table('video_genres')
        ->where('video_id', '=', $Video_id)
        ->join('videogenres', 'videogenres.genre_id', '=', 'video_genres.id')
        ->select('video_genres.*', 'video_genres.genre_name')
        ->get();

        return view('admin.video.display_player', compact('video_clubs','clubs','video_players','players','video','videogenres','video_genres'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }



}
