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
         $category = ProjectCategory::latest()->paginate(5);
            return view('admin.category.index', compact('category'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
            'featured_image'         =>  'required|image|max:2048'
        ]);

        $image = $request->file('featured_image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $form_data = array(
            'category_name'     =>   $request->category_name,
            'featured_image'     =>   $new_name
        );

        ProjectCategory::create($form_data);
       return redirect('category-form')->with('success', 'Data is successfully Added');
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
        $image = $request->file('featured_image');
        if($image != '')
        {
            $request->validate([
                'category_name'    =>  'required',
                'image'         =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        else
        {
            $request->validate([
                'category_name'    =>  'required'
            ]);
        }

        $form_data = array(
            'category_name'       =>   $request->category_name,
            'featured_image'            =>   $image_name
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
    public function destroy($id)
    {
        Video::where('Category_id', $id)->delete();

        $data = ProjectCategory::findOrFail($id);
        $data->delete();
        return redirect('category-form')->with('success', 'Data is successfully deleted');


    }
}
