<?php

namespace App\Http\Controllers;

use App\Model\Club;
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

    function __construct() {
        $this->middleware('can:view-league', ['only' => ['index', 'show']]);
        $this->middleware('can:add-league', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-league', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-league', ['only' => ['destroy']]);
    }

    public function index()
    {
        $project = League::all();
        return view('admin.league.index', compact('project'));
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


        if ($request->file('filename1')==null)
        {

            $image3 = $request->file('filename3');
            $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('app-assets/images/league'), $new_name3);

            $form_data1 = array(
                'name_en'     =>   $request->name_en,
                'name_ar'     =>   $request->name_ar,
                'league_promo_video'  =>   $request->filename2,
                'league_profile_image'  =>   $new_name3,
                'description_en'  =>   $request->description_en,
                'description_ar'  =>   $request->description_ar
            );

            // Insert League Array
            league::create($form_data1);

            // Id of Last Inserted League
            $id = DB::table('leagues')->orderBy('ID', 'DESC')->value('ID');

            //Insert Season Array

            foreach($request->addmore as $addmore){
                $newSeason = new Season();
                $newSeason->league_id=$id;
                $newSeason->name_en=$addmore['name_en'];
                $newSeason->Video = $addmore['qty'];
                $newSeason->save();
            }


            return redirect('league-form')->with('leagueaddsuccess','League Added Successfully');
        }

        else if($request->file('filename1')!=null){
            $image1 = $request->file('filename1');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('app-assets/images/league'), $new_name1);

            $image3 = $request->file('filename3');
            $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('app-assets/images/league'), $new_name3);

            $form_data1 = array(
                'name_en'     =>   $request->name_en,
                'name_ar'     =>   $request->name_ar,
                'league_promo_video'  =>   $request->filename2,
                'league_banner'  =>   $new_name1,
                'league_profile_image'  =>   $new_name3,
                'description_en'  =>   $request->description_en,
                'description_ar'  =>   $request->description_ar
            );

            // Insert League Array
            league::create($form_data1);

            // Id of Last Inserted League
            $id = DB::table('leagues')->orderBy('ID', 'DESC')->value('ID');

            //Insert Season Array

            foreach($request->addmore as $addmore){
                $newSeason = new Season();
                $newSeason->league_id=$id;
                $newSeason->name_en=$addmore['name_en'];
                $newSeason->Video = $addmore['qty'];
                $newSeason->save();
            }


            return redirect('league-form')->with('leagueaddsuccess','League Added Successfully');

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


        $league=League::find($id);
        $season= Season::orderBy('id', 'ASC')->where('league_id', $id)->get();

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

        if($request->filename1!=null)
        {
            $image=$request->file('filename1');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('app-assets/images/league'), $new_name);

            $form_data2 = array(
                'league_banner'     =>   $new_name
            );

            League::whereId($id)->update($form_data2);
        }

        if($request->filename3!=null)
        {
            $image1=$request->file('filename3');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('app-assets/images/league'), $new_name1);

            $form_data2 = array(
                'league_profile_image'     =>   $new_name1
            );

            League::whereId($id)->update($form_data2);
        }


        $form_data = array(
            'name_en'       =>   $request->name_en,
            'name_ar'       =>   $request->name_ar,
            'description_en'       =>   $request->description_en,
            'description_ar'       =>   $request->description_ar,
            'league_sorting'       =>   $request->league_sorting,
            'league_promo_video'            =>   $request->league_promo_video
        );

        League::whereId($id)->update($form_data);


        Season::where('league_id', $id)->forceDelete();

        foreach($request->addmore as $addmore){
            $newSeason = new Season();
            $newSeason->league_id=$id;
            $newSeason->name_en=$addmore['name_en'];
            $newSeason->Video = $addmore['qty'];
            $newSeason->save();
        }

        return redirect('league-form')->with('leagueeditsuccess','League Updated Successfully');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $videoleague=Leaguecategory::where('league_id', $id)->get()->toArray();
        if($videoleague!=null){
            return redirect('league-form')->with('leaguedelsuccess','You cant delete this League because Video is Associated with this League');
        }
        else{
            Season::where('league_id', $id)->delete();
            $data = League::findOrFail($id);
            $data->delete();
            return redirect('league-form')->with('leaguedelsuccess','League Deleted Successfully');
        }
    }

    public function destroy1($id)
    {
        //  $data = Category::findOrFail($id);
        //  $data->delete();
        // $Image_id=$id;
        // $data3 = Season::all();
        // $data4 = League::all();
         $league1 = League::find($id)->get();

         $league = DB::table('seasons')
            ->join('leagues', 'leagues.id', '=', 'seasons.league_id')
            ->select('leagues.*','seasons.name_en','seasons.Video',
                     'leagues.name_en as leaguename','leagues.description_en','leagues.league_promo_video',
                     'leagues.league_sorting')
            ->where('league_id','=',$id)
            ->distinct()

            ->get();


            return view('admin.season.index', compact('league','league1'));

    }
}
