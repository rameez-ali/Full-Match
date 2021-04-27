<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Video_genre;
use App\Model\Videogenre;
use App\Model\Category;
use App\Model\Category_genre;
use App\Model\Video;
use DB;

class ProjectGenreViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct() {
        $this->middleware('can:view-genre', ['only' => ['index', 'show']]);
        $this->middleware('can:add-genre', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-genre', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-genre', ['only' => ['destroy']]);
    }

    public function index()
    {
            $video_genre=Video_genre::all();
            return view('admin.genre.index', compact('video_genre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        return view('admin.genre.form',compact('category'));
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
            'name_en'     => 'required',
            'name_ar'     => 'required'
        ]);

        $form_data = array(
             'name_en'      =>   $request->name_en,
             'name_ar'      =>   $request->name_ar,
            'genre_sorting'     =>   $request->genre_sorting
        );

        Video_genre::create($form_data);

        if($request->category_id!=null){
            foreach($request->category_id as $category_id){
                $genre_id = Video_genre::orderBy('id', 'DESC')->value('id');
                $form_data4 = array(
                    'category_id'     =>   $category_id,
                    'genre_id'     =>  $genre_id
                );

                Category_genre::create($form_data4);

            }
        }


       return redirect('genre-form')->with('genreaddsuccess','Video Genre Added Successfully');
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
        $genre=Video_genre::find($id);

        $categories=Category::all();

        $category_genres =  Category_genre::
        where('genre_id', '=', $id)
            ->join('categories', 'categories.id', '=', 'category_genres.category_id')
            ->select('categories.id')
            ->get();

        $selected_category_ids = [];
        foreach ($category_genres as $key => $ply) {
            array_push($selected_category_ids, $ply->id);
        }

        return view('admin.genre.edit',compact('genre','selected_category_ids','categories'));
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

        $form_data = array(
            'name_en'       =>   $request->name_en,
            'name_ar'       =>   $request->name_ar,
            'genre_sorting'       =>   $request->genre_sorting
        );

        Video_genre::whereId($id)->update($form_data);

        if($request->category_id!=null){
            Category_genre::where('genre_id', $id)->forceDelete();
            foreach($request->category_id as $category_id){
                $form_data7 = array(
                    'category_id'     =>   $category_id,
                    'genre_id'     =>  $id,
                );

                Category_genre::create($form_data7);


            }
        }

        return redirect('genre-form')->with('genreeditsuccess','Video Genre Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Videogenre::where('genre_id', $id)->delete();

        $data = Video_genre::findOrFail($id);
        $data->delete();
        return redirect('genre-form')->with('genredelsuccess','Video Genre Deleted Successfully');


    }
}
