<?php

namespace App\Http\Controllers;

use App\Model\club;
use App\Model\Slidervideo;
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
           dd($request->addmore);
         // dd($request->addmore);
        //$filename1 insertion
        // $image1 = $request->file('filename1');
        // $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        // $image1->move(public_path('images'), $new_name1);


        // $image3 = $request->file('filename3');
        // $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
        // $image3->move(public_path('images'), $new_name3);

        // $form_data1 = array(
        //      'league_name'     =>   $request->league_name,
        //      'league_banner'  =>   $new_name1,
        //      'league_promo_video'  =>   $request->filename2,
        //      'league_profile_image'  =>   $new_name3,
        //      'league_description'  =>   $request->league_description,
        //      'league_sorting'  =>   $request->league_sorting
        // );

        // // Insert League Array
        // league::create($form_data1);

        //  // Id of Last Inserted League
        //   $id = DB::table('leagues')->orderBy('ID', 'DESC')->value('ID');

        // //Insert Season Array
        // foreach($request->addmore as $addmore){
        //     $newSeason = new Season();
        //     $newSeason->Project_id=$id;
        //     $newSeason->Seasons=$addmore['name'];
        //     $newSeason->Video = $addmore['qty'];
        //     $newSeason->save();
        // }


        
        // foreach($request->addmore as $addmore){

        //  $form_data2 = array(
        //      'Project_id'     =>    $id,
        //      'Seasons'   =>  $addmore['name'],
        //      'Video'     =>   $addmore['qty']
        //  );

        //  Season::create($form_data2);
        // }

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


         $league=League::find($id);
         $season= Season::orderBy('id', 'ASC')->where('Project_id', $id)->get(); 
         
          return view('admin.league.edit',compact('league','season'));
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
           // dd($request->addmore);
        $image_name1 = $request->hidden_image1;
        $image_name3 = $request->hidden_image3;

        $image1 = $request->file('league_banner');
        $image3 = $request->file('league_profile_image');

        if($image1 != '' || $image3 != '')
        {
            $request->validate([
                'league_name'    =>  'required',
                'league_description'    =>  'required',
                'league_sorting'    =>  'required',
                'image1'         =>  'image|max:2048',
                'image2'         =>  'image|max:2048',
                'image3'         =>  'image|max:2048'
            ]);

            $image_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('images'), $image_name1);

            $image_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('images'), $image_name3);
        }
        else
        {
            $request->validate([
                'league_name'    =>  'required',
                'league_description'    =>  'required',
                'league_promo_video'    =>  'required',
                'league_sorting'    =>  'required'
            ]);
        }


        $form_data = array(
            'league_name'       =>   $request->league_name,
            'league_description'       =>   $request->league_description,
            'league_sorting'       =>   $request->league_sorting,
            'league_banner'            =>   $image_name1,
            'league_promo_video'            =>   $request->league_promo_video,
            'league_profile_image'            =>   $image_name3
        );

        League::whereId($id)->update($form_data);

    
            Season::where('Project_id', $id)->forceDelete();

               foreach($request->addmore as $addmore){
               $newSeason = new Season();
               $newSeason->Project_id=$id;
               $newSeason->Seasons=$addmore['name'];
               $newSeason->Video = $addmore['qty'];
               $newSeason->save();
       
               }

        // return redirect('league-form')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Season::where('Project_id', $id)->delete();

        $data = League::findOrFail($id);
        $data->delete();
        return redirect('league-form')->with('success', 'Data is successfully deleted');
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
