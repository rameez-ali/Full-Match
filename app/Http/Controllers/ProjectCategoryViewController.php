<?php

namespace App\Http\Controllers;

use App\Model\Adv_banner;
use App\Model\Slider;
use App\Model\Video;
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
            'category_image'     =>  'required|image|max:2048'
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

        return view('admin.category.edit',compact('category'));
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
                'image'         =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('app-assets/images/category'), $image_name);
        }
        else
        {
            $request->validate([
                'name_en'    =>  'required',
                'name_ar'    =>  'required'
            ]);
        }

        $form_data = array(
            'name_en'       =>   $request->name_en,
            'name_ar'       =>   $request->name_ar,
            'category_image'            =>   $image_name,
            'category_sorting'       =>   $request->category_sorting
        );

        Category::whereId($id)->update($form_data);


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

        $video=Video::where('category_id',$id)->get()->toArray();
        $slider=Slider::where('category_id',$id)->get()->toArray();
        $advbanner=Adv_banner::where('category_id',$id)->get()->toArray();

        if($video!=null){
            return redirect('category-form')->with('catdelsuccess','You cant delete this category because Video is Associated with this Category');
        }
        elseif($slider!=null){
            return redirect('category-form')->with('catdelsuccess','You cant delete this category because Slider is Associated with this Category');
        }
        elseif($advbanner!=null){
            return redirect('category-form')->with('catdelsuccess','You cant delete this category because Adv Banner is Associated with this Category');
        }
        else{
            $data->delete();
            return redirect('category-form')->with('catdelsuccess','Category Deleted Successfully');
        }

    }
}
