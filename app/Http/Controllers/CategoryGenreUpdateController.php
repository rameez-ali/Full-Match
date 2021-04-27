<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video;
use DB;
use App\Model\Slider;
use App\Model\Slidervideo;
use App\Model\Category_genre;
use App\Model\Video_genre;
use App\Model\Videogenre;
use App\Model\Club;
use Illuminate\Support\Facades\Input;



class CategoryGenreUpdateController extends Controller
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
        $video=Video::all();
        $category=Category::all();
        return view('admin.categorygenreupdate.form',compact('category','video'));
    }


    public function getvideos($id)
    {       
        $category_videos = Video::select('title_en', 'id')->where("category_id", $id)->pluck("title_en", "id");
        return json_encode($category_videos);
    }

    public function getgenres($id)
    {
        $genre_id1=Category_genre::where("category_id",$id)->get();
        $genreid = $genre_id1->pluck('genre_id')->toArray();
        $genre=Video_genre::select('name_en')->whereIn("id",$genreid)->pluck('name_en');
        return json_encode($genre);      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          if($request->video_id!=null){
           foreach($request->video_id as $video_id){
            $video = array(
                'category_id'    =>   $request->category_id
            );
        
            DB::table('videos')->where('id', $request->video_id)->update($video);
            DB::table('videoclubs')->where('video_id', $request->video_id)->update($video);
            DB::table('videoplayers')->where('video_id', $request->video_id)->update($video);
            DB::table('videocategories')->where('video_id', $request->video_id)->update($video);
            DB::table('leaguecategories')->where('video_id', $request->video_id)->update($video);

            Videogenre::where('video_id', $video_id)->delete();

               if($request->genre_id!=null){
                foreach ($request->genre_id as $genre) {
                    $form_data9 = array(
                        'video_id' => $video_id,
                        'genre_id' => $genre,
                        'category_id' => $request->category_id
                    );
                      Videogenre::create($form_data9);
                }
    
            }

        }
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
