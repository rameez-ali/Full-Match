<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video_genre;
use App\Model\Category_genre;
use Bouncer;
use DB;

class ProjectCategoryViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct() {
        $this->middleware('can:view-category', ['only' => ['index', 'show']]);
        $this->middleware('can:add-category', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-category', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-category', ['only' => ['destroy']]);
    }

    public function index()
    {

          $category = Category::all();
          return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres=Video_genre::all();
        return view('admin.category.form', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name_en'     => 'required',
            'name_ar'     => 'required',
            'category_image'     =>  'required|image|max:2048',
            'genre'              =>  'required'
        ]);

        $image = $request->file('category_image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('app-assets/images/category'), $new_name);
        $form_data = array(
            'name_en'      =>   $request->name_en,
            'name_ar'      =>   $request->name_ar,
            'category_image'     =>   $new_name,
            'category_sorting'   =>   $request->category_sorting
        );

         Category::create($form_data);

        $id = DB::table('categories')->orderBy('id', 'DESC')->value('id');

         foreach($request->genre as $genre){
                $form_data5 = array(
                    'category_id'     =>  $id,
                    'genre_id'     =>   $genre
                );

                Category_genre::create($form_data5);
            }

        return redirect('category-form')->with('cataddsuccess','Category Added Successfully');
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
        $category=Category::find($id);

        $video_genres =  DB::table('video_genres')
        ->where('category_id', '=', $id)
        ->join('category_genres', 'category_genres.genre_id', '=', 'video_genres.id')
        ->select('video_genres.id')
        ->get();

       $selected_ids3 = [];
       foreach ($video_genres as $key => $gly) {
           array_push($selected_ids3, $gly->id);
       }

        $video_genres=Video_genre::select('id','name_en')->get();

        return view('admin.category.edit',compact('category','selected_ids3','video_genres'));
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

        $image_name = $request->hidden_image;
        $image = $request->file('category_image');
        if($image != '')
        {
            $request->validate([
                'name_en'    =>  'required',
                'name_ar'    =>  'required',
                'image'         =>  'image|max:2048',
                'genre'         =>   'required'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('app-assets/images/category'), $image_name);
        }
        else
        {
            $request->validate([
                'name_en'    =>  'required',
                'name_ar'    =>  'required',
                'genre'            => 'required'
            ]);
        }

        $form_data = array(
            'name_en'       =>   $request->name_en,
            'name_ar'       =>   $request->name_ar,
            'category_image'            =>   $image_name,
            'category_sorting'       =>   $request->category_sorting
        );

        Category::whereId($id)->update($form_data);

        Category_genre::where('category_id', $id)->forceDelete();

        foreach($request->genre as $genre){
                $form_data5 = array(
                    'category_id'     =>  $id,
                    'genre_id'     =>   $genre
                );

                Category_genre::create($form_data5);
            }



        return redirect('category-form')->with('cateditsuccess','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $data = Category::findOrFail($id);

        $data->delete();
        $request->session()->flash('message', 'Successfully deleted the task!');
        return redirect('category-form')->with('catdelsuccess','Category Deleted Successfully');


    }
}
