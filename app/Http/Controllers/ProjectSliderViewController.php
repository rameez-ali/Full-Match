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
            return view('admin.slider.index', compact('slidercategory'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $video=ProjectCategory::all();
        $club=Club::all();
        return view('admin.slider.form',compact('club','video'));
    }

    public function getallvideos($id) 
    {
        //$states = DB::table("videos")->pluck("video_title","id");
        $states = DB::table("videos")->pluck("video_title","id","category");;
        return json_encode($states);
        //return json_encode($states);
    }

    public function getvideos($id) 
    {
        $states1 = DB::table("videos")->where("Category_id",$id)->pluck("video_title","id");
        return json_encode($states1);
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
            'Category_id'    => $request->country > 0 ? $request->country : null,
            'slider_name'    =>   $request->slider_name,
            'slider_sorting'    =>   $request->slider_sorting
        );        
         Slidercategory1::create($form_data2);
        }


        $id = DB::table('slidercategory1s')->orderBy('id', 'DESC')->value('id');

        foreach($request->state as $state){
            $form_data3 = array(
            'Video_id'     =>  $state,
            'Slider_id'     =>   $id,
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
       $slider_id=$id;
      $slidervideos = DB::table('slidervideos');
      $videos =  DB::table('videos')
        ->where('Slider_id', '=', $slider_id)
        ->join('slidervideos', 'slidervideos.Video_id', '=', 'videos.id')
        ->select('videos.id')
        ->get();
       
       $selected_ids = [];
       foreach ($videos as $key => $vid) {
           array_push($selected_ids, $vid->id);
       }
       

       $videos2 =  DB::table('slidercategory1s')
        ->where('id', '=', $slider_id)
        ->select('slidercategory1s.Category_id')
        ->get();

     $videos1=json_decode($videos2, true);

      $video1 =  DB::table('videos')
        ->where('Category_id', '=', $videos1)
        ->select('videos.id','videos.video_title')
        ->get();

       $slider=Slidercategory1::find($id);

       
       return view('admin.slider.edit', compact('selected_ids','video1','slider'))
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

        $form_data2 = array(
            'slider_name'    =>   $request->slider_name
        );        

         Slidercategory1::whereId($id)->update($form_data2);

        SliderVideo::where('Slider_id', $id)->forceDelete();

         
         echo $request->Video_id;
         
         foreach($request->video as $video){
            $form_data3 = array(
            'Video_id'     =>   $video,
            'Slider_id'     =>  $id
             );

            Slidervideo::create($form_data3);
            }     

            }               

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function destroy1($id)
    {
        $slidercategory = Slidercategory1::latest()->paginate(5);
      $slider_id=$id;

      $slidervideos = DB::table('slidervideos');
      $videos =  DB::table('videos')
        ->where('Slider_id', '=', $slider_id)
        ->join('slidervideos', 'slidervideos.Video_id', '=', 'videos.id')
        ->select('videos.*', 'videos.video_title')
        ->get(); 

            return view('admin.slider.display', compact('videos','slidervideos','slidercategory'))
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
