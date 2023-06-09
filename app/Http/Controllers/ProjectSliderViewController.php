<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video;
use DB;
use App\Model\Slider;
use App\Model\Slidervideo;
use App\Model\Club;
use Illuminate\Support\Facades\Input;



class ProjectSliderViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct() {
        $this->middleware('can:view-slider', ['only' => ['index', 'show']]);
        $this->middleware('can:add-slider', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-slider', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-slider', ['only' => ['destroy']]);
    }

    public function index()
    {
       //Getting Category id associated with this slider
       $category_id = Slider::select('category_id')->get()->toArray();

        //Getting Category associated with this slider
           $slidercategory = Slider::
             leftjoin('categories', 'categories.id', '=', 'sliders.category_id')
            ->select('sliders.*','sliders.id','sliders.name_en',
                'sliders.slider_sorting','categories.name_en as catname')
            ->get();


        return view('admin.slider.index', compact('slidercategory'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $video=Category::all();
        $club=Club::all();
        return view('admin.slider.form',compact('club','video'));
    }

    public function getallvideos($id)
    {
        $nullability=null;

        //Check if slider associated with home already exists
        $category_status = Slider::where("category_id",$nullability)->get()->first();

        if(!isset($category_status)) {
            $all_videos = Video::pluck('title_en', 'id', 'category');
            return json_encode($all_videos);
        }
        else{
            $all_videos="null";
            return json_encode($all_videos);
        }
    }

    public function getvideos($id)
    {
        //Check if slider associated with Category already exists
        $category_status = Slider::where("category_id",$id)->get()->first();
        if(!isset($category_status)) {
            $category_videos = Video::select('title_en', 'id')->where("category_id", $id)->pluck("title_en", "id");
            return json_encode($category_videos);
        }
        else{
            $category_videos="null";
            return json_encode($category_videos);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->country!=null)
        {
            $form_data2 = array(
                'category_id'    => $request->country > 0 ? $request->country : null,
                'name_en'    =>   $request->name_en,
                'name_ar'    =>   $request->name_ar,
                'slider_sorting'    =>   $request->slider_sorting
            );
            Slider::create($form_data2);
        }


        $id = Slider::orderBy('id', 'DESC')->value('id');

        foreach($request->state as $state){
            $form_data3 = array(
                'Video_id'     =>  $state,
                'Slider_id'     =>   $id,
            );

            Slidervideo::create($form_data3);
        }

        return redirect('slider-form')->with('slideraddsuccess','Slider Added Successfully');


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
        $slider_id=$id;

        $videos =  Video::
              where('Slider_id', '=', $slider_id)
            ->join('slidervideos', 'slidervideos.Video_id', '=', 'videos.id')
            ->select('videos.id')
            ->get();

        $selected_ids = [];
        foreach ($videos as $key => $vid) {
            array_push($selected_ids, $vid->id);
        }


        $videos2 =  Slider::
              where('id', '=', $slider_id)
            ->select('sliders.category_id')
            ->get();

        $videos1=json_decode($videos2, true);

        //Getting All Videos associated with slider
        foreach($videos1 as $videos1)
        {
            //Getting All Videos associated with slider when its a home slider
            if($videos1['category_id']==null)
            {
                $video1 =  Video::
                      select('videos.id','videos.title_en')
                    ->get();
            }
            else{
                //Getting All Videos associated with slider when its a category slider
                $video1 =  Video::
                      where('category_id', '=', $videos1)
                    ->select('videos.id','videos.title_en')
                    ->get();
            }
        }

       //Getting Slider Details
        $slider=Slider::find($id);

        //Getting Category associated with this slider
        $select_category_id = Slider::select('category_id')->where('id', '=', $id )->get()->first();
        $category=Category::select('id','name_en')->wherein('id',$select_category_id )->get()->first();


        return view('admin.slider.edit', compact('category','select_category_id','selected_ids','video1','slider'));


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
            'video'     => 'required'
        ]);

        $form_data2 = array(
            'name_en'    =>   $request->name_en,
            'name_ar'    =>   $request->name_ar,
            'slider_sorting'    =>   $request->slider_sorting
        );

        Slider::whereId($id)->update($form_data2);

        SliderVideo::where('Slider_id', $id)->forceDelete();


        echo $request->Video_id;

        foreach($request->video as $video){
            $form_data3 = array(
                'Video_id'     =>   $video,
                'Slider_id'     =>  $id
            );

            Slidervideo::create($form_data3);
        }

        return redirect('slider-form')->with('slidereditsuccess','Slider Updated Successfully');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function slider_details($id)
    {
        //Getting Category
        $category_id = Slider::select('category_id')->where('id','=',$id)->get()->first();

        if($category_id->category_id!=null){
           $sliders = Slider::
              join('categories', 'categories.id', '=', 'sliders.category_id')
            ->select('sliders.*','sliders.id','sliders.name_en',
                'sliders.slider_sorting','categories.name_en as catname')
            ->where('sliders.id',$id)
            ->get();
        }
        else{
            $sliders = Slider::select('name_en','slider_sorting')->where('id','=',$id)->get();
        }


        $slider_id=$id;

        //Getting Videos assocaited with this slider
        $videos =  Video::
              where('Slider_id', '=', $slider_id)
            ->join('slidervideos', 'slidervideos.Video_id', '=', 'videos.id')
            ->select('videos.*', 'videos.title_en')
            ->get();

        return view('admin.slider.slider_details', compact('videos','sliders'));



    }



    public function destroy($id)
    {
        //Delete Relation of Slider and Video
        SliderVideo::where('Slider_id', $id)->delete();

        //Delete Slider
        $data = Slider::findOrFail($id);
        $data->delete();
        return redirect('slider-form')->with('sliderdelsuccess','Slider Deleted Successfully');

    }
}
