<?php
namespace App\Http\Controllers;
use App\Model\Continue_watch;
use App\Model\DeviceToken;
use App\Model\My_wish_list;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Videocategory;
use App\Model\Video;
use App\Model\League;
use App\Model\Leaguecategory;
use App\Model\Video_genre;
use App\Model\Category_genre;
use App\Model\Videogenre;
use App\Model\Club;
use App\Model\Player;
use App\Model\Videoclub;
use App\Model\Videoplayer;
use App\Model\Season;
use App\Model\Popular_search;
use App\Exports\CategoryVideosExport;
use App\Exports\ClubVideosExport;
use App\Exports\PlayerVideosExport;
use App\Exports\GenreVideosExport;
use App\Exports\SeasonVideosExport;
use DB;
use Vimeo\Vimeo;

use Maatwebsite\Excel\Facades\Excel;


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
              leftjoin('categories', 'categories.id', '=', 'videos.category_id')
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

    public function getallvideos($id)
    {
            $all_videos = Video::pluck('title_en', 'id', 'category');
            return json_encode($all_videos);
    }

    public function getgenres($id)
    {
        $genre_id1=Category_genre::where("category_id",$id)->get();
        $genreid = $genre_id1->pluck('genre_id')->toArray();
        $genre=Video_genre::select('name_en')->whereIn("id",$genreid)->pluck('name_en');
        return json_encode($genre);
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

    public function getseasonsedit($id)
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

        //Getting Video id in seconds
        $video_id=$request->video_id;

        //Getting Video duration in seconds
        $client = new Vimeo("24205e7ac91e486d8c2ef88490c4af32f9d9d67f", "zoUUWHOyoaI25PckaIq7s3D+1fzLAGh/81pxbAeI41LSCSFpHSRlL1s5Yc+K0ku1xfinHBmE3RfDqGUIvdTBqPzVAPAdZJd6Qe1tjN3q5INs5K7x7H5SeEeo4fhm7GGT", "fa0e6157d975fe04f800a8954ec2c2a0");
        $response = $client->request('/videos/'.$video_id, array(), 'GET');

        if($response['status']==200){
        $durationseconds=$response['body']['duration'];

        //Converting Seconds to HH:MM:SS
        $seconds = round($durationseconds);
        $video_duration = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);

        }
        else{
            $video_duration=$request->duration;
        }



       
                            



        if($request->file('video_banner_img')==null) {
            $image1 = $request->file('video_img');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('app-assets/images/video'), $new_name1);


            $form_data2 = array(
                'category_id'    =>   $request->category_id,
                'league_id'     =>   $request->league_id,
                'season_id'     =>   $request->season_id,
                'title_en'    =>   $request->title_en,
                'title_ar'    =>   $request->title_ar,
                'video_img'     =>   $new_name1,
                'description_en'     =>   $request->description_en,
                'description_ar'     =>   $request->description_ar,
                'video_link'     =>   $request->video_link,
                'video_link1'     =>   $request->video_link1,
                'video_link2'     =>   $request->video_link2,
                'video_link3'     =>   $request->video_link3,
                'video_id'     => $request->video_id,
                'duration'     =>   $video_duration,
                'notify_user'       => $request->notify_user,
                'video_sorting'       => $request->video_sorting,
                'popular_searches'       => $request->popularsearches,
                'video_promo'       => $request->video_promo

            );

            Video::create($form_data2);

            $last_video_id = Video::orderBy('id', 'DESC')->value('id');


            $video_categories = array(
                'video_id'    =>   $last_video_id,
                'category_id'     =>   $request->category_id
            );
            Videocategory::create($video_categories);



            if($request->club!=null){
                foreach($request->club as $club){
                    $form_data3 = array(
                        'Club_id'     =>   $club,
                        'Video_id'     =>  $last_video_id,
                        'category_id'  =>  $request->category_id
                    );

                    Videoclub::create($form_data3);

                }
            }


            if($request->player!=null){
                foreach($request->player as $player){
                    $form_data4 = array(
                        'Player_id'     =>   $player,
                        'Video_id'     =>  $last_video_id,
                        'category_id'  =>  $request->category_id
                    );

                    Videoplayer::create($form_data4);

                }
            }

            if($request->genre_id!=null){
            foreach ($request->genre_id as $genre) {
                $form_data9 = array(
                    'video_id' => $last_video_id,
                    'genre_id' => $genre,
                    'category_id' => $request->category_id
                );

                Videogenre::create($form_data9);
            }
        }


            $league_category = array(
                'video_id'     =>  $last_video_id,
                'league_id'     =>  $request->league_id,
                'category_id'  =>  $request->category_id
            );

            Leaguecategory::create($league_category);


         //for Send new video notification to all users
            if ($request->notify_user == 1){
                $tokenList_en = DeviceToken::where('notify_status', 1)->where('lang', 1)->pluck('token')->toArray();
                $tokenList_ar = DeviceToken::where('notify_status', 1)->where('lang', 2)->pluck('token')->toArray();

                //         dd($tokenList);
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                // $tokenList[] = 'eCcZ-L2K49w:APA91bHyArn9JrTqLWl1vmd_3IgE-XIDEwKAFL5B5g3RVBrSfacFfvQrXuywNXZuE2WlplXBxkFxmHoZb5oSc1hZayy8XGght7j6AyC4cS7661ck9UHseayLNPcxopCX2nWdKSXKwB8D';
                // $tokenList[] = 'f0xnoyCn90orlDK8SLGX8N:APA91bHl1l8tO_GClxgjtjsXHbO_5viCxCKJ3dmLcYbzcCcE82wxymm3IVJV9dc2OpIRkfTWBM3frUQ5Q2ZdPi6LVtSnbPSp0I7Rk4DmSaagRfmkhnQ_uwHBH3i8S8atdtk4TsTOSb5H';
                $notification_en = [
                    'title' => $request->title_en,
                    'text'  => $request->description_en,
                    'type'  => 1,
                    'sound' => true,
                ];

                $notification_ar = [
                    'title' => $request->title_ar,
                    'text'  => $request->description_ar,
                    'type'  => 1,
                    'sound' => true,
                ];


                $extraNotificationData = ["message" => $notification_en,"moredata" =>'dd'];

                $fcmNotification_en = [
                    'registration_ids' => $tokenList_en, //multple token array
                    // 'to' => $token, //single token
                    'notification' => $notification_en,
                    'data' => $extraNotificationData
                ];

                $fcmNotification_ar = [
                    'registration_ids' => $tokenList_ar, //multple token array
                    // 'to' => $token, //single token
                    'notification' => $notification_ar,
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
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification_en));
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification_ar));
                $result = curl_exec($ch);
                curl_close($ch);
                // print_r($result);

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
                'category_id'    =>   $request->category_id,
                'league_id'     =>   $request->league_id,
                'season_id'     =>   $request->season_id,
                'title_en'    =>   $request->title_en,
                'title_ar'    =>   $request->title_ar,
                'video_img'     =>   $new_name1,
                'video_banner_img'     =>   $new_name2,
                'description_en'     =>   $request->description_en,
                'description_ar'     =>   $request->description_ar,
                'video_link'     =>   $request->video_link,
                'video_link1'     =>   $request->video_link1,
                'video_link2'     =>   $request->video_link2,
                'video_link3'     =>   $request->video_link3,
                'video_id'     => $request->video_id,
                'duration'     =>   $video_duration,
                'notify_user'       => $request->notify_user,
                'video_sorting'       => $request->video_sorting,
                'popular_searches'       => $request->popularsearches,
                'video_promo'       => $request->video_promo

            );
            Video::create($form_data2);

            $last_video_id = Video::orderBy('id', 'DESC')->value('id');

            $video_categories = array(
                'video_id'    =>   $last_video_id,
                'category_id'     =>   $request->category_id
            );

            Videocategory::create($video_categories);


            if($request->club!=null){
                foreach($request->club as $club){
                    $form_data3 = array(
                        'Club_id'     =>   $club,
                        'Video_id'     =>  $last_video_id,
                        'category_id'  =>  $request->category_id
                    );

                    Videoclub::create($form_data3);

                }
            }


            if($request->player!=null){
                foreach($request->player as $player){
                    $form_data4 = array(
                        'Player_id'     =>   $player,
                        'Video_id'     =>  $last_video_id,
                        'category_id'  =>  $request->category_id
                    );

                    Videoplayer::create($form_data4);

                }
            }


            if($request->genre_id!=null){
            foreach ($request->genre_id as $genre) {
                $form_data9 = array(
                    'video_id' => $last_video_id,
                    'genre_id' => $genre,
                    'category_id' => $request->category_id
                );

                Videogenre::create($form_data9);

            }
        }

            $league_category = array(
                'video_id'     =>  $last_video_id,
                'league_id'     =>  $request->league_id,
                'category_id'  =>  $request->category_id
            );

            Leaguecategory::create($league_category);


           
         //for Send new video notification to all users
            if ($request->notify_user == 1){
                $tokenList_en = DeviceToken::where('notify_status', 1)->where('lang', 1)->pluck('token')->toArray();
                $tokenList_ar = DeviceToken::where('notify_status', 1)->where('lang', 2)->pluck('token')->toArray();

                //         dd($tokenList);
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                // $tokenList[] = 'eCcZ-L2K49w:APA91bHyArn9JrTqLWl1vmd_3IgE-XIDEwKAFL5B5g3RVBrSfacFfvQrXuywNXZuE2WlplXBxkFxmHoZb5oSc1hZayy8XGght7j6AyC4cS7661ck9UHseayLNPcxopCX2nWdKSXKwB8D';
                // $tokenList[] = 'f0xnoyCn90orlDK8SLGX8N:APA91bHl1l8tO_GClxgjtjsXHbO_5viCxCKJ3dmLcYbzcCcE82wxymm3IVJV9dc2OpIRkfTWBM3frUQ5Q2ZdPi6LVtSnbPSp0I7Rk4DmSaagRfmkhnQ_uwHBH3i8S8atdtk4TsTOSb5H';
                $notification_en = [
                    'title' => $request->title_en,
                    'text'  => $request->description_en,
                    'type'  => 1,
                    'sound' => true,
                ];

                $notification_ar = [
                    'title' => $request->title_ar,
                    'text'  => $request->description_ar,
                    'type'  => 1,
                    'sound' => true,
                ];

                


                $extraNotificationData = ["message" => $notification_en,"moredata" =>'dd'];

                $fcmNotification_en = [
                    'registration_ids' => $tokenList_en, //multple token array
                    // 'to' => $token, //single token
                    'notification' => $notification_en,
                    'data' => $extraNotificationData
                ];

                $fcmNotification_ar = [
                    'registration_ids' => $tokenList_ar, //multple token array
                    // 'to' => $token, //single token
                    'notification' => $notification_ar,
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
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification_en));
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification_ar));
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
        $all_genres=Video_genre::select('id','name_en')->get();

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

        //Getting League which is assocaited with video
        $selected_league_id = Video::where('id', '=', $id )->first();
        $selected_league_name = League::select('id','name_en')->where('id', '=', $selected_league_id->league_id )->first();

        //Getting Season of that league which is assocaited with video
        $selected_season_id = Video::select('season_id')->where('id', '=', $id )->first();
        $seasons=Season::select('id','name_en')->get();
        $selected_season_name = Season::select('id','name_en')->where('id', '=', $selected_season_id->season_id )->first();


        $leagues=League::where('id','!=', $selected_league_id->league_id)->get();


        return view('admin.video.edit',compact('all_genres','category','select_category_id','clubs','club','players','player','video','selected_ids','selected_ids1','selected_ids3','video_genres','selected_popular_search','popular_searches','leagues','seasons','selected_season_id','selected_league_name'));
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

        if($request->video_promo1!=null)
        {
           $video_promo=$request->video_promo1;
        }
        else if($request->video_promo2!=null)
        {
           $video_promo=$request->video_promo2;
        }
        else if($request->video_promo3!=null)
        {
           $video_promo=$request->video_promo3;
        }
        else if($request->video_promo4!=null)
        {
           $video_promo=$request->video_promo4;
        }
        else{
            $video_promo="";
        }


        //Getting Video id in seconds
        $video_id=$request->video_id;

        //Getting Video duration in seconds
        $client = new Vimeo("24205e7ac91e486d8c2ef88490c4af32f9d9d67f", "zoUUWHOyoaI25PckaIq7s3D+1fzLAGh/81pxbAeI41LSCSFpHSRlL1s5Yc+K0ku1xfinHBmE3RfDqGUIvdTBqPzVAPAdZJd6Qe1tjN3q5INs5K7x7H5SeEeo4fhm7GGT", "fa0e6157d975fe04f800a8954ec2c2a0");
        $response = $client->request('/videos/'.$video_id, array(), 'GET');

        if($response['status']==200){
        $durationseconds=$response['body']['duration'];

        //Converting Seconds to HH:MM:SS
        $seconds = round($durationseconds);
        $video_duration = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);


        }
        else{
            $video_duration=$request->duration;
        }


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
            'category_id'    =>   $request->category_id,
            'league_id'     =>   $request->league_id,
            'season_id'     =>   $request->season_id,
            'title_en'    =>   $request->title_en,
            'title_ar'    =>   $request->title_ar,
            'description_en'     =>   $request->description_en,
            'description_ar'     =>   $request->description_ar,
            'video_link'     =>   $request->video_link,
            'video_link1'     =>   $request->video_link1,
            'video_link2'     =>   $request->video_link2,
            'video_link3'     =>   $request->video_link3,
            'video_id'     => $request->video_id,
            'duration'     =>   $video_duration,
            'video_sorting'       => $request->video_sorting,
            'popular_searches'       => $request->popularsearches,
            'video_promo'       => $video_promo

        );

        Video::whereId($id)->update($form_data3);

        $last_video_id = Video::orderBy('id', 'DESC')->value('id');

        $video_categories = array(
            'video_id'    =>   $last_video_id,
            'category_id'     =>   $request->category_id
        );

        Videocategory::where('video_id',$id)->update($video_categories);


        if($request->club!=null){
            Videoclub::where('Video_id', $id)->forceDelete();
            foreach($request->club as $club){
                $form_data7 = array(
                    'Club_id'     =>   $club,
                    'Video_id'     =>  $id,
                    'category_id'  =>  $request->category_id
                );

                $videoclub=Videoclub::create($form_data7);


            }
        }

        if($request->player!=null){
            Videoplayer::where('Video_id', $id)->forceDelete();
            foreach($request->player as $player){
                $form_data8 = array(
                    'Player_id'     =>   $player,
                    'Video_id'     =>  $id,
                    'category_id'  =>  $request->category_id
                );

                Videoplayer::create($form_data8);

            }
        }

        Videogenre::where('video_id', $id)->forceDelete();
        if($request->genre_id!=null){
            foreach ($request->genre_id as $genre) {
                $form_data9 = array(
                    'video_id' => $id,
                    'genre_id' => $genre,
                    'category_id' => $request->category_id
                );
                  Videogenre::create($form_data9);
            }

        }


        if($request->category_id!=null){
            Leaguecategory::where('video_id', $id)->forceDelete();
            $league_category = array(
                'video_id'     =>  $id,
                'league_id'     =>  $request->league_id,
                'category_id'  =>  $request->category_id
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

        //Delete Relation of Video with Continue Watches
        Continue_watch::where('video_id', $id)->delete();

        //Delete Relation of Video with My List
        My_wish_list::where('video_id', $id)->delete();

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
            leftjoin('categories', 'categories.id', '=', 'videos.category_id')
                ->leftjoin('leagues', 'leagues.id', '=', 'videos.league_id')
                ->select('videos.*','videos.id','videos.title_en','videos.description_en','videos.video_link',
                    'videos.video_sorting','videos.video_banner_img','videos.video_img',
                    'videos.title_en','categories.name_en','leagues.name_en as leaguename')
                ->where('videos.id',$id)
                ->get();
        }
        else{
            //when video is not assoicated with league
            $video = Video::
            leftjoin('categories', 'categories.id', '=', 'videos.category_id')
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

    public function checkvideoid($id)
    {

       $checkvideoid= Video::where("video_id",$id)->get()->first();
        if(!isset($checkvideoid)) {
            $checkvideoid = "Yes";
            return json_encode($checkvideoid);
        }
        else{
            $checkvideoid="No";
            return json_encode($checkvideoid);
        }
    }

      public function get_category(Request $request)
        {
              $category=Category::select('name_en','id')->pluck("name_en","id");
              return response()->json($category);
        }

        public function get_genre(Request $request)
        {
              $genre=Video_genre::select('name_en','id')->pluck("name_en","id");
              return response()->json($genre);
        }


        public function get_club(Request $request)
        {
              $club=Club::select('name_en','id')->pluck("name_en","id");
              return response()->json($club);
        }


        public function get_player(Request $request)
        {
              $player=Player::select('name_en','id')->pluck("name_en","id");
              return response()->json($player);
        }

        public function get_league(Request $request)
        {
              $league=League::select('name_en','id')->pluck("name_en","id");
              return response()->json($league);
        }

        public function get_season(Request $request)
        {
              $season=Season::select('name_en','id')->where("league_id",$request->league_id)->pluck("name_en","id");
              return response()->json($season);
        }

        public function get_category_video(Request $request)
        {
              $videos=Video::select('title_en','id','video_sorting','description_en','video_link','video_promo','category_id')->whereIn("category_id",$request->category_ids)->distinct('id')->get();

              return response()->json($videos);
        }


        public function get_genre_video(Request $request)
        {
            $videos = Video::
            leftjoin('videogenres', 'videos.id', '=', 'videogenres.video_id')
                ->select('videos.*','videos.id','videos.title_en','videos.description_en','videogenres.genre_id')
                ->wherein('videogenres.genre_id',$request->genre_ids)
                ->get();
            return response()->json($videos);
        }

        public function get_club_video(Request $request)
        {
              $videos = Video::
              leftjoin('videoclubs', 'videos.id', '=', 'videoclubs.Video_id')
               ->select('videos.*','videos.id','videos.title_en','videos.description_en','videoclubs.Club_id')
               ->wherein('videoclubs.Club_id',$request->club_ids)
            ->get();
              return response()->json($videos);
        }

        public function get_player_video(Request $request)
        {
            $videos = Video::
            leftjoin('videoplayers', 'videos.id', '=', 'videoplayers.Video_id')
                ->select('videos.*','videos.id','videos.title_en','videos.description_en','videoplayers.Player_id')
                ->wherein('videoplayers.Player_id',$request->player_ids)
                ->get();
            return response()->json($videos);
        }


        public function get_season_video(Request $request)
        {

            $videos=Video::select('title_en','id','video_sorting','description_en','video_link','video_promo','season_id')->where("season_id",$request->season_ids)->get();
            return response()->json($videos);
        }

        public function exportexcel(Request $request)
        {
              if($request->category_id!=null){
              return Excel::download(new CategoryVideosExport($request->category_id), 'videos.xlsx');
              }
              else if($request->genre_id!=null){
              return Excel::download(new GenreVideosExport($request->genre_id), 'videos.xlsx');
              }
              else if($request->club_id!=null){
              return Excel::download(new ClubVideosExport($request->club_id), 'videos.xlsx');
              }
              else if($request->player_id!=null){
              return Excel::download(new PlayerVideosExport($request->player_id), 'videos.xlsx');
              }
              else if($request->season_id!=null){
              return Excel::download(new SeasonVideosExport($request->season_id), 'videos.xlsx');
              }
        }

        public function exportcsv(Request $request)
        {
            if ($request->category_id != null) {
                return Excel::download(new CategoryVideosExport($request->category_id), 'videos.csv');
            } else if ($request->genre_id != null) {
                return Excel::download(new GenreVideosExport($request->genre_id), 'videos.csv');
            } else if ($request->club_id != null) {
                return Excel::download(new ClubVideosExport($request->club_id), 'videos.csv');
            } else if ($request->player_id != null) {
                return Excel::download(new PlayerVideosExport($request->player_id), 'videos.csv');
            } else if ($request->season_id != null) {
                return Excel::download(new SeasonVideosExport($request->season_id), 'videos.csv');
            }
        }

      public function exportexcelseason(Request $request)
      {
        $video=Video::wherein('category_id',$request->name)->get();
        return Excel::download(new VideosExport($request->name), 'videos.xlsx');
      }

        public function search(Request $searchword){


        $video = Video::where('title_en', $searchword->q)
            ->orwhere('title_ar', $searchword->q)
            ->orWhere('title_en', 'like', '%' . $searchword->q. '%')
            ->orWhere('title_ar', 'like', '%' . $searchword->q. '%')
            ->get();


        $clubs  = Club::select('id')->where('name_en', $searchword->q)
            ->orwhere('name_ar', $searchword->q)
            ->orWhere('name_en', 'like', '%' . $searchword->q. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword->q. '%')
            ->get();


        $players = Player::select('id')->where('name_en', $searchword->q)
            ->orwhere('name_ar', $searchword->q)
            ->orWhere('name_en', 'like', '%' . $searchword->q. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword->q. '%')
            ->get();

        $categories = Category::select('id')->where('name_en', $searchword->q)
            ->orwhere('name_ar', $searchword->q)
            ->orWhere('name_en', 'like', '%' . $searchword->q. '%')
            ->orWhere('name_ar', 'like', '%' . $searchword->q. '%')
            ->get();




        if(count($video) > 0){
            return view('admin.videofilter.index', compact('video'));
        }
        else if(count($players) > 0){
            $video_id = Videoplayer::select('Video_id')->wherein('Player_id',$players)->get();
            $video=Video::wherein('id',$video_id)->get();
            $leagues=league::pluck('name_en','id');
            return view('admin.video.index', compact('video'));
        }

        else if (count($clubs) > 0){
            $video_id = Videoclub::select('Video_id')->wherein('Club_id',$clubs)->get();
            $video=Video::wherein('id',$video_id)->get();
            $leagues=league::pluck('name_en','id');
            return view('admin.video.index', compact('video'));
        }

        else if (count($categories) > 0){
            $video_id = Videocategory::select('video_id')->wherein('category_id',$categories)->get();
            $video=Video::wherein('id',$video_id)->get();
                       $leagues=league::pluck('name_en','id');

            return view('admin.video.index', compact('video'));
        }

        else {

            return view('admin.video.index', compact('video'));
        }
    }

}
