<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;
use App\Model\Video;
use DB;
use App\Model\Slidercategory1;
use App\Model\Adv_banner_video;
use App\Model\Adv_banner;
use App\Model\Video_genre;

class ProjectAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Adv_banner = Adv_banner::all();
        return view('admin.advertisementbanner.index', compact('Adv_banner'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $videogenre=Video_genre::all();
        $video=ProjectCategory::all();
        return view('admin.advertisementbanner.form',compact('video','videogenre'));
    }

    public function getallvideos($id)
    {
        //$states = DB::table("videos")->pluck("video_title","id");
        //$states = DB::table("videos")->pluck("video_title","id","category");;
        $states=Video::pluck('video_title','id','category');
       // echo $states;

         return json_encode($states);
        //return json_encode($states);
    }

    public function getvideos($id)
    {
        //$states1 = DB::table("videos")->where("Category_id",$id)->pluck("video_title","id");
       $states1=Video::select('video_title','id')->where("Category_id",$id)->pluck("video_title","id");

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

       if($request->file('video_banner')==null){
        $form_data2 = array(
            'video_title'    =>   $request->video_title,
            'video_link'    =>   $request->video_link,
            'category_id'    =>   $request->country,
            'genre_id'    =>   $request->genre,
            'homepage'    =>   $request->homepage
        );
          Adv_banner::create($form_data2);

       }
       else{
          $image = $request->file('video_banner');
          $new_name = rand() . '.' . $image->getClientOriginalExtension();
          $image->move(public_path('app-assets/images/banner'), $new_name);

           $form_data2 = array(
            'video_title'    =>   $request->video_title,
            'video_link'    =>   $request->video_link,
            'video_banner'    =>   $image,
            'category_id'    =>   $request->country,
            'genre_id'    =>   $request->genre,
            'homepage'    =>   $request->homepage
        );
          Adv_banner::create($form_data2);

       }

        $id = DB::table('adv_banners')->orderBy('id', 'DESC')->value('id');

        if($request->state!=null){
        foreach($request->state as $state){
            $form_data3 = array(
            'banner_id'     =>   $id,
            'video_id'     =>  $state,
             );

            Adv_banner_video::create($form_data3);
        }
      }

        return redirect('banner-form')->with('advbanneraddsuccess','Advertisement Banner Added Successfully');


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

     $category=ProjectCategory::all();
      $banner_id=$id;
      $slidervideos = DB::table('adv_banner_videos');
      $videos =  DB::table('videos')
        ->where('banner_id', '=', $banner_id)
        ->join('adv_banner_videos', 'adv_banner_videos.Video_id', '=', 'videos.id')
        ->select('videos.id')
        ->get();

        $select_category_id = Adv_banner::select('category_id')->where('id', '=', $id )->first();
        $select_genre_id = Adv_banner::select('genre_id')->where('id', '=', $id )->first();

       $selected_ids = [];
       foreach ($videos as $key => $vid) {
           array_push($selected_ids, $vid->id);
       }

       $category=ProjectCategory::select('id','category_name')->get();
       $videogenre=Video_genre::select('id','genre_name')->get();
       //$video=video::select('id','video_title')->get();



          $videos2 =  DB::table('adv_banners')
             ->where('id', '=', $banner_id)
             ->select('adv_banners.category_id')
             ->get();

         $videos1=json_decode($videos2, true);

            $video1 =  DB::table('videos')
             ->where('Category_id', '=', $videos1)
             ->select('videos.id','videos.video_title')
             ->get();






       $slider=Adv_banner::find($id);


        return view('admin.advertisementbanner.edit', compact('videos','video1','selected_ids','select_category_id','select_genre_id','slider','category','videogenre'))
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

        if($request->file('video_banner')==null){
        $form_data2 = array(
            'video_title'    =>   $request->video_title,
            'video_link'    =>   $request->video_link,
            'category_id'    =>   $request->country,
            'genre_id'    =>   $request->genre,
            'homepage'    =>   $request->homepage
        );
          Adv_banner::whereId($id)->update($form_data2);

       }
       else{
          $image = $request->file('video_banner');
          $new_name = rand() . '.' . $image->getClientOriginalExtension();
          $image->move(public_path('app-assets/images/banner'), $new_name);

           $form_data2 = array(
            'video_title'    =>   $request->video_title,
            'video_link'    =>   $request->video_link,
            'video_banner'    =>   $image,
            'category_id'    =>   $request->country,
            'genre_id'    =>   $request->genre,
            'homepage'    =>   $request->homepage
        );
          Adv_banner::whereId($id)->update($form_data2);

       }

        $id = DB::table('adv_banners')->orderBy('id', 'DESC')->value('id');

        if($request->state!=null){
        foreach($request->state as $state){
            $form_data3 = array(
            'banner_id'     =>   $id,
            'video_id'     =>  $state,
             );

            Adv_banner_video::create($form_data3);
        }
      }

        return redirect('banner-form')->with('advbannereditsuccess','Advertisement Banner Updated Successfully');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy1($id)
    {

      $banner_id=$id;

      $adv_banner_videos = DB::table('Adv_banner_videos');
      $videos =  DB::table('videos')
        ->where('banner_id', '=', $banner_id)
        ->join('Adv_banner_videos', 'Adv_banner_videos.video_id', '=', 'videos.id')
        ->select('videos.*', 'videos.video_title')
        ->get();

            return view('admin.advertisementbanner.display', compact('videos','adv_banner_videos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);



    }



    public function destroy($id)
    {
        Adv_banner_video::where('banner_id', $id)->delete();

        $data = Adv_banner::findOrFail($id);
        $data->delete();
        return redirect('banner-form')->with('advbannerdelsuccess','Advertisement Banner Deleted Successfully');



    }
}
