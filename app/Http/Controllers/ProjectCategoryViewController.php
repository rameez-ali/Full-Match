<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProjectCategory;

class ProjectCategoryViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $category = ProjectCategory::all();
          return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.form');
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
            'category_name'     => 'required',
            'category_image'     =>  'required|image|max:2048',
            'category_sorting'   =>  'required'
        ]);

        $image = $request->file('category_image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $form_data = array(
            'category_name'      =>   $request->category_name,
            'category_image'     =>   $new_name,
            'category_sorting'   =>   $request->category_sorting
        );

        ProjectCategory::create($form_data);
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
        $category=ProjectCategory::find($id);
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
                'category_name'    =>  'required',
                'category_sorting'   =>  'required',
                'image'         =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        else
        {
            $request->validate([
                'category_name'    =>  'required',
                'category_sorting'   =>  'required'
            ]);
        }

        $form_data = array(
            'category_name'       =>   $request->category_name,
            'category_image'            =>   $image_name,
            'category_sorting'       =>   $request->category_sorting
        );
  
        ProjectCategory::whereId($id)->update($form_data);

        return redirect('category-form')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $data = ProjectCategory::findOrFail($id);
        $data->delete();
        $request->session()->flash('message', 'Successfully deleted the task!');
        return redirect('category-form');


    }
}
