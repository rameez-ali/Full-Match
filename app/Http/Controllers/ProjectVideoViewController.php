<?php

namespace App\Http\Controllers;

use App\Model\DeviceToken;
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
        //Getting Categories id associated with the videos
        $category_id = Video::select('category_id')->get()->toArray();

        //Getting Leagues id associated with the videos
        $league_id = Video::select('league_id')->get()->toArray();

        //Getting Leagues and Categories id associated with the videos
        $video = Video::
        join('categories', 'categories.id', '=', 'videos.category_id')
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
        $all_seasons=Season::pluck('Seasons','id');
        return json_encode($all_seasons);
    }


    public function getseasons($id)
    {
        $season=Season::select('name_en','id')->where("league_id",$id)->pluck("name_en","id");
        return json_encode($season);
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
                'league_id'     =>   $request->league_id,
                'season_id'     =>   $request->season_id,
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
                    $id = Video::orderBy('id', 'DESC')->value('id');
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
                    $id = Video::orderBy('id', 'DESC')->value('id');
                    $form_data4 = array(
                        'Player_id'     =>   $player,
                        'Video_id'     =>  $id,
                        'category_id'  =>  $request->Category_id
                    );

                    Videoplayer::create($form_data4);

                }
            }

            foreach ($request->genre as $genre) {
                $id = Video::orderBy('id', 'DESC')->value('id');
                $form_data9 = array(
                    'video_id' => $id,
                    'genre_id' => $genre,
                    'category_id' => $request->Category_id
                );

                Videogenre::create($form_data9);
            }


            $league_category = array(
                'video_id'     =>  $id,
                'league_id'     =>  $request->league_id,
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
                'league_id'     =>   $request->league_id,
                'season_id'     =>   $request->season_id,
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
                    $id = Video::orderBy('id', 'DESC')->value('id');
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
                    $id = Video::orderBy('id', 'DESC')->value('id');
                    $form_data4 = array(
                        'Player_id'     =>   $player,
                        'Video_id'     =>  $id,
                        'category_id'  =>  $request->Category_id
                    );

                    Videoplayer::create($form_data4);

                }
            }


            foreach ($request->genre as $genre) {
                $id = Video::orderBy('id', 'DESC')->value('id');
                $form_data9 = array(
                    'video_id' => $id,
                    'genre_id' => $genre,
                    'category_id' => $request->Category_id
                );

                Videogenre::create($form_data9);

            }

            $league_category = array(
                'video_id'     =>  $id,
                'league_id'     =>  $request->league_id,
                'category_id'  =>  $request->Category_id
            );

            Leaguecategory::create($league_category);
            //for Send new video notification to all users
            if ($request->notify_user == 1){
                $tokenList = DeviceToken::pluck('token')->toArray();

                //         dd($tokenList);
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                // $tokenList[] = 'eCcZ-L2K49w:APA91bHyArn9JrTqLWl1vmd_3IgE-XIDEwKAFL5B5g3RVBrSfacFfvQrXuywNXZuE2WlplXBxkFxmHoZb5oSc1hZayy8XGght7j6AyC4cS7661ck9UHseayLNPcxopCX2nWdKSXKwB8D';
                // $tokenList[] = 'f0xnoyCn90orlDK8SLGX8N:APA91bHl1l8tO_GClxgjtjsXHbO_5viCxCKJ3dmLcYbzcCcE82wxymm3IVJV9dc2OpIRkfTWBM3frUQ5Q2ZdPi6LVtSnbPSp0I7Rk4DmSaagRfmkhnQ_uwHBH3i8S8atdtk4TsTOSb5H';
                $notification = [
                    'title' => $request->title_en,
                    'text'  => $request->description_en,
                    'type'  => 1,
                    'sound' => true,
                ];

                $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

                $fcmNotification = [
                    'registration_ids' => $tokenList, //multple token array
                    // 'to' => $token, //single token
                    'notification' => $notification,
                    'data' => $extraNotificationData
                ];

                $headers = [
                    'Authorization: key='.'AAAAmTF75NM:APA91bG_ohKx-gMv_t6COCCjY2BOXDbN6jHrEG9SJBlcTLVWuBuBNfIoZJznuAT2FIbOji6HVduclLhHre8oilhZQp1LwMKqQZYzL_tmNJXJ7Ph6NwhlonUnrCWZprAFkj8YUUxw_Lfx',
                    'Content-Type: application/json'
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                $result = curl_exec($ch);
                curl_close($ch);
                // print_r($result);

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
        ///Getting Selected Clubs id
        $video=Video::find($id);

        ///Getting All Clubs
        $club=Club::select('id','name_en')->get();

        ///Getting All Players
        $player=Player::select('id','name_en')->get();

        ///Getting All Genres
        $video_genres=Video_genre::select('id','name_en')->get();

        //Getting All Popular Search Status
        $popular_searches=Popular_search::select('id','status')->get();

        //Getting All Categories
        $category=Category::select('id','name_en')->get();

        ///Getting Clubs id assoicated with this video
        $clubs =  Club::
        where('Video_id', '=', $id)
            ->join('videoclubs', 'videoclubs.Club_id', '=', 'clubs.id')
            ->select('clubs.id')
            ->get();

        $selected_ids = [];
        foreach ($clubs as $key => $clb) {
            array_push($selected_ids, $clb->id);
        }


        //Getting Players id assoicated with this video
        $players =  Player::
        where('Video_id', '=', $id)
            ->join('videoplayers', 'videoplayers.Player_id', '=', 'players.id')
            ->select('players.id')
            ->get();

        $selected_ids1 = [];
        foreach ($players as $key => $ply) {
            array_push($selected_ids1, $ply->id);
        }


        //Getting Genres id assoicated with this video
        $video_genres = Video_genre::
        where('video_id', '=', $id)
            ->join('videogenres', 'videogenres.genre_id', '=', 'video_genres.id')
            ->select('video_genres.id')
            ->get();

        $selected_ids3 = [];
        foreach ($video_genres as $key => $gly) {
            array_push($selected_ids3, $gly->id);
        }


        //Getting Popular Search Status assoicated with this video
        $selected_popular_search=Video::select('popular_searches')->where('id',$id)->first();


        //Getting Category id assoicated with this video
        $select_category_id = Video::select('category_id')->where('id', '=', $id )->first();



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


        if($request->club!=null){
            Videoclub::where('Video_id', $id)->forceDelete();
            foreach($request->club as $club){
                $id = Video::orderBy('id', 'DESC')->value('id');
                $form_data7 = array(
                    'Club_id'     =>   $club,
                    'Video_id'     =>  $id,
                    'category_id'  =>  $request->Category_id
                );

                Videoclub::create($form_data7);

            }
        }


        if($request->player!=null){
            Videoplayer::where('Video_id', $id)->forceDelete();
            foreach($request->player as $player){
                $id = Video::orderBy('id', 'DESC')->value('id');
                $form_data8 = array(
                    'Player_id'     =>   $player,
                    'Video_id'     =>  $id,
                    'category_id'  =>  $request->Category_id
                );

                Videoplayer::create($form_data8);

            }
        }

        if($request->genre!=null){
            Videogenre::where('Video_id', $id)->forceDelete();
            foreach ($request->genre as $genre) {
                $id = Video::orderBy('id', 'DESC')->value('id');
                $form_data9 = array(
                    'video_id' => $id,
                    'genre_id' => $genre,
                    'category_id' => $request->Category_id,
                    'player_id'    => $player
                );
                Videogenre::create($form_data9);
            }

        }

        if($request->country!=null){
            Leaguecategory::where('video_id', $id)->forceDelete();
            $league_category = array(
                'video_id'     =>  $id,
                'league_id'     =>  $request->league_id,
                'category_id'  =>  $request->Category_id
            );
            Leaguecategory::create($league_category);
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
        //Delete Relation of Video with Player
        Videoplayer::where('Video_id', $id)->delete();

        //Delete Relation of Video with Club
        Videoclub::where('Video_id', $id)->delete();

        //Delete Relation of Video with Genre
        Videogenre::where('video_id', $id)->delete();

        //Delete Relation of Video with League
        Leaguecategory::where('video_id', $id)->delete();

        //Delete Video
        $data = Video::findOrFail($id);
        $data->delete();
        return redirect('video-form')->with('videodelsuccess','Video Deleted Successfully');
    }


    public function video_details($id)
    {
        $Video_id=$id;

        //Getting Category id associated with the video
        $category_id = Video::select('category_id')->where('id','=',$id)->get()->first();

        //Getting League id associated with the video
        $league_id = Video::select('league_id')->where('id','=',$id)->get()->first();


        //Getting Leagues and Categories id associated with the videos
        if($league_id->league_id!=null){
            //when video is assoicated with league
            $video = Video::
            join('categories', 'categories.id', '=', 'videos.category_id')
                ->join('leagues', 'leagues.id', '=', 'videos.league_id')
                ->select('videos.*','videos.id','videos.title_en','videos.description_en','videos.video_link',
                    'videos.video_sorting','videos.video_banner_img','videos.video_img',
                    'videos.title_en','categories.name_en','leagues.name_en as leaguename')
                ->where('videos.id',$id)
                ->get();
        }
        else{
            //when video is not assoicated with league
            $video = Video::
            join('categories', 'categories.id', '=', 'videos.category_id')
                ->select('videos.*','videos.id','videos.title_en','videos.description_en','videos.video_link',
                    'videos.video_sorting','videos.video_banner_img','videos.video_img',
                    'videos.title_en','categories.name_en')
                ->where('videos.id',$id)
                ->get();
        }


        //Getting Clubs assoicated with this video
        $clubs =  Club::
        where('Video_id', '=', $Video_id)
            ->join('videoclubs', 'videoclubs.Club_id', '=', 'clubs.id')
            ->select('clubs.*', 'clubs.name_en')
            ->get();

        //Getting Players assoicated with this video
        $players =  Player::
        where('Video_id', '=', $Video_id)
            ->join('videoplayers', 'videoplayers.Player_id', '=', 'players.id')
            ->select('players.*', 'players.name_en')
            ->get();

        //Getting Genres assoicated with this video
        $video_genres =  Video_genre::
        where('video_id', '=', $Video_id)
            ->join('videogenres', 'videogenres.genre_id', '=', 'video_genres.id')
            ->select('video_genres.*', 'video_genres.name_en')
            ->get();

        return view('admin.video.video_details', compact('clubs','players','video','video_genres'));

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
