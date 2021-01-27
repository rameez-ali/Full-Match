<?php

namespace App\Http\Controllers;

use App\Http\Requests\Homepgmanage\CreateHomePgManageRequest;
use App\Http\Requests\Homepgmanage\GetAllHomePgManageRequest;
use App\Http\Requests\Homepgmanage\GetHomePgManageRequest;
use App\Http\Requests\Homepgmanage\UpdateHomePgManageRequest;
use App\Model\Club;
use App\Model\HomePageManagement;
use App\Model\HomePgItem;
use App\Model\Player;
use App\Model\Season;
use App\Model\Video;
use Illuminate\Http\Request;

class HomePageManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllHomePgManageRequest $request)
    {
        $response = $request->handle();

        return view('admin.homepagemanage.index',['homepagemanages' => $response] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetHomePgManageRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = url('home-page-manage');

        $all_seasons = Season::all();
        $all_players = Player::all();
        $all_clubs = Club::all();
        $all_videos = Video::where('leagues_id',null)->get();

        return view('admin.homepagemanage.form',[
            'homepagemanage' => $response,
            'route' => $route,
            'edit' => false,
            'all_seasons' => $all_seasons,
            'all_players' => $all_players,
            'all_clubs' => $all_clubs,
            'all_videos' => $all_videos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHomePgManageRequest $request)
    {
        $response = $request->handle();

        return redirect()->route('home-page-manage.index')->with('sectionaddsuccess','Section add Successfully');
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
        $request = new GetHomePgManageRequest();

        $request->id = $id;

        $response = $request->handle();

        $route = route('home-page-manage.update', $response->id);

        $get_players  =  HomePgItem::where('section_id',$response->id)->where('item_name','players')->get();
        $selected_players = array();
        foreach ($get_players as $k => $v ){
            array_push($selected_players, $v->item_id);
        }
//        dd($selected_players);
        $get_clubs  =  HomePgItem::where('section_id',$response->id)->where('item_name','clubs')->get();
        $selected_clubs = array();
        foreach ($get_clubs as $k => $v ){
            array_push($selected_clubs, $v->item_id);
        }

        $get_videos  =  HomePgItem::where('section_id',$response->id)->where('item_name','videos')->get();
        $selected_videos = array();
        foreach ($get_videos as $k => $v ){
            array_push($selected_videos, $v->item_id);
        }

        $all_seasons = Season::all();
        $all_players = Player::all();
        $all_clubs = Club::all();
        $all_videos = Video::where('leagues_id',null)->get();

        return view('admin.homepagemanage.form',[
            'homepagemanage' => $response,
            'route' => $route ,
            'edit' => true ,
            'all_seasons' => $all_seasons,
            'all_players' => $all_players,
            'all_clubs' => $all_clubs,
            'all_videos' => $all_videos,
            'selected_players' => $selected_players,
            'selected_clubs' => $selected_clubs,
            'selected_videos' => $selected_videos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomePgManageRequest $request, $id)
    {
        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('home-page-manage.index')->with('sectioneditsuccess','Section Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
