<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Videoclub;
use App\Model\Club;

class ProjectClubViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct() {
        $this->middleware('can:view-club', ['only' => ['index', 'show']]);
        $this->middleware('can:add-club', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-club', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-club', ['only' => ['destroy']]);
    }

    public function index()
    {
        $club = Club::all();
        return view('admin.club.index', compact('club'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.club.form');
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
            'name_en'         => 'required',
            'name_ar'        => 'required',
            'club_banner'     =>  'required|image|max:2048',
            'club_logo'       =>  'required|image|max:2048',
            'description_en'  => 'required',
            'description_ar' => 'required'

        ]);

        $image = $request->file('club_banner');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('app-assets/images/club'), $new_name);

        $image1 = $request->file('club_logo');
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('app-assets/images/club'), $new_name1);

        $form_data2 = array(
            'name_en'     =>   $request->name_en,
            'name_ar'     =>   $request->name_ar,
            'club_banner'     =>   $new_name,
            'club_logo'     =>   $new_name1,
            'description_en'     =>   $request->description_en,
            'description_ar'     =>   $request->description_ar,
            'club_sorting'     =>   $request->club_sorting
        );


        Club::create($form_data2);

        return redirect('club-form')->with('clubaddsuccess','Club Added Successfully');


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
        $club=Club::find($id);
        return view('admin.club.edit',compact('club'));
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

        $image1 = $request->file('club_banner');
        $image2 = $request->file('club_logo');

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
            $image1->move(public_path('app-assets/images/club'), $image_name1);

            $image_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('app-assets/images/club'), $image_name2);

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
            'club_banner'          =>   $image_name1,
            'club_logo'   =>   $image_name2,
            'club_sorting'         =>  $request->club_sorting
        );

        Club::whereId($id)->update($form_data);

        return redirect('club-form')->with('clubeditsuccess','Club Updated Successfully');

        //  return redirect('club-form')->with('clubeditsuccess','Club Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $videoclub=Videoclub::where('Club_id', $id)->get()->toArray();
        if($videoclub!=null){
            return redirect('club-form')->with('clubdelsuccess','You cant delete this Club because Video is Associated with this Club');
        }
        else{
            $data = Club::findOrFail($id);
            $data->delete();
            return redirect('club-form')->with('clubdelsuccess','Club Deleted Successfully');
        }
    }
}
