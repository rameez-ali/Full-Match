<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\League;
use DB;
use App\Model\Season;

class ProjectLeagueViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = League::latest()->paginate(5);
            return view('admin.league.index', compact('project'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.league.form');

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
            'Project_Name'     => 'required',
            'Project_Category'     => 'required',
            'Project_Details'     => 'required',
            'filename'         =>  'required',
            'league_banner'    => 'required',
            'league_promo_video' => 'required',
            'league_profile_image' => 'required'
        ]);
        
        $Project_Category = $request->Project_Category;
        $Category_id = DB::table('project_categories')->where('category_name', $Project_Category)->value('ID');
        
        $form_data1 = array(
             'League_Name'     =>   $request->Project_Name,
             'League_Description'  =>   $request->Project_Details,
             'league_banner'  =>   $request->league_banner,
             'league_promo_video'  =>   $request->league_promo_video,
             'league_profile_image'  =>   $request->league_profile_image,
             'Category_id'     =>    $Category_id
        );

        league::create($form_data1);

        $image = $request->file('filename');
        foreach($image as $image){
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $id = DB::table('leagues')->orderBy('ID', 'DESC')->value('ID');
        $seasons="season1";
        $form_data2 = array(
            'Project_id'     =>    $id,
            'Seasons'   =>  $seasons, 
            'Video'     =>   $new_name
        );

        Season::create($form_data2);
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
        $data = Project::find($ID);
        $data->delete();

        return redirect('project-view')->with('success', 'Data is successfully deleted');
    }

    public function destroy1($id)
    {
      //  $data = ProjectCategory::findOrFail($id);
      //  $data->delete();
        $Image_id=$id;
        $data3 = Season::latest()->paginate(5);
        $data4 = League::all();
        // $id = DB::table('seasons')->where('Project_id', $Cat_id)->value('id');
        return view('admin.season.index', compact('Image_id','data3','data4'));
       // return view('helloworld')->with('variableone', $id);

    }
}
