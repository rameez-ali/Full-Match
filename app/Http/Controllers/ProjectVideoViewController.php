<?php

namespace App\Http\Controllers;

use App\Model\Adv_banner;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video;
use App\Model\League;
use App\Model\Leaguecategory;
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

    function __construct() {
        $this->middleware('can:view-video', ['only' => ['index', 'show']]);
        $this->middleware('can:add-video', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-video', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-video', ['only' => ['destroy']]);
    }

    public function index()
    {
        $category_id = Video::select('category_id')->get()->toArray();
        $league_id = Video::select('league_id')->get()->toArray();

        $video = DB::table('videos')
            ->join('categories', 'categories.id', '=', 'videos.category_id')
            ->leftJoin('leagues', 'leagues.id', '=', 'videos.league_id')
            ->select('videos.*','videos.id','videos.title_en','videos.description_en','videos.video_link',
                'videos.video_sorting','videos.video_banner_img','videos.video_img',
                'videos.title_en','categories.name_en','leagues.name_en as leaguename')
            ->get();


        return view('admin.video.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        $club=Club::all();
        $player=Player::all();
        $leagues=League::all();
        $videogenres=Video_genre::all();
        return view('admin.video.form',compact('category','club','player','leagues','videogenres'));
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
        $states1=Season::select('name_en','id')->where("league_id",$id)->pluck("name_en","id");
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
                'category_id'    =>   $request->Category_id,
                'season_id'     =>   $request->state,
                'title_en'    =>   $request->title_en,
                'title_ar'    =>   $request->title_ar,
                'video_img'     =>   $new_name1,
                'description_en'     =>   $request->description_en,
                'description_ar'     =>   $request->description_ar,
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
                        'Video_id'     =>  $id,
                        'category_id'  =>  $request->Category_id
                    );

                    Videoclub::create($form_data3);

                }
            }


            if($request->player!=null){
                foreach($request->player as $player){
                    $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                    $form_data4 = array(
                        'Player_id'     =>   $player,
                        'Video_id'     =>  $id,
                        'category_id'  =>  $request->Category_id
                    );

                    Videoplayer::create($form_data4);

                }
            }

                foreach ($request->genre as $genre) {
                    $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                    $form_data9 = array(
                        'video_id' => $id,
                        'genre_id' => $genre,
                        'category_id' => $request->Category_id
                    );

                    Videogenre::create($form_data9);
                }


            $league_category = array(
                'video_id'     =>  $id,
                'league_id'     =>  $request->country,
                'category_id'  =>  $request->Category_id
            );

            Leaguecategory::create($league_category);

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
                'category_id'    =>   $request->Category_id,
                'season_id'     =>   $request->state,
                'title_en'    =>   $request->title_en,
                'title_ar'    =>   $request->title_ar,
                'video_img'     =>   $new_name1,
                'video_banner_img'     =>   $new_name2,
                'description_en'     =>   $request->description_en,
                'description_ar'     =>   $request->description_ar,
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
                        'Video_id'     =>  $id,
                        'category_id'  =>  $request->Category_id
                    );

                    Videoclub::create($form_data3);

                }
            }


            if($request->player!=null){
                foreach($request->player as $player){
                    $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                    $form_data4 = array(
                        'Player_id'     =>   $player,
                        'Video_id'     =>  $id,
                        'category_id'  =>  $request->Category_id
                    );

                    Videoplayer::create($form_data4);

                }
            }


                foreach ($request->genre as $genre) {
                    $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                           $form_data9 = array(
                               'video_id' => $id,
                               'genre_id' => $genre,
                               'category_id' => $request->Category_id
                           );

                    Videogenre::create($form_data9);

            }

            $league_category = array(
                'video_id'     =>  $id,
                'league_id'     =>  $request->country,
                'category_id'  =>  $request->Category_id
            );

            Leaguecategory::create($league_category);

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
        $club=club::select('id','name_en')->get();


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
        $player=player::select('id','name_en')->get();


        $video_genres =  DB::table('video_genres')
            ->where('video_id', '=', $id)
            ->join('videogenres', 'videogenres.genre_id', '=', 'video_genres.id')
            ->select('video_genres.id')
            ->get();

        $selected_ids3 = [];
        foreach ($video_genres as $key => $gly) {
            array_push($selected_ids3, $gly->id);
        }

        $video_genres=Video_genre::select('id','name_en')->get();

        $selected_popular_search=Video::select('popular_searches')->where('id',$id)->first();
        $popular_searches=Popular_search::select('id','status')->get();
        $select_category_id = Video::select('category_id')->where('id', '=', $id )->first();
        $category=Category::select('id','name_en')->get();



        return view('admin.video.edit',compact('category','select_category_id','clubs','club','players','player','video','selected_ids','selected_ids1','selected_ids3','video_genres','selected_popular_search','popular_searches'));
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
            'category_id'    =>   $request->Category_id,
            'season_id'     =>   $request->state,
            'title_en'    =>   $request->title_en,
            'title_ar'    =>   $request->title_ar,
            'description_en'     =>   $request->description_en,
            'description_ar'     =>   $request->description_ar,
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
        Leaguecategory::where('video_id', $id)->forceDelete();


        if($request->club!=null){
            foreach($request->club as $club){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data7 = array(
                    'Club_id'     =>   $club,
                    'Video_id'     =>  $id,
                    'category_id'  =>  $request->Category_id
                );

                Videoclub::create($form_data7);

            }
        }


        if($request->player!=null){
            foreach($request->player as $player){
                $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                $form_data8 = array(
                    'Player_id'     =>   $player,
                    'Video_id'     =>  $id,
                    'category_id'  =>  $request->Category_id
                );

                Videoplayer::create($form_data8);

            }
        }

            if($request->genre!=null){
                foreach ($request->genre as $genre) {
                    $id = DB::table('videos')->orderBy('id', 'DESC')->value('id');
                    $form_data9 = array(
                        'video_id' => $id,
                        'genre_id' => $genre,
                        'category_id' => $request->Category_id,
                        'player_id'    => $player
                    );
                    Videogenre::create($form_data9);
                }

        }

        $league_category = array(
            'video_id'     =>  $id,
            'league_id'     =>  $request->country,
            'category_id'  =>  $request->Category_id
        );

        Leaguecategory::create($league_category);

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
        Videogenre::where('video_id', $id)->delete();
        Leaguecategory::where('video_id', $id)->delete();

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

        $category_id = Video::select('category_id')->where('id','=',$id)->get()->first();

        $league_id = Video::select('league_id')->where('id','=',$id)->get()->first();



        if($league_id->league_id!=null){

        $video = DB::table('videos')
            ->join('categories', 'categories.id', '=', 'videos.category_id')
            ->join('leagues', 'leagues.id', '=', 'videos.league_id')
            ->select('videos.*','videos.id','videos.title_en','videos.description_en','videos.video_link',
                'videos.video_sorting','videos.video_banner_img','videos.video_img',
                'videos.title_en','categories.name_en','leagues.name_en as leaguename')
            ->where('videos.id',$id)
            ->get();
        }
        else{
            $video = DB::table('videos')
             ->join('categories', 'categories.id', '=', 'videos.category_id')
            ->select('videos.*','videos.id','videos.title_en','videos.description_en','videos.video_link',
                'videos.video_sorting','videos.video_banner_img','videos.video_img',
                'videos.title_en','categories.name_en')
            ->where('videos.id',$id)
            ->get();
        }



        $video_clubs = DB::table('videoclubs');
        $clubs =  DB::table('clubs')
            ->where('Video_id', '=', $Video_id)
            ->join('videoclubs', 'videoclubs.Club_id', '=', 'clubs.id')
            ->select('clubs.*', 'clubs.name_en')
            ->get();

        $video_players = Videoplayer::latest();;
        $players =  DB::table('players')
            ->where('Video_id', '=', $Video_id)
            ->join('videoplayers', 'videoplayers.Player_id', '=', 'players.id')
            ->select('players.*', 'players.name_en')
            ->get();

        $videogenres = DB::table('videogenres');
        $video_genres =  DB::table('video_genres')
            ->where('video_id', '=', $Video_id)
            ->join('videogenres', 'videogenres.genre_id', '=', 'video_genres.id')
            ->select('video_genres.*', 'video_genres.name_en')
            ->get();

        return view('admin.video.display_player', compact('video_clubs','clubs','video_players','players','video','videogenres','video_genres'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function search(Request $searchword){


        $video = Video::where('video_title', $searchword->q)
            ->orWhere('video_title', 'like', '%' . $searchword->q. '%')
            ->get();

        $clubs  = Club::select('id')->where('club_name', $searchword->q)
            ->orWhere('club_name', 'like', '%' . $searchword->q. '%')
            ->first();

        $players = Player::where('player_name', $searchword->q)
            ->orWhere('player_name', 'like', '%' . $searchword->q. '%')
            ->first();

        if(count($video)){

            return view('admin.video.index', compact('video'));

        }
        else if($clubs!=null){

            $video = Videoclub::wherein('Club_id',$clubs)->get();

            return view('admin.video.index', compact('video'));
        }
        else if($players!=null){

            $video = Videoplayer::wherein('Player_id',$players)->get();

            return view('admin.video.index', compact('video'));
        }

        else {
            $video = Video::all();
            return view('admin.video.index', compact('video'));
        }
    }



}
