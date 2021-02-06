<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Player;
use App\Model\Videoplayer;

class ProjectPlayerViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct() {
        $this->middleware('can:view-player', ['only' => ['index', 'show']]);
        $this->middleware('can:add-player', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-player', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-player', ['only' => ['destroy']]);
    }

    public function index()
    {
        $player = Player::all();
        return view('admin.player.index', compact('player'));
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
            'name_en'     => 'required',
            'name_ar'     => 'required',
            'player_banner'         =>  'required|image|max:2048',
            'player_profile_image'  =>  'required|image|max:2048',
            'description_en'     => 'required',
            'description_ar'     => 'required'
        ]);

        $image = $request->file('player_banner');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('app-assets/images/player'), $new_name);

        $image1 = $request->file('player_profile_image');
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('app-assets/images/player'), $new_name1);

        $form_data2 = array(
            'name_en'     =>   $request->name_en,
            'name_ar'     =>   $request->name_ar,
            'player_banner'     =>   $new_name,
            'player_profile_image'     =>   $new_name1,
            'description_en'     =>   $request->description_en,
            'description_ar'     =>   $request->description_ar,
            'player_sorting'     =>   $request->player_sorting
        );


        Player::create($form_data2);

        return redirect('player-form')->with('playeraddsuccess','Player Added Successfully');


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
        $player=Player::find($id);
        return view('admin.player.edit',compact('player'));
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

        $image1 = $request->file('player_banner');
        $image2 = $request->file('player_profile_image');

        if($image1 != '' || $image2 != '')
        {
            $request->validate([
                'name_en'    =>  'required',
                'name_ar'    =>  'required',
                'description_en'    =>  'required',
                'description_ar'    =>  'required',
                'image1'         =>  'image|max:2048',
                'image2'         =>  'image|max:2048'
            ]);

            $image_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('app-assets/images/player'), $image_name1);

            $image_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('app-assets/images/player'), $image_name2);

            echo $image1;
        }
        else
        {
            $request->validate([
                'name_en'    =>  'required',
                'name_ar'    =>  'required',
                'hidden_image1'    =>  'required',
                'hidden_image2'    =>  'required',
                'description_en'    =>  'required',
                'description_ar'    =>  'required'
            ]);
        }

        $form_data = array(
            'name_en'       =>   $request->name_en,
            'name_ar'       =>   $request->name_ar,
            'description_en'       =>   $request->description_en,
            'description_ar'       =>   $request->description_ar,
            'player_banner'          =>   $image_name1,
            'player_profile_image'   =>   $image_name2,
            'player_sorting'         =>  $request->player_sorting
        );

        Player::whereId($id)->update($form_data);

        return redirect('player-form')->with('playereditsuccess','Player Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Videoplayer::where('Player_id', $id)->delete();

        $data = Player::findOrFail($id);
        $data->delete();
        return redirect('player-form')->with('playerdelsuccess','Player Deleted Successfully');


    }
}
