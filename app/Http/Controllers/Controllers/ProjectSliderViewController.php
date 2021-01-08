<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;
use App\Model\Video;
use DB;
use App\Model\Slidercategory1;
use App\Model\Slidervideo;
use App\Model\Club;

class ProjectSliderViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slidercategory = Slidercategory1::latest()->paginate(5);
            return view('admin.slider.index', compact('slidercategory'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $video=Video::all();
        echo $video;
        // $club=Club::all();
        // return view('admin.slider.form',compact('video','club'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $form_data2 = array(
            'slider_name'    =>   $request->slider_name,
        );        

         Slidercategory1::create($form_data2);
         
         foreach($request->video as $video){
            $id = DB::table('slidercategory1s')->orderBy('id', 'DESC')->value('id');
            $form_data3 = array(
            'Video_id'     =>   $video,
            'Slider_id'     =>  $id
             );

            Slidervideo::create($form_data3);
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
        echo $slider_id=$id;
      $slidervideos = DB::table('slidervideos');
      $videos =  DB::table('videos')
        ->where('Slider_id', '=', $slider_id)
        ->join('slidervideos', 'slidervideos.Video_id', '=', 'videos.id')
        ->select('videos.*', 'videos.video_title')
        ->get();

        $video=Video::all();
        $slider=Slidercategory1::find($id);

        return view('admin.slider.edit', compact('videos','video','slidervideos','slider'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        echo $Slider_id=$id;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function destroy1($id)
    {
      
      $slider_id=$id;

      $slidervideos = DB::table('slidervideos');
      $videos =  DB::table('videos')
        ->where('Slider_id', '=', $slider_id)
        ->join('slidervideos', 'slidervideos.Video_id', '=', 'videos.id')
        ->select('videos.*', 'videos.video_title')
        ->get(); 

            return view('admin.slider.display', compact('videos','slidervideos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);



    }



    public function destroy($id)
    {
        SliderVideo::where('Slider_id', $id)->delete();

        $data = Slidercategory1::findOrFail($id);
        $data->delete();
        return redirect('slider-form')->with('success', 'Data is successfully deleted');



    }
}
