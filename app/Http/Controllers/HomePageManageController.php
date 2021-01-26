<?php

namespace App\Http\Controllers;

use App\Http\Requests\Homepgmanage\GetAllHomePgManageRequest;
use App\Http\Requests\Homepgmanage\GetHomePgManageRequest;
use App\Model\Club;
use App\Model\HomePageManagement;
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
    public function store(Request $request)
    {
        //
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
        //
    }
}
