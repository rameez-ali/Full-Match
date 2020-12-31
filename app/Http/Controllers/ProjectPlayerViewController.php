<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectCategory;
use App\Model\Player;
use App\Model\Video_player;

class ProjectPlayerViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $player = Player::latest()->paginate(5);
            return view('admin.player.index', compact('player'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.player.form');
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
            'player_name'     => 'required',
            'player_banner'         =>  'required|image|max:2048',
            'player_profile_image'  =>  'required|image|max:2048',
            'player_description'     => 'required'
        ]);

        $image = $request->file('player_banner');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $image1 = $request->file('player_profile_image');
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);
       
        $form_data2 = array(
            'player_name'     =>   $request->player_name,
            'player_banner'     =>   $new_name,
            'player_profile_image'     =>   $new_name1,
            'player_description'     =>   $request->player_description
        );


        Player::create($form_data2);

        return redirect('player-form')->with('success', 'Data is successfully deleted');
        
       
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
        Video_player::where('Player_id', $id)->delete();

        $data = Player::findOrFail($id);
        $data->delete();
        return redirect('player-form')->with('success', 'Data is successfully deleted');


    }
}
