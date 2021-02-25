<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video;
use DB;
use App\Model\Slider;
use App\Model\Adv_banner_video;
use App\Model\Adv_banner;
use App\Model\Video_genre;

class ProjectAdvertisementViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct() {
        $this->middleware('can:view-advbanner', ['only' => ['index', 'show']]);
        $this->middleware('can:add-advbanner', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-advbanner', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-advbanner', ['only' => ['destroy']]);
    }

    public function index()
    {
        //Getting Categories id associated with the videos
        $category_id = Video::select('category_id')->get()->toArray();

        //Getting Genres id associated with the videos
        $genre_id = Video::select('league_id')->get()->toArray();

        //Getting Categories and Genres associated with the videos
        $Adv_banner= Adv_banner::
              leftJoin('categories', 'categories.id', '=', 'adv_banners.category_id')
            ->leftJoin('video_genres', 'video_genres.id', '=', 'adv_banners.genre_id')
            ->select('adv_banners.*','adv_banners.id','adv_banners.title_en','adv_banners.video_link',
                'adv_banners.video_banner', 'categories.name_en as categoryname',
                'video_genres.name_en as genrename')
            ->get();

        return view('admin.advertisementbanner.index', compact('Adv_banner'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_id = Adv_banner::select('category_id')->get()->toArray();

        $videogenre=Video_genre::all();
        $video=Category::get();
        return view('admin.advertisementbanner.form',compact('video','videogenre'));
    }


    public function getvideo($id)
    {
        //Check if banner associated with Category already exists
        $category_status = Adv_banner::where("category_id",$id)->get()->first();
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
        if($request->file('video_banner')==null){
            $form_data2 = array(
                'title_en'    =>   $request->title_en,
                'title_ar'    =>   $request->title_ar,
                'video_link'    =>   $request->video_link,
                'video_id'    =>   $request->state,
                'category_id'    =>   $request->country,
                'genre_id'    =>   $request->genre,
                'homepage'    =>   $request->homepage
            );
            Adv_banner::create($form_data2);

        }
        else{
            $image = $request->file('video_banner');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('app-assets/images/advbanner'), $new_name);

            $form_data2 = array(
                'title_en'    =>   $request->title_en,
                'title_ar'    =>   $request->title_ar,
                'video_link'    =>   $request->video_link,
                'video_banner'    =>   $new_name,
                'video_id'    =>   $request->state,
                'category_id'    =>   $request->country,
                'genre_id'    =>   $request->genre,
                'homepage'    =>   $request->homepage
            );
            Adv_banner::create($form_data2);

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

       //Getting All Categories
        $category=Category::all();

        //Getting Category id associated with this banner
        $select_category_id = Adv_banner::select('category_id')->where('id', '=', $id )->get()->first();
        //Getting Category associated with this banner
        $category=Category::select('id','name_en')->wherein('id',$select_category_id )->get()->first();

        //Getting Genre id associated with this banner
        $select_genre_id = Adv_banner::select('genre_id')->where('id', '=', $id )->get()->first();
        //Getting Genre associated with this banner
        $genres=Video_genre::select('id','name_en')->get();

        //Getting Homepage Status associated with this banner
        $select_homepage_id=Adv_banner::select('homepage')->where('id',$id)->first();
        //Getting Homepage Status
        $homepages=DB::table('homepages')->select('id','status')->get();


        $slider=Adv_banner::where('id',$id)->first();

        return view('admin.advertisementbanner.edit', compact('videos','select_category_id','select_genre_id','select_homepage_id','select_genre_id','slider','category','genres','homepages'))
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
                'title_en'    =>   $request->title_en,
                'title_ar'    =>   $request->title_ar,
                'video_link'    =>   $request->video_link,
                'video_id'    =>   $request->state,
                'genre_id'    =>   $request->genre,
                'homepage'    =>   $request->homepage
            );
            Adv_banner::whereId($id)->update($form_data2);

        }
        else{
            $image = $request->file('video_banner');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('app-assets/images/advbanner'), $new_name);

            $form_data2 = array(
                'title_en'    =>   $request->title_en,
                'title_ar'    =>   $request->title_ar,
                'video_link'    =>   $request->video_link,
                'video_banner'    =>   $new_name,
                'video_id'    =>   $request->state,
                'genre_id'    =>   $request->genre,
                'homepage'    =>   $request->homepage
            );
            Adv_banner::whereId($id)->update($form_data2);

        }

        return redirect('banner-form')->with('advbannereditsuccess','Advertisement Banner Updated Successfully');

    }



    public function destroy($id)
    {
        Adv_banner_video::where('banner_id', $id)->delete();

        $data = Adv_banner::findOrFail($id);
        $data->delete();
        return redirect('banner-form')->with('advbannerdelsuccess','Advertisement Banner Deleted Successfully');



    }
}
